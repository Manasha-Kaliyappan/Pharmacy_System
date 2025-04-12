<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #ecf0f1;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #2c3e50;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 40px;
        }

        .card {
            background-color: white;
            width: 220px;
            margin: 20px;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 15px rgba(0,0,0,0.15);
        }

        .card a {
            text-decoration: none;
            color: #3498db;
            font-size: 18px;
            font-weight: bold;
        }

        .logout {
            display: block;
            text-align: center;
            margin: 30px auto;
            width: 180px;
            padding: 10px;
            background: #e74c3c;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .logout:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Welcome, Admin</h1>
    </div>

    <div class="dashboard">
        <div class="card">
            <a href="view_orders.php">View Orders</a>
        </div>
        <div class="card">
            <a href="manage_medicines.php">Manage Medicines</a>
        </div>
        <div class="card">
            <a href="user_list.php">View Users</a>
        </div>
        <div class="card">
            <a href="admin_reports.php">Reports</a>
        </div>
        <div class="card">
        <a href="view_requested_medicines.php">📦 View Requested Medicines</a>
</div
    </div>

    <a href="admin_logout.php" class="logout">Logout</a>

</body>
</html>
