<?php
session_start();

if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctorlogin.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];
$appointment_id = $_GET['appointment_id'];

$conn = new mysqli("localhost", "root", "NskAbdul@786", "Hospital");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointment details
$appointment_sql = "SELECT a.*, p.* FROM appointments a 
JOIN patients p ON a.patient_id = p.patient_id 
WHERE a.appointment_id = $appointment_id AND a.doctor_id = $doctor_id";
$appointment_result = $conn->query($appointment_sql);

if ($appointment_result->num_rows != 1) {
    die("Invalid appointment.");
}

$appointment = $appointment_result->fetch_assoc();
$patient_id = $appointment['patient_id'];

// Handle prescription submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diagnosis = $_POST['diagnosis'];
    $medicines = $_POST['medicines'];
    $notes = $_POST['notes'];

    $insert_sql = "INSERT INTO prescriptions (doctor_id, patient_id, diagnosis, medicines, notes, date_issued)
                   VALUES ($doctor_id, $patient_id, $diagnosis, $medicines, $notes, CURDATE())";

$conn->query("UPDATE appointments SET status = 'Completed' WHERE appointment_id = $appointment_id");
header("Location: doctor_appointment.php");
exit();
}

// Fetch prescription history
$history_sql = "SELECT * FROM prescriptions WHERE patient_id = $patient_id ORDER BY date_issued DESC";
$history_result = $conn->query($history_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prescription</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style.css">
    <style>
        .container {
            max-width: 800px;
            margin: auto;
            margin-top: 40px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #00796b;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        button {
            background-color: #00796b;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            margin-top: 20px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #004d40;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #00796b;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .history {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Prescribe Medication</h2>

        <h4>Patient: <?= htmlspecialchars($appointment['name']) ?> | Age: <?= date_diff(date_create($appointment['dob']), date_create('today'))->y ?> | Gender: <?= $appointment['gender'] ?></h4>
        <p><strong>Problem:</strong> <?= htmlspecialchars($appointment['problem']) ?></p>

        <form method="POST">
            <label for="diagnosis">Diagnosis</label>
            <textarea name="diagnosis" required></textarea>

            <label for="medicines">Medicines</label>
            <textarea name="medicines" required></textarea>

            <label for="notes">Additional Notes</label>
            <textarea name="notes"></textarea>

            <button type="submit">Submit Prescription</button>
        </form>

        <div class="history">
            <h3>Previous Prescriptions</h3>
            <?php if ($history_result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Diagnosis</th>
                        <th>Medicines</th>
                        <th>Notes</th>
                    </tr>
                    <?php while ($row = $history_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['date_issued'] ?></td>
                            <td><?= htmlspecialchars($row['diagnosis']) ?></td>
                            <td><?= htmlspecialchars($row['medicines']) ?></td>
                            <td><?= htmlspecialchars($row['notes']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No previous prescriptions found.</p>
            <?php endif; ?>
        </div>

        <a class="back-link" href="doctorappointments.php">← Back to Appointments</a>
    </div>
</body>
</html>
