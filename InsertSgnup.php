<?php
session_start();
require_once("includes.html");
$conn = mysqli_connect('localhost', 'root', '', 'appointment');

// Move EVERYTHING inside the isset block
if (isset($_POST['signup'])) {
    // 1. Sanitize Inputs to prevent SQL Injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dob = mysqli_real_escape_string($conn, $_POST['DOB']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['pwd'];
    $passwordr = $_POST['pwdr'];

    // 2. Check if passwords match
    if ($password !== $passwordr) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    // 3. Check if Email already exists (uncommented and fixed)
    $query = "SELECT * FROM patient WHERE email='$email'";
    $data = mysqli_query($conn, $query);
    $num = mysqli_num_rows($data);

    if ($num >= 1) {
        echo "<script>
        swal({ 
            title: 'Email already exists!',
            text: 'Please register using another email ID',
            type: 'error' 
        }, function(){ window.location.href = 'signup.php'; });
        </script>";
    } else {
        // 4. Hash the password for safety
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO patient(name, gender, dob, phone, username, password, email) 
                VALUES ('$name', '$gender', '$dob', '$contact', '$username', '$hashed_password', '$email')";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            echo "<script>
            swal({ 
                title: 'Sign Up Successful!',
                text: 'Welcome!',
                type: 'success' 
            }, function(){ window.location.href = 'Login.php'; });
            </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>