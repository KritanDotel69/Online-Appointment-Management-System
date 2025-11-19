<!-- <?php
// $conn = mysqli_connect('localhost','root','','appointment');
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "APPOINTMENT";

//  Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
?> -->


<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "appointment";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>