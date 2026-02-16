<?php
session_start();
$conn = mysqli_connect('localhost','root','','appointment');

// 1. Processing Logic moved to the TOP (Fixes "Headers already sent")
if(isset($_POST['submit']))
{
    $username = $_SESSION['username'];
    // SECURITY FIX: Prevent SQL Injection
    $timestamp = mysqli_real_escape_string($conn, $_POST['Appointment']);
    
    $updatequery = "UPDATE booking SET Status='Cancelled by Patient' WHERE username='$username' AND timestamp='$timestamp'";
    
    if (mysqli_query($conn, $updatequery)) 
    {
        echo "<script>alert('Appointment Cancelled successfully!'); window.location.href='Login.php';</script>";
        // Alternatively, use header() here if you haven't echoed the script above
        // header("Location: Login.php"); 
        exit();
    } 
    else
    {
        echo "Error: " . $updatequery . "<br>" . mysqli_error($conn);
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="main.css">
</head>
<body style="background-image: url(Images/Pic6.jpg);">
    <div class="header">
        <ul>
            <li style="float: left; border-right: none;">
                <a href="Login.php" class="logo"><img src="Images/Pic9.png" width="70px" height="60px"> <strong> WeCare </strong> Online Apppointment System </a>
            </li>
            <li> <a href="Login.php">BACK</a></li>
        </ul>
    </div>

    <form action="" method="POST"> <div class="sucontainer">
            <label style="font-size: 30px">Select your Appointment to Cancel:-</label><br>
            
            <select name="Appointment" id="Apppointment-list" class="demoInputBox" style="width: 100%;height: 50px; border-radius: 10px;">
                <option value="">Select My Appointment</option>
            
            <?php
            // 2. Removed the 'echo POST' line that caused the Undefined Index error
            
            $username = $_SESSION['username'];
            $date = date('Y-m-d');
            
            // It is better to use a JOIN rather than nested loops, but keeping your logic for now:
            $sql1 = "SELECT * FROM booking WHERE username='".$username."' AND status NOT LIKE 'Cancelled by Patient' AND DOV >='$date'";
            $results = $conn->query($sql1); 
            
            while($rs = $results->fetch_assoc()) {
                $sql2 = "SELECT * FROM doctor WHERE DID=".$rs["DID"];
                $results2 = $conn->query($sql2);
                while($rs2 = $results2->fetch_assoc()) {
                    $sql3 = "SELECT * FROM clinic WHERE CID=".$rs["CID"];
                    $results3 = $conn->query($sql3);
                    while($rs3 = $results3->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $rs["Timestamp"]; ?>">
                            <?php echo "Patient: ".$rs["Fname"]." Date: ".$rs["DOV"]." - Dr.".$rs2["name"]." - Clinic: ".$rs3["name"]." - Town: ".$rs3["town"]; ?>
                        </option>
                        <?php
                    }
                }
            }
            ?>
            </select> 
        </div> <button type="submit" style="position:center" name="submit" value="Submit">Submit</button>
    </form>
</body>
</html>