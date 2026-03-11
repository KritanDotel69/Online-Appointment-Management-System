<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | WeCare</title>
    <style>
        /* Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('Images/hand.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            color: #fff;
        }

        header {
            width: 100%;
            background: rgba(0,0,0,0.5);
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-family: cursive;
            font-size: 36px;
        }

        .logout-btn {
            background: #ff0157;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #d90048;
        }

        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            gap: 30px;
            margin-top: 60px;
            padding: 0 20px;
        }

        .card {
            background: rgba(0,0,0,0.6);
            width: 260px;
            border-radius: 15px;
            padding: 25px 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.5);
            transition: transform 0.3s, background 0.3s;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-10px);
            background: rgba(0,0,0,0.8);
        }

        .card h3 {
            font-family: cursive;
            font-size: 22px;
            margin-bottom: 15px;
            color: #ffdd57;
        }

        .card a {
            display: block;
            margin: 8px 0;
            font-size: 16px;
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .card a:hover {
            color: #ff0157;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 16px;
            color: rgba(255,255,255,0.7);
        }

        @media(max-width: 700px){
            .dashboard-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Mode</h1>
        <form method="POST" action="adminlogin.php">
            <button type="submit" class="logout-btn" name="logout">Logout</button>
        </form>
    </header>

    <div class="dashboard-container">
        <!-- Doctor Card -->
        <div class="card">
            <h3>Doctor Management</h3>
            <a href="NewDoctor.php">Add New Doctor</a>
            <a href="DeleteDoctor.php">Delete Doctor</a>
            <a href="DoctorSchedule.php">Doctor Schedules</a>
            <a href="ShowDoctor.php">Show All Doctors</a>
        </div>

        <!-- Clinic Card -->
        <div class="card">
            <h3>Clinic Management</h3>
            <a href="NewClinic.php">Add New Clinic</a>
            <a href="DeleteClinic.php">Delete Clinic</a>
            <a href="AddDoctorToClinic.php">Assign Doctor</a>
            <a href="DeleteDoctorFromClinic.php">Remove Doctor</a>
            <a href="ShowClinic.php">Show All Clinics</a>
        </div>

        <!-- Appointment Card -->
        <div class="card">
            <h3>Appointments</h3>
            <a href="AdminAppointments.php">View All Appointments</a>
        </div>
    </div>

    <footer>
        &copy; 2026 WeCare Online Appointment System
    </footer>
</body>
</html>