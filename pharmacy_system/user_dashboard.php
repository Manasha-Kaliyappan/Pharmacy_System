<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #c9d6ff, #e2e2e2);
            padding: 60px;
            margin: 0;
        }

        .container {
            background: #fff;
            max-width: 600px;
            margin: auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #2d3436;
            margin-bottom: 30px;
        }

        .welcome {
            font-size: 18px;
            margin-bottom: 25px;
            color: #555;
        }

        .btn {
            display: block;
            width: 80%;
            margin: 15px auto;
            padding: 15px;
            font-size: 16px;
            background-color: #2980b9;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #1f5f91;
        }

        .logout {
            background-color: #e74c3c;
        }

        .logout:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome to Your Dashboard</h2>
    <div class="welcome">Hello, <?= htmlspecialchars($user_name) ?>!</div>

    <a class="btn" href="search_medicines.php">🔍 Search Medicines</a>
<a class="btn" href="request_medicine.php">📨 Request Medicine</a>
<a class="btn" href="place_order.php">🛒 Place New Order</a>
<a class="btn" href="user_orders.php">🧾 View My Orders</a>

    <a class="btn logout" href="logout.php">🚪 Logout</a>
</div>

</body>
</html>
