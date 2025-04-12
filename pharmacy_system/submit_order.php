<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "pharmacy_system");

    $user_id = $_SESSION['user_id'];
    $medicine_id = $_POST['medicine_id'];
    $quantity = $_POST['quantity'];

    // Get the medicine name based on ID
    $medicine_query = $conn->query("SELECT name FROM medicines WHERE id = $medicine_id");
    $medicine = $medicine_query->fetch_assoc();

    if (!$medicine) {
        echo "Invalid medicine selected.";
        exit();
    }

    $medicine_name = $medicine['name'];
    $status = "Pending";
    $order_date = date('Y-m-d H:i:s');

    // Insert into orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, medicine_name, quantity, status, order_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isiss", $user_id, $medicine_name, $quantity, $status, $order_date);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Order placed successfully!'); window.location.href='user_dashboard.php';</script>";
    } else {
        echo "❌ Error placing order: " . $conn->error;
    }
}
?>
