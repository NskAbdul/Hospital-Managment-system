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

// Fetch logged-in patient details
$email = $_SESSION['user_email'];
$patient_result = $conn->query("SELECT patient_id, name FROM patients WHERE email = '$email'");
$patient = $patient_result->fetch_assoc();
$patient_id = $patient['patient_id'];
$patient_name = $patient['name'];

// Fetch all doctors
$doctors = $conn->query("SELECT doctor_id, name, specialization FROM doctors");

$success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor_id'];
    $problem = $_POST['problem'];
    $schedule = $_POST['schedule'];

    // Insert into appointments table
    $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, problem, schedule_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $patient_id, $doctor_id, $problem, $schedule);
    
    if ($stmt->execute()) {
        $success = "Appointment successfully booked!";
        $conn->query("INSERT INTO prescriptions (doctor_id, patient_id, diagnosis, medicines, notes, date_issued)
                      VALUES ($doctor_id, $patient_id, '', '', '', CURDATE())");
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="/HOSPITAL MANAGEMENT SYSTEM/style2.css">
</head>
<body>
<div class="appointment-container">
    <h2>Hello, <?= $patient_name ?>! Book your appointment</h2>

    <?php if ($success) echo "<p class='success'>$success</p>"; ?>

    <form method="post">
        <input type="hidden" name="patient_id" value="<?= $patient_id ?>">

        <label>Your Name:</label>
        <input type="text" value="<?= $patient_name ?>" disabled />

        <label>Problem Description:</label>
        <textarea name="problem" rows="4" required></textarea>

        <label>Select Doctor:</label>
        <select name="doctor_id" required>
            <?php while ($d = $doctors->fetch_assoc()): ?>
                <option value="<?= $d['doctor_id'] ?>">
                    Dr. <?= $d['name'] ?> (<?= $d['specialization'] ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <label>Schedule Time:</label>
        <input type="datetime-local" name="schedule" required>

        <button type="submit">Book Appointment</button>
    </form>
    <a class="back-link" href="patient.php">← Back to Appointments</a>
</div>
</body>
</html>
