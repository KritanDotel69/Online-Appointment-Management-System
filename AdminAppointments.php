<?php
include "DBconnect.php";

// Fetch all pending appointments
$sql = "SELECT * FROM booking ORDER BY DOV ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>AdminAppointments</title>
<style>
 body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: url('Images/hand.png') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
        color: #333;
    }


h2 { text-align: center; color: #fff; margin-bottom: 20px; }
table {
    width: 90%;
    margin: auto;
    border-collapse: collapse;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    border-radius: 10px;
    overflow: hidden;
}
th, td {
    padding: 12px 15px;
    text-align: center;
}
th {
    background-color: #ff0157;
    color: white;
}
tr:nth-child(even) { background-color: rgba(255,255,255,0.1); }
tr:hover { background-color: rgba(255,255,255,0.2); transition: 0.3s; }
.status {
    padding: 5px 10px;
    border-radius: 15px;
    font-weight: bold;
    color: white;
}
.pending { background-color: orange; }
.approved { background-color: #28a745; }
.rejected { background-color: #dc3545; }
button {
    padding: 5px 10px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: white;
    margin: 2px;
    font-weight: bold;
}
.approve-btn { background-color: #28a745; }
.reject-btn { background-color: #dc3545; }
button:hover { opacity: 0.8; }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// AJAX for approve/reject without page reload
function updateStatus(timestamp, action){
    $.ajax({
        url: "updatestatus.php",
        type: "POST",
        data: { id: timestamp, action: action },
        success: function(response){
            let row = document.getElementById(timestamp);
            let statusCell = row.querySelector('.status-cell');
            if(action === 'approve'){
                statusCell.textContent = 'Approved';
                statusCell.className = 'status-cell status approved';
            } else {
                statusCell.textContent = 'Rejected';
                statusCell.className = 'status-cell status rejected';
            }
            row.querySelectorAll('button').forEach(btn => btn.disabled = true);
        }
    });
}
</script>
</head>
<body>

<h2>Pending Appointments</h2>
<table border="0">
<tr>
    <th>Patient</th>
    <th>Phone</th>
    <th>Clinic</th>
    <th>Date of Visit</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr id="<?php echo $row['Timestamp']; ?>">
    <td><?php echo $row['Fname']; ?></td>
    <td><?php echo $row['contact']; ?></td>
    <td><?php echo $row['CID']; ?></td>
    <td><?php echo $row['DOV']; ?></td>
    <td class="status-cell status <?php 
        echo $row['Status'] === 'Booking Registered. Wait for update.' ? 'pending' :
             ($row['Status'] === 'Approved by Admin' ? 'approved' : 'rejected'); 
    ?>">
        <?php 
        echo $row['Status'] === 'Booking Registered. Wait for update.' ? 'Pending' : 
             ($row['Status'] === 'Approved by Admin' ? 'Approved' : 'Rejected'); 
        ?>
    </td>
    <td>
        <?php if($row['Status'] === 'Booking Registered. Wait for update.'): ?>
        <button class="approve-btn" onclick="updateStatus('<?php echo $row['Timestamp']; ?>','approve')">Approve</button>
        <button class="reject-btn" onclick="updateStatus('<?php echo $row['Timestamp']; ?>','reject')">Reject</button>
        <?php else: ?>
        <span style="color: gray;">Action Done</span>
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>