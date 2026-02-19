<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect('localhost', 'root', '', 'appointment');

$message = "";
$msg_class = "";

if (isset($_POST['signup'])) {
    
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $contact  = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = $_POST['pwd'];
    $passwordr = $_POST['pwdr'];

    // 1. PHP Server-Side Validation: Check if name contains only letters and spaces
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $message = "Full Name must contain only letters and spaces!";
        $msg_class = "error";
    } 
    // 2. Check if passwords match
    elseif ($password !== $passwordr) {
        $message = "Passwords do not match!";
        $msg_class = "error";
    } 
    else {
        $check_query = "SELECT * FROM patient WHERE email='$email' OR username='$username'";
        $result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($result) > 0) {
            $message = "Username or Email already exists!";
            $msg_class = "error";
        } else {
            // 3. Hash password and Insert
            $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO patient (name, username, email, phone, password) 
                    VALUES ('$name', '$username', '$email', '$contact', '$hashed_pwd')";
            
            if (mysqli_query($conn, $sql)) {
                $message = "Registration Successful! <a href='Login.php'>Login here</a>";
                $msg_class = "success";
            } else {
                $message = "Database Error: " . mysqli_error($conn);
                $msg_class = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | WeCare</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('Images/appointment.png');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .signup-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            width: 400px;
        }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        .input-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #666; font-size: 14px; }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #ff0157;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover { background: #d90048; letter-spacing: 1px; }
        .msg {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }
        .error { background: #f8d7da; color: #721c24; }
        .success { background: #d4edda; color: #155724; }
        .footer-link { text-align: center; margin-top: 15px; font-size: 14px; }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Create Account</h2>

    <?php if($message != ""): ?>
        <div class="msg <?php echo $msg_class; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="signup.php">
        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="name" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" placeholder="John Doe">
        </div>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required placeholder="johndoe123">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="john@example.com">
        </div>
        <div class="input-group">
            <label>Contact Number</label>
            <input type="tel" name="contact" pattern="[0-9]{10,}" required placeholder="1234567890">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="pwd" minlength="6" required placeholder="Min 6 characters">
        </div>
        <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="pwdr" required placeholder="Repeat password">
        </div>
        
        <button type="submit" name="signup" class="btn">Register Now</button>
    </form>

    <div class="footer-link">
        Already have an account? <a href="Login.php" style="color: #ff0157;">Login</a>
    </div>
</div>

</body>
</html>