<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy_system");

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_name = isset($_POST['medicine_name']) ? $conn->real_escape_string($_POST['medicine_name']) : '';
    $reason = isset($_POST['reason']) ? $conn->real_escape_string($_POST['reason']) : '';
    $user_id = $_SESSION['user_id'];
    $requested_at = date("Y-m-d H:i:s");

    if (!empty($medicine_name) && !empty($reason)) {
        $sql = "INSERT INTO medicine_requests (user_id, medicine_name, reason, requested_at) 
                VALUES ('$user_id', '$medicine_name', '$reason', '$requested_at')";
        if ($conn->query($sql)) {
            $success = "✅ Medicine request submitted successfully!";
        } else {
            $error = "❌ Failed to submit request: " . $conn->error;
        }
    } else {
        $error = "⚠️ Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Medicine</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 50px;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            padding: 12px 20px;
            background-color: #27ae60;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
        }
        a {
            display: block;
            margin-top: 20px;
            color: #3498db;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📦 Request a Medicine</h2>

    <?php if ($success): ?>
        <p class="message" style="color: green;"><?= $success ?></p>
    <?php elseif ($error): ?>
        <p class="message" style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="medicine_name">Medicine Name</label>
        <input type="text" name="medicine_name" id="medicine_name" placeholder="Enter medicine name..." required>

        <label for="reason">Why do you need this medicine?</label>
        <textarea name="reason" id="reason" rows="4" placeholder="Enter reason or description..." required></textarea>

        <button type="submit">Submit Request</button>
    </form>

    <a href="user_dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>
