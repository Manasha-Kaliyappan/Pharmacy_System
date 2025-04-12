<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy_system");

// Fetch 10 medicines from the database
$medicines = $conn->query("SELECT id, name FROM medicines LIMIT 10");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Place Order</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f2f6;
            padding: 50px;
        }

        .container {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
        }

        select, input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🛒 Place a Medicine Order</h2>
    <form action="submit_order.php" method="post">
        <label for="medicine">Select Medicine:</label>
        <select name="medicine_id" id="medicine" required>
            <option value="" disabled selected>-- Choose Medicine --</option>
            <?php while($row = $medicines->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
            <?php endwhile; ?>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" required>

        <input type="submit" value="Place Order">
        <a href="user_dashboard.php">← Back to Dashboard</a>

    </form>
</div>

</body>
</html>
