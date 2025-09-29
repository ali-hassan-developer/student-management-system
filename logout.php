<?php
session_start();
require 'db.php';
require 'functions.php';

// 👤 Save user info before destroying session
$user_id   = $_SESSION['user_id'] ?? null;
$username  = $_SESSION['username'] ?? 'Unknown';

// 🔒 Audit log (agar user login tha)
if ($user_id) {
    log_audit($conn, $user_id, 'Auth', 'Logout', "User $username logged out", 'success');
}

// ❌ Destroy session
session_unset();
session_destroy();

// 🔄 Redirect
header("Location: login.php");
exit();
