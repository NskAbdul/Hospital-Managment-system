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
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get logged-in patient ID
$email = $_SESSION['user_email'];
$patient_result = $conn->query("SELECT patient_id, name FROM patients WHERE email = '$email'");
$patient = $patient_result->fetch_assoc();
$patient_id = $patient['patient_id'];
$patient_name = $patient['name'];

// Fetch appointments with doctor info
$sql = "
    SELECT 
        a.appointment_id,
        a.problem,
        a.schedule_time,
        d.name AS doctor_name,
        d.specialization
    FROM appointments a
    JOIN doctors d ON a.doctor_id = d.doctor_id
    WHERE a.patient_id = $patient_id
    ORDER BY a.schedule_time DESC
";
$appointments = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Medical Checkups</title>
    <link rel="stylesheet" href="/HOSPITAL MANAGEMENT SYSTEM/style3.css">
</head>
<body>
<div class="appointment-container">
    <h2>Welcome, <?= $patient_name ?></h2>
    <h3>Your Medical Checkups</h3>

    <?php if ($appointments->num_rows > 0): ?>
        <table>
            <tr>
                <th>Doctor</th>
                <th>Specialization</th>
                <th>Problem</th>
                <th>Schedule</th>
            </tr>
            <?php while ($row = $appointments->fetch_assoc()): ?>
                <tr>
                    <td>Dr. <?= $row['doctor_name'] ?></td>
                    <td><?= $row['specialization'] ?></td>
                    <td><?= htmlspecialchars($row['problem']) ?></td>
                    <td><?= date("F j, Y, g:i a", strtotime($row['schedule_time'])) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No appointments booked yet.</p>
    <?php endif; ?>
    <a class="back-link" href="patient.php">← Back to Appointments</a>
</div>
</body>
</html>
