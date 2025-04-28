<?php
session_start();
if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

$conn = new mysqli("localhost", "root", "NskAbdul@786", "Hospital");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT a.appointment_id, a.schedule_time, a.problem, a.status,
               p.patient_id, p.name AS patient_name, p.email, p.phone
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id
        WHERE a.doctor_id = $doctor_id AND a.status = 'Not Visited'
        ORDER BY a.schedule_time ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Appointments</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style4.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-btn {
            padding: 6px 12px;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .action-btn:hover {
            background-color: #004d40;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
        }

        h2 {
            color: #00796b;
            text-align: center;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #00796b;
            font-weight: bold;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Upcoming Appointments</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Problem</th>
                        <th>Scheduled Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['patient_name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td><?= htmlspecialchars($row['problem']) ?></td>
                            <td><?= htmlspecialchars($row['schedule_time']) ?></td>
                            <td>
                                <a class="action-btn" href="prescribe.php?appointment_id=<?= $row['appointment_id'] ?>&patient_id=<?= $row['patient_id'] ?>">
                                    Prescribe / Update
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #c62828;">No upcoming appointments found.</p>
        <?php endif; ?>

        <div class="back-link">
            <a href="doctor.php">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
