<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_system");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prescription_id = $_POST['prescription_id'];
    $new_status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE prescriptions SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $prescription_id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}
?>
