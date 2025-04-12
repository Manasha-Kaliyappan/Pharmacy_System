<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_system");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=prescriptions_report.csv');

$output = fopen("php://output", "w");

// Header row
fputcsv($output, array('User Name', 'Email', 'Prescription File', 'Uploaded On', 'Status'));

// Data
$query = "SELECT prescriptions.*, users.name, users.email 
          FROM prescriptions 
          JOIN users ON prescriptions.user_id = users.id 
          ORDER BY upload_time DESC";

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    fputcsv($output, array(
        $row['name'],
        $row['email'],
        $row['file_name'],
        $row['upload_time'],
        $row['status']
    ));
}

fclose($output);
exit();
?>
