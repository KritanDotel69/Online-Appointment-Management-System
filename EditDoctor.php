<?php
session_start();
include 'DBconnect.php';


if (isset($_GET['id'])) {
    $did = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch current details of this doctor
    $fetch_query = "SELECT * FROM doctor WHERE DID = '$did'";
    $result = mysqli_query($conn, $fetch_query);
    $doctor = mysqli_fetch_assoc($result);

    if (!$doctor) {
        die("Doctor not found.");
    }
} else {
    header("Location: ShowDoctor.php");
    exit();
}

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialisation = mysqli_real_escape_string($conn, $_POST['specialisation']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    // Check if these column names match your DB exactly (case-sensitive)
    $update_sql = "UPDATE doctor SET name='$name', specialisation='$specialisation', contact='$contact' WHERE DID='$did'";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>
                alert('Updated! Affecting ' + " . mysqli_affected_rows($conn) . " + ' row(s).');
                window.location.href = 'ShowDoctor.php';
              </script>";
    } else {
        // This will tell us if 'spec' or 'contact' columns don't actually exist
        die("SQL Error: " . mysqli_error($conn)); 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="adminmain.css">
    <title>Admin | Edit Doctor</title>
    <style>
        .edit-container {
            background: rgba(255, 255, 255, 0.9);
            width: 400px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            font-family: cursive;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }
        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .input-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .update-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 18px;
            font-family: cursive;
        }
        .update-btn:hover { background-color: #45a049; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #333; text-decoration: none; }
    </style>
</head>
<body style="background-image: url(Images/Pic10.jpg); background-size: cover;">

    <div class="edit-container">
        <h2 style="text-align: center;">Edit Doctor Details</h2>
        <hr>
        
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST" action="">
            <div class="input-group">
                <label>Doctor Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>" required>
            </div>

            <div class="input-group">
                <label>Specialization:</label>
                <input type="text" name="specialisation" value="<?php echo htmlspecialchars($doctor['specialisation']); ?>" required>
            </div>

            <div class="input-group">
                <label>Contact Number:</label>
                <input type="text" name="contact" value="<?php echo htmlspecialchars($doctor['contact']); ?>" required>
            </div>

            <button type="submit" name="update" class="update-btn">Save Changes</button>
            <a href="ShowDoctor.php" class="back-link">← Back to List</a>
        </form>
    </div>

</body>
</html>