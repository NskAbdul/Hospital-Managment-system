<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "NskAbdul@786";
$dbname = "Hospital";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get patient ID
$email = $conn->real_escape_string($_SESSION['user_email']);
$patient_result = $conn->query("SELECT patient_id, name FROM patients WHERE email = '$email'");

if ($patient_result->num_rows == 0) {
    echo "Patient not found.";
    exit();
}

$patient = $patient_result->fetch_assoc();
$patient_id = $patient['patient_id'];
$patient_name = $patient['name'];

// Fetch prescriptions with doctor info
$sql = "
    SELECT 
        p.prescription_id,
        p.diagnosis,
        p.medicines,
        p.notes,
        p.date_issued,
        d.name AS doctor_name
    FROM prescriptions p
    JOIN doctors d ON p.doctor_id = d.doctor_id
    WHERE p.patient_id = $patient_id
    ORDER BY p.date_issued DESC
";
$prescriptions = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Prescriptions</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style.css">
    <link rel="stylesheet" href="/Hospital%20Management%20System/style3.css">
</head>
<body>
<div class="appointment-container">
    <h2>Welcome, <?= htmlspecialchars($patient_name) ?></h2>
    <h3>Your Prescriptions</h3>

    <?php if ($prescriptions && $prescriptions->num_rows > 0): ?>
        <table>
            <tr>
                <th>Doctor</th>
                <th>Diagnosis</th>
                <th>Medicines</th>
                <th>Notes</th>
                <th>Date Issued</th>
            </tr>
            <?php while ($row = $prescriptions->fetch_assoc()): ?>
                <tr>
                    <td>Dr. <?= htmlspecialchars($row['doctor_name']) ?></td>
                    <td><?= htmlspecialchars($row['diagnosis']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['medicines'])) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['notes'])) ?></td>
                    <td><?= date("F j, Y", strtotime($row['date_issued'])) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No prescriptions available.</p>
    <?php endif; ?>
    <a class="back-link" href="patient.php">← Back to Appointments</a>
</div>
</body>
</html>
