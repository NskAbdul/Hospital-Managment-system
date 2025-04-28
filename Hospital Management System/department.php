<?php
session_start();
$homeLink = isset($_SESSION['patient_id']) ? 'patient.php' : (isset($_SESSION['doctor_id']) ? 'doctor.php' : 'index.html');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Departments</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style.css">
    <style>
        body {
            background: #fff3e0;
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
        }

        .departments-container {
            max-width: 850px;
            margin: auto;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #ff7043;
            margin-bottom: 30px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color:lightgreen;
            margin: 12px 0;
            padding: 15px 20px;
            font-size: 18px;
        }

        .back-home {
            display: block;
            text-align: center;
            margin-top: 30px;
        }

        .back-home a {
            color: #ff7043;
            text-decoration: none;
            font-weight: bold;
        }

        .back-home a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="departments-container">
        <h2>Hospital Departments</h2>
        <ul>
            <li>Cardiology</li>
            <li>Neurology</li>
            <li>Orthopedics</li>
            <li>Pediatrics</li>
            <li>Ophthalmology</li>
            <li>ENT (Ear, Nose, Throat)</li>
            <li>Oncology</li>
            <li>Gynecology & Obstetrics</li>
            <li>Psychiatry</li>
            <li>General Medicine</li>
            <li>Pathology</li>
            <li>Pulmonology</li>
            <li>Surgery</li>
        </ul>
        <div class="back-home">
            <a href="<?= $homeLink ?>">← Back to Home</a>
        </div>
    </div>
</body>
</html>
