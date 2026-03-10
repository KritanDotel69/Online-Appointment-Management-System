<?php
session_start();
$conn = mysqli_connect('localhost','root','','appointment');

if(!isset($_SESSION['username'])){
    header("Location: Login.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM patient WHERE username='$username'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);
?>

<html>
<head>

<title>User Dashboard</title>

<style>

body{
margin:0;
font-family: 'Segoe UI', sans-serif;
background-image: url("Images/appointment.png");
background-size: cover;
background-position: center;
background-repeat: no-repeat;
height:100vh;
}

/* HEADER */

.header{
background: rgba(0,0,0,0.4);
padding:15px;
color:white;
font-size:22px;
text-align:center;
letter-spacing:1px;
}

/* MAIN DASHBOARD */

.dashboard{
display:flex;
justify-content:center;
align-items:center;
gap:40px;
margin-top:50px;
}

/* PROFILE CARD */

.profile{
background:white;
width:320px;
padding:25px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.3);
transition:0.3s;
}

.profile:hover{
transform:translateY(-5px);
}

.profile h2{
text-align:center;
color:#333;
}

.profile p{
font-size:16px;
margin:8px 0;
}

/* ACTION PANEL */

.actions{
display:grid;
grid-template-columns:repeat(2,200px);
gap:25px;
}

/* BUTTON STYLE */

.btn{
background:white;
border:none;
padding:25px;
font-size:18px;
border-radius:15px;
cursor:pointer;
box-shadow:0 6px 15px rgba(0,0,0,0.25);
transition:0.3s;
font-weight:bold;
}

.btn:hover{
transform:scale(1.08);
background:#ff0157;
color:white;
}

</style>

</head>

<body>

<div class="header">
Welcome <?php echo $_SESSION['username']; ?> to WeCare Appointment Dashboard
</div>


<div class="dashboard">

<!-- PROFILE -->

<div class="profile">

<h2>Your Profile</h2>

<p><b>Name:</b> <?php echo $user['name']; ?></p>
<p><b>Email:</b> <?php echo $user['email']; ?></p>
<p><b>Phone:</b> <?php echo $user['phone']; ?></p>
<p><b>Gender:</b> <?php echo $user['gender']; ?></p>


</div>


<!-- ACTION BUTTONS -->

<div class="actions">

<button class="btn" onclick="window.location.href='Booking.php'">
📅 Book Appointment
</button>

<button class="btn" onclick="window.location.href='ViewAppointment.php'">
📋 View Appointments
</button>

<button class="btn" onclick="window.location.href='CancelBooking.php'">
❌ Cancel Appointment
</button>

<button class="btn" onclick="window.location.href='Login.php'">
🚪 Logout
</button>

</div>

</div>

</body>
</html>