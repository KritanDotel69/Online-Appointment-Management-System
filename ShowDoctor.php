<?php
session_start();
include 'DBconnect.php';


?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="adminmain.css">
    <title>Admin | View Doctors</title>
    <style>
        .doctor-table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.9);
            font-family: cursive;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .doctor-table th, .doctor-table td {
            padding: 15px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .doctor-table th {
            background-color: #333;
            color: white;
            font-size: 18px;
        }
        .doctor-table tr:nth-child(even) { background-color: #f2f2f2; }
        .doctor-table tr:hover { background-color: #ddd; }
        
        .action-btn {
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 14px;
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
            <li class="dropdown">
                <a class="dropbtn" style="font-family: cursive;">DOCTOR</a>
                <div class="dropdown-content">
                    <a href="NewDoctor.php">Add new Doctor</a>
                    <a href="DeleteDoctor.php">Delete Doctor</a>
                    <a href="ShowDoctor.php">Show all Doctors</a>
                </div>
            </li>
            <li class="dropdown">
                <a class="dropbtn" style="font-family: cursive;">CLINIC</a>
                <div class="dropdown-content">
                    <a href="ShowClinic.php">Show the Clinics</a>
                    <a href="AddDoctorToClinic.php">Assign Doctor</a>
                </div>
            </li>
            <li>
                <form method="POST" action="AdminLogin.php">
                    <button type="submit" class="cancelbtn" name="logout" style="font-size: 20px; font-family: cursive;">LOGOUT</button>
                </form>
            </li>
        </h2>
    </ul>

    <center>
        <h1 style="font-family: cursive; color: white; text-shadow: 2px 2px 4px #000;">MASTER DOCTOR LIST</h1>
        <hr style="width: 80%;">
    </center>

    <table class="doctor-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor Name</th>
                <th>Specialization</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetching all doctors from the database
            $sql = "SELECT * FROM doctor ORDER BY name ASC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['DID'] . "</td>";
                    echo "<td><strong>Dr. " . htmlspecialchars($row['name']) . "</strong></td>";
                    echo "<td>" . htmlspecialchars($row['specialisation']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                    echo "<td>
                            <a href='EditDoctor.php?id=".$row['DID']."' class='action-btn edit-btn'>Edit</a>
                            <a href='DeleteDoctor.php?id=".$row['DID']."' class='action-btn delete-btn' onclick='return confirm(\"Are you sure?\")'>Remove</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>No doctors found in the database.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>