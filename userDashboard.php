<?php
session_start();
$conn = mysqli_connect("localhost","root","","appointment");

if(!isset($_SESSION['username'])){
    header("Location: Login.php");
    exit();
}

$username = $_SESSION['username'];

// Get user info
$userQuery = "SELECT * FROM patient WHERE username='$username'";
$userResult = mysqli_query($conn,$userQuery);
$user = mysqli_fetch_assoc($userResult);

// Get appointments
$appointmentQuery = "SELECT * FROM booking WHERE username='$username' ORDER BY DOV DESC";
$appointments = mysqli_query($conn,$appointmentQuery);
?>

<html>
<head>
<title>User Dashboard</title>

<style>

body{
font-family: Arial;
background-image:url(Images/Pic6.jpg);
background-size:cover;
}

.header ul{
list-style:none;
margin:0;
padding:0;
background:#2c3e50;
overflow:hidden;
}

.header li{
float:right;
}

.header li a{
display:block;
color:white;
padding:14px 20px;
text-decoration:none;
}

.header li a:hover{
background:#1abc9c;
}

.dashboard{
width:80%;
margin:auto;
margin-top:30px;
background:white;
padding:30px;
border-radius:10px;
}

.profile{
background:#ecf0f1;
padding:20px;
border-radius:10px;
margin-bottom:30px;
}

table{
width:100%;
border-collapse:collapse;
}

table th, table td{
border:1px solid #ddd;
padding:10px;
text-align:center;
}

table th{
background:#2c3e50;
color:white;
}

</style>

</head>

<body>

<div class="header">
<ul>

<li style="float:left"><a><b>WeCare Appointment System</b></a></li>
<li><a href="Logout.php">Logout</a></li>
<li><a href="CancelBooking.php">Cancel Appointment</a></li>
<li><a href="Booking.php">Book Appointment</a></li>

</ul>
</div>


<div class="dashboard">

<h2>Welcome <?php echo $user['username']; ?> 👋</h2>

<div class="profile">

<h3>Your Profile</h3>

<p><b>Name:</b> <?php echo $user['Fname']." ".$user['Lname']; ?></p>

<p><b>Email:</b> <?php echo $user['email']; ?></p>

<p><b>Phone:</b> <?php echo $user['phone']; ?></p>

<p><b>Gender:</b> <?php echo $user['gender']; ?></p>

<p><b>Date of Birth:</b> <?php echo $user['DOB']; ?></p>

</div>


<h3>Your Appointments</h3>

<table>

<tr>
<th>Patient</th>
<th>Date</th>
<th>Doctor ID</th>
<th>Clinic ID</th>
<th>Status</th>
<th>Booked On</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($appointments))
{
?>

<tr>

<td><?php echo $row['Fname']; ?></td>

<td><?php echo $row['DOV']; ?></td>

<td><?php echo $row['DID']; ?></td>

<td><?php echo $row['CID']; ?></td>

<td><?php echo $row['Status']; ?></td>

<td><?php echo $row['Timestamp']; ?></td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>