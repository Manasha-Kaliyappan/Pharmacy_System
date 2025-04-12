<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy_system");

// ✅ Always initialize error
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Get user by email
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verify the hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: user_dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #f0f2f5;
        text-align: center;
        padding-top: 80px;
    }

    .container {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
        width: 400px;
        margin: auto;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    h2 {
        color: #2c3e50;
        margin-bottom: 20px;
    }

    input[type="email"], input[type="password"] {
        width: 92%;
        padding: 14px;
        margin: 12px 0;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
    }

    button {
        background-color: #27ae60;
        color: white;
        padding: 14px 24px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #219150;
    }

    .error {
        color: red;
        margin-bottom: 15px;
        font-size: 14px;
    }

    a {
        display: block;
        margin-top: 20px;
        text-decoration: none;
        color: #3498db;
        font-size: 14px;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

</head>
<body>
    <div class="container">
        <h2>👤 User Login</h2>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Enter Email" required><br>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <button type="submit">Login</button>
        </form>
        <a href="index.php">← Back to Home</a>
    </div>
</body>
</html>
