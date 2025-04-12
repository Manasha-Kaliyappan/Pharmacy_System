<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy_system");

$query = "
SELECT o.id, u.name AS username, o.medicine_name, o.quantity, o.status, o.order_date
FROM orders o
JOIN users u ON o.user_id = u.id
ORDER BY o.order_date DESC
";


$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        h2 {
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>🧾 Orders List</h2>
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
        <tr>
    <th>User</th>
    <th>Medicine Name</th>
    <th>Quantity</th>
    <th>Status</th>
    <th>Ordered At</th>
    <th>Action</th>
</tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['medicine_name']) ?></td>
                    <td><?= htmlspecialchars($row['quantity']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
<td><?= htmlspecialchars($row['order_date']) ?></td>
<td>
    <?php if ($row['status'] === 'Pending'): ?>
        <a href="update_order_status.php?id=<?= $row['id'] ?>&action=approve" style="color:green; font-weight:bold;">Approve</a> |
        <a href="update_order_status.php?id=<?= $row['id'] ?>&action=reject" style="color:red; font-weight:bold;">Reject</a>
    <?php else: ?>
        <span style="color:gray;"><?= htmlspecialchars($row['status']) ?></span>
    <?php endif; ?>
</td>

                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
    <a href="admin_dashboard.php" class="back-link">← Back to Dashboard</a>
</div>
</body>
</html>
