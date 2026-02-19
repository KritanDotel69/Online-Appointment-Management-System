<?php 
session_start();
error_reporting(0);
include "DBconnect.php"; 

// 1. SECURITY CHECK: Make sure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: Login.php"); // Redirect if not logged in
    exit();
}

// 2. GET USERNAME FROM SESSION
$session_username = $_SESSION['username']; 
?>
<html>
<head>
    <link rel="stylesheet" href="main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> </head>
<body style="background-image: url(Images/Pic12.jpg);">

<div class="header">
    <ul>
        <li style="float: left; border-right: none;"> 
            <a href="Home.php" class="logo"> <img src="Images/Pic9.png" width="70px" height="60px"> <strong> WeCare </strong> </a> 
        </li>
        <li> <a href="Home.php"><strong> HOME </strong></a></li>
        <li> <a href="ViewAppointment.php"><strong> MY APPOINTMENTS </strong></a></li>
    </ul>
</div>

<form action="Booking.php" method="post">
    <div class="sucontainer">
        <p style="color: black;">Booking as: <strong><?php echo $session_username; ?></strong></p>

        <label style="font-size:20px ; font-family:cursive;color:black"><b>Patient Full Name:</b></label><br>
        <input type="text" name="fname" required placeholder="Name of person visiting"><br>
        
        <label style="font-size:20px ; font-family:cursive;color:black"><b>Gender:</b></label><br>
        <input type="radio" name="gender" value="female" required>Female
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="other">Other<br><br>

        <label style="font-size:20px ; font-family:cursive;color:black">City:</label><br>
        <select name="city" id="city-list" class="demoInputBox" onChange="getClinic(this.value);" style="width:100%;height:35px;">
            <option value="">Select City</option>
            <?php
            $sql1="SELECT distinct(city) FROM clinic";
            $results=$conn->query($sql1); 
            while($rs=$results->fetch_assoc()) { 
                echo "<option value='".$rs["city"]."'>".$rs["city"]."</option>";
            }
            ?>
        </select><br>

            <label style="font-size:20px ; font-family:cursive;color:black">Clinic:</label><br>
    <select id="clinic-list" name="cid" onChange="getDoctorday(this.value);" style="width:100%;height:35px;border-radius:9px">
        <option value="" style="font-family:cursive;color:black">Select Clinic</option>
        <?php
    $sql1="SELECT * FROM clinic";
         $results=$conn->query($sql1); 
         while($rs=$results->fetch_assoc()) { 
            ?>
            <option value="<?php echo $rs["CID"]; ?>"><?php echo $rs["name"]; ?></option>
            <?php
            }
            ?>
            </select><br>

        

        

        <label style="font-size:20px ; font-family:cursive;color:black"><b>Date of Visit:</b></label><br>
        <input type="date" name="DOV" min="<?php echo date('Y-m-d');?>" required><br><br>
        
        <button type="submit" name="submit" class="btn">Confirm Booking</button>
    </div>

<?php
if(isset($_POST['submit'])) {
    // 3. PROCESS THE DATA
    $fname    = mysqli_real_escape_string($conn, $_POST['fname']);
    $gender   = $_POST['gender'];
    $cid      = $_POST['cid'];
    $did      = $_POST['doctor'];
    $dov      = $_POST['DOV'];
    $status   = "Booking Registered. Wait for update.";
    $timestamp = date('Y-m-d H:i:s');

    // Use the $session_username here instead of a $_POST variable
    $sql = "INSERT INTO booking (username, Fname, gender, CID, DID, DOV, Timestamp, Status) 
            VALUES ('$session_username', '$fname', '$gender', '$cid', '$did', '$dov', '$timestamp', '$status')";

    if(mysqli_query($conn, $sql)) {
        echo "<h2 style='color:green; text-align:center;'>Booking Successful!</h2>";
        header("Refresh:2; url=view_appointments.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
</form>

<script>
      {
      $.ajax
        ({
          type: "POST",
          url: "get_town.php",
          data:'countryid='+val,
          success: function(data)
            {
            $("#town-list").html(data);
          }
      });
    }
    // function getClinic(val)
    // {
    //   $.ajax
    //     ({
    //       type: "POST",
    //       url: "getclinic.php",
    //       data:'townid='+val,
    //       success: function(data)
    //         {
    //         $("#clinic-list").html(data);
    //       }
    //   });
    // }
    function getDoctorday(val) 
    {
      $.ajax
        ({
          type: "POST",
          url: "getdoctordaybooking.php",
          data:'CID='+val,
          success: function(data)
            {
            $("#doctor-list").html(data);
          }
      });
    }

    function getDay(val) 
    {
      var CID=document.getElementById("clinic-list").value;
      var DID=document.getElementById("doctor-list").value;
      $.ajax
        ({
          type: "POST",
          url: "getDay.php",
          data:'date='+val+'&cidval='+CID+'&didval='+DID,
          success: function(data)
            {
            $("#datestatus").html(data);
          }
      });
    }
</script>

</body>
</html>