<!DOCTYPE html>
<html>
<head>
    <title>Pharmacy Order & Delivery System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        h1 {
            color: #2c3e50;
            font-size: 26px;
            margin-bottom: 30px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px 0;
            margin: 12px 0;
            background-color: #3498db;
            color: white;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2c80b4;
        }

        .footer {
            margin-top: 25px;
            font-size: 13px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>💊 Pharmacy Order & Delivery</h1>
    <a href="register.php" class="btn">📝 Register</a>
    <a href="login.php" class="btn">👤 User Login</a>
    <a href="admin_login.php" class="btn">🛠️ Admin Login</a>
    <div class="footer">© <?= date('Y') ?> Pharmacy System</div>
</div>

</body>
</html>
