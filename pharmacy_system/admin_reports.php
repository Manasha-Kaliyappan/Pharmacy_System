<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = ''; // default in XAMPP
$database = 'pharmacy_system';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch total users
$result_users = mysqli_query($conn, "SELECT COUNT(*) as total_users FROM users");
$row_users = mysqli_fetch_assoc($result_users);
$total_users = $row_users['total_users'];

// Fetch total orders
$result_orders = mysqli_query($conn, "SELECT COUNT(*) as total_orders FROM orders");
$row_orders = mysqli_fetch_assoc($result_orders);
$total_orders = $row_orders['total_orders'];

// Fetch total medicines
$result_medicines = mysqli_query($conn, "SELECT COUNT(*) as total_medicines FROM medicines");
$row_medicines = mysqli_fetch_assoc($result_medicines);
$total_medicines = $row_medicines['total_medicines'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 40px auto;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        .report-box {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }

        .box {
            width: 30%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
        }

        .box h2 {
            font-size: 30px;
            margin: 0;
            color: #2980b9;
        }

        .box p {
            font-size: 18px;
            margin-top: 10px;
            color: #555;
        }

        .btn-back {
            display: block;
            width: 200px;
            margin: 40px auto;
            padding: 10px 20px;
            text-align: center;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn-back:hover {
            background: #1a242f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard Reports</h1>
        <div class="report-box">
            <div class="box">
                <h2><?= $total_users ?></h2>
                <p>Total Registered Users</p>
            </div>
            <div class="box">
                <h2><?= $total_orders ?></h2>
                <p>Total Orders</p>
            </div>
            <div class="box">
                <h2><?= $total_medicines ?></h2>
                <p>Total Medicines Available</p>
            </div>
        </div>
        <a href="admin_dashboard.php" class="btn-back">Back to Dashboard</a>
    </div>
</body>
</html>
