<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone    = $_POST['phone'];
    $address  = $_POST['address'];

    // Check if email already exists
    $check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        $message = "<div class='error'>Email already registered. Try a different one or <a href='login.php'>Login here</a>.</div>";
    } else {
        $sql = "INSERT INTO users (name, email, password, phone, address) 
                VALUES ('$name', '$email', '$password', '$phone', '$address')";

        if ($conn->query($sql) === TRUE) {
            $message = "<div class='success'>Registration successful! <a href='login.php'>Login here</a></div>";
        } else {
            $message = "<div class='error'>Error: " . $conn->error . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            background: linear-gradient(135deg, #dbe9f4, #f5fafd);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            width: 420px;
            margin: 60px auto;
            background: #fff;
            padding: 30px 35px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 12px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #333;
            font-weight: 500;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #27ae60;
            color: white;
            border: none;
            margin-top: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            padding: 12px;
        }

        input[type="submit"]:hover {
            background-color: #219150;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-top: 20px;
            text-align: center;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 6px;
            margin-top: 20px;
            text-align: center;
        }

        a {
            color: #2980b9;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>User Registration</h2>

    <?php if (!empty($message)) echo $message; ?>

    <form method="post" action="">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Phone:</label>
        <input type="text" name="phone">

        <label>Address:</label>
        <textarea name="address" rows="3"></textarea>

        <input type="submit" value="Register">

        <a href="index.php">← Back to Dashboard</a>

    </form>
</div>
</body>
</html>
