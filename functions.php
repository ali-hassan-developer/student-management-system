<?php
function log_audit($conn, $user_id, $module, $action, $details = '', $status = 'success') {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $device = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

    $stmt = $conn->prepare("
        INSERT INTO audit_logs (user_id, module, action, details, status, ip_address, device_info)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("issssss", $user_id, $module, $action, $details, $status, $ip, $device);
    $stmt->execute();
    $stmt->close();
}
?>
