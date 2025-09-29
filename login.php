<?php
include 'db.php';
require 'functions.php';
session_start();
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname    = trim($_POST['uname']);
    $password = $_POST['pswrd'];

    $stmt = $conn->prepare("SELECT id, username, email, password, role, is_active 
                              FROM users 
                              WHERE email=? OR username=? LIMIT 1");
    $stmt->bind_param("ss", $uname, $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['is_active'] != 1) {
            $msg = "<div class='alert alert-warning'>Your account is disabled. Contact Admin.</div>";
        } elseif (password_verify($password, $row['password'])) {
            $_SESSION['user_id']  = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role']     = $row['role'];

            // Audit log
            log_audit($conn, $row['id'], 'Auth', 'Login', 'User logged in successfully', 'success');

            // Role-based redirect
            if ($row['role'] === "admin") {
                header("Location: admin_dashboard.php");
            } elseif ($row['role'] === "teacher") {
                header("Location: teacher_dashboard.php");
            } else {
                header("Location: students_dashboard.php");
            }
            exit();
        } else {
            $msg = "<div class='alert alert-danger'>Invalid password.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>No account found with this Username/Email.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e1e2d, #e77918);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
        }

        .card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            color: #fff;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease forwards;
        }

        .card h3 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
            animation: slideDown 0.8s ease forwards;
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .form-control::placeholder {
            color: #ddd;
        }

        .form-control:focus {
            border-color: #e77918;
            box-shadow: 0 0 8px #e77918;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .btn-success {
            background: linear-gradient(135deg, #e77918, #ff9800);
            border: none;
            font-weight: 600;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            transform: translateY(-3px) scale(1.03);
            background: linear-gradient(135deg, #cf670e, #e77918);
        }

        .mt-3 a {
            color: #ff9800;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .mt-3 a:hover {
            color: #fff;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <h3>Login</h3>
        <?php if ($msg) echo $msg; ?>
        <form method="post">
            <div class="mb-3">
                <label for="uname">Username or Email</label>
                <input type="text" id="uname" name="uname" class="form-control" placeholder="Enter Username or Email" required>
            </div>
            <div class="mb-3">
                <label for="pswrd">Password</label>
                <input type="password" id="pswrd" name="pswrd" class="form-control" placeholder="Enter Password" required>
            </div>
            <button class="btn btn-success w-100">Login</button>
        </form>
        <p class="mt-3 text-center">Don’t have an account? <a href="Sign_in.php">Register</a></p>
    </div>
</body>

</html>
