<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'pharmacy_system';

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$users = mysqli_query($conn, "SELECT id, name, email, phone, address FROM users");
if (!$users) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f7;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        table {
            width: 95%;
            margin: 40px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-back {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
            width: 200px;
        }

        .btn-back:hover {
            background: #1a242f;
        }
    </style>
</head>
<body>
    <h2>Registered Users</h2>

    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($users)) { ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['phone']) ?></td>
            <td><?= htmlspecialchars($user['address']) ?></td>
        </tr>
        <?php } ?>
    </table>

    <a href="admin_dashboard.php" class="btn-back">Back to Dashboard</a>
</body>
</html>
