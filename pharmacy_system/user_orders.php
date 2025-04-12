<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy_system");
$userId = $_SESSION['user_id'];

$query = "SELECT medicine_name, quantity, status, order_date FROM orders WHERE user_id = $userId ORDER BY order_date DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
            background-color: #f4f6f7;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
        }
        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .status-approved {
            color: green;
            font-weight: bold;
        }
        .status-rejected {
            color: red;
            font-weight: bold;
        }
        .status-pending {
            color: orange;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📦 My Orders</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Medicine</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['medicine_name']) ?></td>
                    <td><?= htmlspecialchars($row['quantity']) ?></td>
                    <td class="status-<?= strtolower($row['status']) ?>">
                        <?= htmlspecialchars($row['status']) ?>
                    </td>
                    <td><?= htmlspecialchars($row['order_date']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You haven't placed any orders yet.</p>
    <?php endif; ?>
    <a href="user_dashboard.php">← Back to Dashboard</a>

</div>
</body>
</html>
