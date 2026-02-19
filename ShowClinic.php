<?php
session_start();
include 'DBconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="adminmain.css">
    <title>Admin | View Clinics</title>
    <style>
        .clinic-table {
            width: 95%; 
            margin: 30px auto;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.9);
            font-family: cursive;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .clinic-table th, .clinic-table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .clinic-table th {
            background-color: #008080;
            color: white;
            font-size: 16px;
        }
        .clinic-table tr:nth-child(even) { background-color: #f9f9f9; }
        .action-btn {
            padding: 6px 10px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 13px;
        }
        .delete-btn { background-color: #ff4d4d; }
        .edit-btn { background-color: #4CAF50; margin-right: 5px; }
    </style>
</head>
<body style="background-image: url(Images/Pic10.jpg); background-size: cover; background-attachment: fixed;">

    <ul>
        <li class="dropdown"><p style="font-family: cursive; font-size: 40px; color: white;">ADMIN MODE</p></li>
        <br>
        <h2>
            <li class="dropdown"><a class="dropbtn">DOCTOR</a></li>
            <li class="dropdown"><a class="dropbtn">CLINIC</a></li>
            <li><button class="cancelbtn">LOGOUT</button></li>
        </h2>
    </ul>

    <center>
        <h1 style="font-family: cursive; color: white; text-shadow: 2px 2px 4px #000;">REGISTERED CLINICS & LOCATIONS</h1>
        <hr style="width: 80%;">
    </center>

    <table class="clinic-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Clinic Name</th>
                <th>City</th>
                <th>Town</th> <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            $sql = "SELECT * FROM clinic ORDER BY city ASC, town ASC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['CID'] . "</td>";
                    echo "<td><strong>" . htmlspecialchars($row['name']) . "</strong></td>";
                    echo "<td>" . htmlspecialchars($row['city']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['town']) . "</td>"; 
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>
                            <a href='EditClinic.php?id=".$row['CID']."' class='action-btn edit-btn'>Edit</a>
                            <a href='DeleteClinic.php?id=".$row['CID']."' class='action-btn delete-btn'>Remove</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>No clinics found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>