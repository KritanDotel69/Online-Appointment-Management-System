<?php
session_start();
$conn = mysqli_connect('localhost','root','','appointment');

$showSuccess = false;

if(isset($_POST['submit']))
{
    $username = $_SESSION['username'];
    $timestamp = mysqli_real_escape_string($conn, $_POST['Appointment']);
    
    $updatequery = "UPDATE booking SET Status='Cancelled by Patient' WHERE username='$username' AND timestamp='$timestamp'";
    
    if (mysqli_query($conn, $updatequery)) 
    {
        $showSuccess = true; // Flag to trigger animation
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
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-image: url(Images/Pic6.jpg);
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .header ul { list-style: none; padding: 10px; display: flex; }
        .header li { margin-right: 20px; }
        .sucontainer {
            background: rgba(255,255,255,0.9);
            padding: 30px;
            margin: 50px auto;
            width: 90%;
            max-width: 600px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        select, button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        button {
            background: #ff0157;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover { background: #d90048; }

        /* Success Animation */
        .success-overlay {
            position: fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background: rgba(0,0,0,0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease;
        }
        .success-overlay.show {
            opacity: 1;
            pointer-events: all;
        }
        .success-message {
            background: #28a745;
            color: white;
            padding: 40px 60px;
            border-radius: 20px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            animation: pop 0.5s ease;
        }
        @keyframes pop {
            0% { transform: scale(0); }
            70% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="header">
        <ul>
            <li style="float: left; border-right: none;">
                <a href="Login.php" class="logo"><img src="Images/Pic9.png" width="70px" height="60px"> <strong> WeCare </strong> Online Appointment System </a>
            </li>
            <li> <a href="Login.php">BACK</a></li>
        </ul>
    </div>

    <form action="" method="POST">
        <div class="sucontainer">
            <label style="font-size: 30px">Select your Appointment to Cancel:</label><br>
            
            <select name="Appointment" id="Appointment-list" class="demoInputBox">
                <option value="">Select My Appointment</option>
                <?php
                $username = $_SESSION['username'];
                $date = date('Y-m-d');
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
            <button type="submit" name="submit">Cancel Appointment</button>
        </div>
    </form>

    <!-- Success Overlay -->
    <div class="success-overlay" id="successOverlay">
        <div class="success-message">Appointment Cancelled Successfully!</div>
    </div>

    <script>
        <?php if($showSuccess): ?>
        // Show animation
        const overlay = document.getElementById('successOverlay');
        overlay.classList.add('show');

        // Redirect after 2 seconds
        setTimeout(() => {
            window.location.href = 'Login.php';
        }, 2000);
        <?php endif; ?>
    </script>
</body>
</html>