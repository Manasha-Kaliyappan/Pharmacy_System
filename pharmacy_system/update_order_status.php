<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy_system");

$orderId = $_GET['id'] ?? '';
$action = $_GET['action'] ?? '';

if (!$orderId || !in_array($action, ['approve', 'reject'])) {
    header("Location: view_orders.php");
    exit();
}

$status = $action === 'approve' ? 'Approved' : 'Rejected';
$conn->query("UPDATE orders SET status='$status' WHERE id=$orderId");

header("Location: view_orders.php");
exit();
?>
