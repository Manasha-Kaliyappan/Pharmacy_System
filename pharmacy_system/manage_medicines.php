<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "pharmacy_system"); // Replace with your DB details
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$edit_mode = false;
$edit_data = null;
$success_message = "";
$error_message = "";

// Handle Edit
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_query = "SELECT * FROM medicines WHERE id = $edit_id";
    $edit_result = mysqli_query($conn, $edit_query);
    if ($edit_result && mysqli_num_rows($edit_result) > 0) {
        $edit_data = mysqli_fetch_assoc($edit_result);
        $edit_mode = true;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM medicines WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_query)) {
        $success_message = "Medicine deleted successfully.";
    } else {
        $error_message = "Error deleting medicine.";
    }
}

// Handle Add
if (isset($_POST['add_medicine'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    $add_query = "INSERT INTO medicines (name, description, price, stock_quantity)
                  VALUES ('$name', '$description', $price, $stock)";
    if (mysqli_query($conn, $add_query)) {
        $success_message = "Medicine added successfully.";
    } else {
        $error_message = "Failed to add medicine.";
    }
}

// Handle Update
if (isset($_POST['update_medicine'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    $update_query = "UPDATE medicines SET name='$name', description='$description', price=$price, stock_quantity=$stock WHERE id=$id";
    if (mysqli_query($conn, $update_query)) {
        $success_message = "Medicine updated successfully.";
        $edit_mode = false;
    } else {
        $error_message = "Failed to update medicine.";
    }
}

// Search or Fetch All
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
if (!empty($search)) {
    $query = "SELECT * FROM medicines WHERE name LIKE '%$search%'";
} else {
    $query = "SELECT * FROM medicines";
}
$result = mysqli_query($conn, $query);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Manage Medicines</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-top: 20px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 30px 40px;
            flex-wrap: wrap;
        }

        .form-section, .table-section {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-section {
            flex: 1;
            min-width: 300px;
            max-width: 400px;
        }

        .table-section {
            flex: 2;
            min-width: 500px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background: #27ae60;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background: #219150;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        .edit-btn, .delete-btn {
            padding: 6px 10px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
        }

        .edit-btn {
            background-color: #f39c12;
        }

        .edit-btn:hover {
            background-color: #d68910;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .footer-btns {
            text-align: center;
            margin: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            color: white;
            margin: 0 10px;
        }

        .btn-dashboard {
            background-color: #34495e;
        }

        .btn-dashboard:hover {
            background-color: #2c3e50;
        }

        .btn-export {
            background-color: #27ae60;
        }

        .btn-export:hover {
            background-color: #219150;
        }

        .message {
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }

        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<h2><?= $edit_mode ? "Edit Medicine" : "Add Medicine" ?></h2>
<?php if (isset($success_message)) echo "<div class='message success'>$success_message</div>"; ?>
<?php if (isset($error_message)) echo "<div class='message error'>$error_message</div>"; ?>

<div class="container">
    <div class="form-section">
        <form method="post">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
            <?php endif; ?>
            <input type="text" name="name" placeholder="Medicine Name" required value="<?= $edit_mode ? $edit_data['name'] : '' ?>">
            <textarea name="description" placeholder="Description" rows="3" required><?= $edit_mode ? $edit_data['description'] : '' ?></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price (e.g. 99.99)" required value="<?= $edit_mode ? $edit_data['price'] : '' ?>">
            <input type="number" name="stock" placeholder="Stock Quantity" required value="<?= $edit_mode ? $edit_data['stock_quantity'] : '' ?>">
            <input type="submit" name="<?= $edit_mode ? 'update_medicine' : 'add_medicine' ?>" value="<?= $edit_mode ? 'Update Medicine' : 'Add Medicine' ?>">
        </form>
    </div>

    <div class="table-section">
        <form method="get">
            <input type="text" name="search" placeholder="Search by medicine name..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <input type="submit" value="Search">
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Medicine Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>₹<?= number_format($row['price'], 2) ?></td>
                    <td><?= $row['stock_quantity'] ?></td>
                    <td>
                        <a class="edit-btn" href="?edit=<?= $row['id'] ?>">Edit</a>
                        <a class="delete-btn" href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure to delete this medicine?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="footer-btns">
    <a href="admin_dashboard.php" class="btn btn-dashboard">Back to Dashboard</a>
    <a href="export_csv.php" class="btn btn-export">Export as CSV</a>
</div>

</body>
</html>
