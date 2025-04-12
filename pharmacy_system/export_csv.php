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

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=medicines.csv');

$output = fopen("php://output", "w");
fputcsv($output, array('ID', 'Medicine Name', 'Description', 'Price', 'Stock'));

$query = "SELECT * FROM medicines";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, array(
            $row['id'],
            $row['name'],
            $row['description'],
            $row['price'],
            $row['stock_quantity']
        ));
    }
}

fclose($output);
exit();
?>
