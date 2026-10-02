
# 🏥 Online Appointment Management System

A web-based appointment booking platform that connects patients with doctors and clinics. Patients can search for doctors by region, view schedules, and book or cancel appointments online. Administrators manage clinics, doctors, schedules, and appointment statuses from a dedicated admin panel.

Built with **PHP**, **MySQL**, **HTML/CSS**, and **jQuery (AJAX)**.

---

## 📑 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Database](#-database)
- [Installation & Setup](#-installation--setup)
- [Usage](#-usage)
- [Screenshots](#-screenshots)
- [Security Notes](#-security-notes)
- [Future Improvements](#-future-improvements)
- [Author](#-author)

---

## 📖 Overview

Booking a doctor's appointment often means phone calls, long queues, and double bookings. This system moves the process online:

- **Patients** register, log in, find a doctor by region and clinic, pick an available day, and book a slot.
- **Admins** add and manage clinics and doctors, assign doctors to clinics, set doctor schedules, and update appointment statuses.

---

## ✨ Features

### 👤 Patient / User
- User registration and login
- Personal dashboard
- Browse doctors and clinics, filtered by **region and town**
- View a doctor's available **days and schedule**
- Book an appointment for an available day
- View booked appointments
- Cancel an existing booking

### 🛠️ Admin
- Separate admin login with validation
- Admin dashboard
- **Clinic management:** add, view, edit, delete
- **Doctor management:** add, view, edit, delete
- **Doctor–clinic assignment:** add or remove a doctor from a clinic
- **Doctor schedule management**
- View all appointments and **update appointment status**

### ⚙️ General
- Dynamic dependent dropdowns (region → town → clinic → doctor → day) using jQuery and AJAX
- Responsive-friendly layout with separate stylesheets for the user and admin interfaces

---

## 🧰 Tech Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML5, CSS3, JavaScript, jQuery |
| Backend | PHP |
| Database | MySQL |
| Server (local) | Apache (XAMPP / WAMP / LAMP) |
| Version Control | Git & GitHub |

---

## 📂 Project Structure

```
Online-Appointment-Management-System/
│
├── css/                      # Stylesheets
├── Images/                   # Site images and assets
├── snapshots/                # Project screenshots
├── database/                 # Database files (SQL)
├── signup/                   # Signup-related assets/pages
├── Extra/                    # Additional resources
│
├── Home.php                  # Landing page
├── Signup.php                # User registration form
├── InsertSgnup.php           # Handles registration
├── Login.php                 # User login form
├── InsertLogin.php           # Handles login
├── userDashboard.php         # Patient dashboard
├── Booking.php               # Appointment booking page
├── ViewAppointment.php       # View booked appointments
├── CancelBooking.php         # Cancel an appointment
│
├── adminlogin.php            # Admin login form
├── adminvalidate.php         # Admin authentication
├── AdminPage.php             # Admin dashboard
├── AdminAppointments.php     # Manage all appointments
├── updatestatus.php          # Update appointment status
│
├── NewClinic.php             # Add a clinic
├── ShowClinic.php            # List clinics
├── EditClinic.php            # Edit a clinic
├── DeleteClinic.php          # Delete a clinic
│
├── NewDoctor.php             # Add a doctor form
├── insertdoctor.php          # Handles doctor insertion
├── ShowDoctor.php            # List doctors
├── EditDoctor.php            # Edit a doctor
├── DeleteDoctor.php          # Delete a doctor
├── deletedocfromdb.php       # Remove doctor record from the database
├── AddDoctorToClinic.php     # Assign a doctor to a clinic
├── DeleteDoctorFromClinic.php# Remove a doctor from a clinic
├── DoctorSchedule.php        # Manage doctor schedules
│
├── get_town.php              # AJAX: towns by region
├── getclinic.php             # AJAX: clinics
├── getdoctor.php             # AJAX: doctors
├── getdoctorregion.php       # AJAX: doctors by region
├── getDay.php                # AJAX: available days
├── getdoctorday.php          # AJAX: doctor's days
├── getdoctordaybooking.php   # AJAX: booking availability
│
├── DBconnect.php             # Database connection
├── jquerypart.js             # jQuery / AJAX logic
├── main.css                  # Main stylesheet
├── adminmain.css             # Admin stylesheet
└── includes.html             # Shared HTML includes
```

---

## 🗄️ Database

The database files are in the `database/` folder.

The system revolves around these core entities:

| Entity | Purpose |
|--------|---------|
| Users | Registered patients |
| Admin | Administrator accounts |
| Clinics | Clinic details and location (region/town) |
| Doctors | Doctor profiles |
| Doctor–Clinic | Links doctors to the clinics they work at |
| Schedules | Days/times a doctor is available |
| Appointments | Bookings with patient, doctor, clinic, date, and status |

> 📌 *Table and column names may differ slightly. Check the SQL file in `database/` for the exact schema.*

---

## 🚀 Installation & Setup

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) (or WAMP/LAMP) with **PHP** and **MySQL**
- A web browser
- Git (optional)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/KritanDotel69/Online-Appointment-Management-System.git
   ```

2. **Move the project into your server directory**
   - XAMPP: copy the folder into `C:\xampp\htdocs\`
   - Linux (LAMP): copy into `/var/www/html/`

3. **Start Apache and MySQL** from the XAMPP control panel.

4. **Create the database**
   - Open `http://localhost/phpmyadmin`
   - Create a new database (e.g. `appointment_db`)
   - Click **Import** and select the `.sql` file from the `database/` folder

5. **Configure the database connection**

   Open `DBconnect.php` and update the credentials to match your setup:
   ```php
   <?php
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "appointment_db"; // use the name you created
   ?>
   ```

6. **Run the project**

   Visit: `http://localhost/Online-Appointment-Management-System/Home.php`

---

## 💡 Usage

### As a Patient
1. Open the home page and **sign up** for an account
2. **Log in** to reach your dashboard
3. Go to **Booking**, then select region → town → clinic → doctor → day
4. Confirm the appointment
5. Use **View Appointment** to see your bookings, or **Cancel Booking** to cancel one

### As an Admin
1. Open `adminlogin.php` and log in with admin credentials
2. Use the admin dashboard to:
   - Add or edit **clinics** and **doctors**
   - Assign doctors to clinics and set **schedules**
   - Review **appointments** and update their **status**

> 🔑 *Add your default admin credentials here for demo purposes, and change them before any real deployment.*

---

## 📸 Screenshots

Screenshots are available in the [`snapshots/`](./snapshots) folder. You can embed them here:

```markdown
![Home Page](snapshots/home.png)
![Booking Page](snapshots/booking.png)
![Admin Dashboard](snapshots/admin.png)
```

*(Replace the file names above with your actual screenshot names.)*

---

## 🔒 Security Notes

This is a learning project. Before using it in any real environment, consider:

- Using **prepared statements (PDO / MySQLi)** to prevent SQL injection
- Hashing passwords with `password_hash()` and verifying with `password_verify()`
- Validating and sanitizing all user input on the server side
- Using session checks on every protected page
- Adding CSRF protection to forms
- Never committing real database credentials to GitHub

---

## 🔮 Future Improvements

- [ ] Email or SMS appointment confirmations and reminders
- [ ] Time-slot based booking (not just by day)
- [ ] Doctor login portal to view their own appointments
- [ ] Search and filter by specialization
- [ ] Appointment rescheduling
- [ ] Fully responsive mobile UI
- [ ] Online payment integration
- [ ] Migrate to a PHP framework (e.g. Laravel)

---

## 📄 License

This project is open for learning and educational purposes. Add a license (e.g. MIT) if you plan to share it publicly.

---

⭐ If you found this project useful, consider giving it a star!
