<?php
session_start();
include 'DBconnect.php';

// 1. Get the Clinic ID from the URL
if (isset($_GET['id'])) {
    $cid = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch current details including town
    $fetch_query = "SELECT * FROM clinic WHERE CID = '$cid'";
    $result = mysqli_query($conn, $fetch_query);
    $clinic = mysqli_fetch_assoc($result);

    if (!$clinic) {
        die("Clinic not found.");
    }
} else {
    header("Location: ShowClinic.php");
    exit();
}

// 2. Process the Update
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $town = mysqli_real_escape_string($conn, $_POST['town']); // New Town Variable
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Added town='$town' to the SQL statement
    $update_sql = "UPDATE clinic SET name='$name', city='$city', town='$town', address='$address' WHERE CID='$cid'";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>
                alert('Clinic and Town details updated successfully!');
                window.location.href = 'ShowClinic.php';
              </script>";
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="adminmain.css">
    <title>Admin | Edit Clinic & Town</title>
    <style>
        .edit-container {
            background: rgba(255, 255, 255, 0.95);
            width: 450px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 15px;
            font-family: cursive;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }
        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #008080; }
        .input-group input, .input-group textarea { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            box-sizing: border-box;
        }
        .update-btn {
            background-color: #008080;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 8px;
            font-size: 18px;
            font-family: cursive;
        }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; }
    </style>
</head>
<body style="background-image: url(Images/Pic10.jpg); background-size: cover;">

    <div class="edit-container">
        <h2 style="text-align: center;">Edit Clinic Location</h2>
        <hr color="#008080">
        
        <?php if(isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>

        <form method="POST" action="">
            <div class="input-group">
                <label>Clinic Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($clinic['name']); ?>" required>
            </div>

            <div class="input-group">
                <label>City:</label>
                <input type="text" name="city" value="<?php echo htmlspecialchars($clinic['city']); ?>" required>
            </div>

            <div class="input-group">
                <label>Town:</label>
                <input type="text" name="town" value="<?php echo htmlspecialchars($clinic['town']); ?>" required>
            </div>

            <div class="input-group">
                <label>Full Address:</label>
                <textarea name="address" rows="3" required><?php echo htmlspecialchars($clinic['address']); ?></textarea>
            </div>

            <button type="submit" name="update" class="update-btn">Save Clinic & Town</button>
            <a href="ShowClinic.php" class="back-link">← Cancel</a>
        </form>
    </div>

</body>
</html>