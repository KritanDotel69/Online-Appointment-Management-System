<?php 
session_start();
include "DBconnect.php"; 

$records_per_page = 3; // Show 3 appointments per page

// Get current page from URL, default is 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;

// Count total appointments
$count_sql = "SELECT COUNT(*) as total FROM booking";
$count_result = $conn->query($count_sql);
$total_records = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Appointments | WeCare</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .table-container {
            padding: 50px;
            background: rgba(255, 255, 255, 0.9);
            margin: 50px auto;
            width: 90%;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: 'Segoe UI', sans-serif;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #ff0157;
            color: white;
        }
        tr:hover { background-color: #f5f5f5; }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }
        .pending { background: #ffc107; color: black; }
        .success { background: #28a745; }
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        .pagination a {
            color: #ff0157;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ff0157;
            margin: 0 4px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .pagination a:hover {
            background-color: #ff0157;
            color: white;
        }
        .pagination .active {
            background-color: #ff0157;
            color: white;
            border: 1px solid #ff0157;
        }
    </style>
</head>
<body style="background-image: url(Images/Pic12.jpg); background-size: cover;">

<div class="header">
    <ul>
        <li style="float: left; border-right: none;"> 
            <a href="Home.php" class="logo"> 
                <img src="Images/Pic9.png" width="70px" height="60px"> 
                <strong> WeCare </strong> Appointment List 
            </a> 
        </li>
        <li> <a href="Home.php"><strong> HOME </strong></a></li>
        <li> <a href="Booking.php"><strong> NEW BOOKING </strong></a></li>
    </ul>
</div>

<div class="table-container">
    <h2 style="text-align: center; color: #333;">Current Appointments</h2>
    
    <table>
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Phone</th>
                <th>Clinic ID</th>
                <th>Doctor ID</th>
                <th>Visit Date</th>
                <th>Status</th>
                <th>Booked On</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM booking ORDER BY DOV DESC LIMIT $start_from, $records_per_page";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $status_class = (strpos(strtolower($row['Status']), 'registered') !== false) ? 'pending' : 'success';
                    
                    echo "<tr>
                            <td>" . htmlspecialchars($row['Fname']) . "</td>
                            <td>" . $row['contact'] . "</td>
                            <td>" . $row['CID'] . "</td>
                            <td>" . $row['DID'] . "</td>
                            <td>" . $row['DOV'] . "</td>
                            <td><span class='status-badge $status_class'>" . $row['Status'] . "</span></td>
                            <td>" . $row['Timestamp'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center;'>No appointments found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php
        for ($i=1; $i<=$total_pages; $i++) {
            $active = ($i == $page) ? 'active' : '';
            echo "<a class='$active' href='?page=".$i."'>".$i."</a>";
        }
        ?>
    </div>
</div>

</body>
</html>