# 🎓 Student Management System

A simple **Student Management System** built with **PHP & MySQL**.
This project allows **Admins, Teachers, and Students** to log in and perform role-specific tasks.

---
## 📸 Screenshots

### Admin Dashboard

* Manage Users (Admins, Teachers, Students)
* Manage Classes
* Manage Students
* View Audit Logs
  
![Admin Dashboard](screenshots/2025-09-29%2016_03_54-Admin%20Dashboard.png)

### Teacher Dashboard

* View Students
* Update Marks
* Mark Attendance
  
![Teacher Dashboard](screenshots/2025-09-29%2016_08_54-Teacher%20Dashboard.png)

### Student Dashboard

* View Profile
* View Marks
* View Attendance
  
![Student Dashboard](screenshots/2025-09-29%2016_11_01-Student%20Dashboard.png)

---

## 🛠️ Tech Stack

* **Frontend:** HTML, CSS, Bootstrap 5
* **Backend:** PHP (Core PHP, Sessions)
* **Database:** MySQL
* **Version Control:** Git & GitHub

---



## ⚙️ Installation

1. Clone the repository

   ```bash
   git clone https://github.com/ali-hassan-developer/student-management-system.git
   ```

2. Move to project folder

   ```bash
   cd student-management-system
   ```

3. Import the database

   * Open `phpMyAdmin`
   * Create a new database (e.g., `student_db`)
   * Import the provided `.sql` file

4. Update database credentials in `db.php`

   ```php
   $servername = "localhost";
   $username   = "root";
   $password   = "";
   $dbname     = "login_system";
   ```

5. Start the project

   * Place the project in `htdocs` (XAMPP)
   * Run: `http://localhost/student-management-system/`

---

## 👨‍💻 Author

Developed by **Ali Hassan**

* GitHub: [ali-hassan-developer](https://github.com/ali-hassan-developer)

---
