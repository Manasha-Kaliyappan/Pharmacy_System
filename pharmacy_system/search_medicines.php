<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy_system");

$results = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $conn->real_escape_string($_POST['search']);
    $query = "SELECT name, description, stock_quantity FROM medicines WHERE name LIKE '%$search%'";
    $results = $conn->query($query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Medicines</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 50px;
            background: #f7f7f7;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        input[type="text"], button {
            padding: 12px;
            font-size: 16px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: auto;
            padding: 12px 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-left: 10px;
        }
        button:hover {
            background-color: #219150;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f0f0f0;
        }
        a {
            display: block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .no-result {
            margin-top: 20px;
            color: #e74c3c;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>🔍 Search Medicines</h2>
    <form method="POST">
        <input type="text" name="search" placeholder="Enter medicine name..." required>
        <button type="submit">Search</button>
    </form>

    <?php if (!empty($results) && $results->num_rows > 0): ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Availability</th>
            </tr>
            <?php while ($row = $results->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>
                        <?= ($row['stock_quantity'] > 0) 
                            ? "Available ({$row['stock_quantity']})"
                            : "Out of Stock" ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p class="no-result">No medicine found. <a href="request_medicine.php">Request this medicine?</a></p>
    <?php endif; ?>

    <a href="user_dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>
