<?php
session_start();

if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctorlogin.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

$conn = new mysqli("localhost", "root", "NskAbdul@786", "Hospital");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch completed appointments and patient details
$sql = "SELECT a.appointment_id, a.schedule_time, p.name AS patient_name, p.email AS patient_email, p.phone AS patient_phone, p.dob AS patient_dob, a.status
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id
        WHERE a.doctor_id = $doctor_id AND a.status = 'Completed'
        ORDER BY a.schedule_time DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patients Treated</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="history_style.css" />
</head>
<body>
    <div class="container">
        <h2>Patients Treated by You</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Patient Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Appointment Date</th>
                </tr>

                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['appointment_id'] ?></td>
                        <td><?= htmlspecialchars($row['patient_name']) ?></td>
                        <td><?= htmlspecialchars($row['patient_email']) ?></td>
                        <td><?= htmlspecialchars($row['patient_phone']) ?></td>
                        <td><?= date('Y-m-d', strtotime($row['patient_dob'])) ?></td>
                        <td><?= date('Y-m-d H:i', strtotime($row['schedule_time'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No patients found for your completed appointments.</p>
        <?php endif; ?>

        <a class="back-link" href="doctor.php">← Back to Dashboard</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
