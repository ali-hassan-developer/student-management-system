<?php
include 'db.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['pswrd'];
    $role     = $_POST['role'];

    if (empty($username) || empty($email) || empty($password)) {
        $msg = "<div class='alert alert-danger'>All fields are required.</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<div class='alert alert-danger'>Invalid email format.</div>";
    } elseif (strlen($password) < 6) {
        $msg = "<div class='alert alert-danger'>Password must be at least 6 characters.</div>";
    } else {
        // Duplicate email check
        $check = $conn->prepare("SELECT id FROM users WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $msg = "<div class='alert alert-danger'>Email already exists. Please login.</div>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, is_active) VALUES (?, ?, ?, ?, 1)");
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

            if ($stmt->execute()) {
                $msg = "<div class='alert alert-success'>Registration successful! <a href='login.php'>Login Now</a></div>";
            } else {
                $msg = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
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

        select.form-control {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        select.form-control option {
            color: #000;
        }

        .mt-3 a {
            color: #ff9800;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .mt-3 a:hover {
            color: #fff;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="card">
    <h3>Sign Up</h3>
    <?php if ($msg) echo $msg; ?>
    <form method="post">
        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter Username" required>
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required>
        </div>
        <div class="mb-3">
            <label for="pswrd">Password</label>
            <input type="password" id="pswrd" name="pswrd" class="form-control" placeholder="Enter Password" required>
        </div>
        <div class="mb-3">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-control" required>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button class="btn btn-success w-100">Register</button>
    </form>
    <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
