<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospital Services</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style.css">
    <style>
        body {
            background: #e0f7fa;
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
        }

        .services-container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            border-radius: 15px;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #00796b;
            margin-bottom: 30px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
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
            color: #00796b;
            text-decoration: none;
            font-weight: bold;
        }

        .back-home a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="services-container">
        <h2>Hospital Services</h2>
        <ul>
            <li>General OPD (Outpatient Department)</li>
            <li>Diagnostic & Laboratory Services</li>
            <li>Pharmacy & Medication Counseling</li>
            <li>Radiology (X-ray, Ultrasound, CT, MRI)</li>
            <li>Emergency Services (24/7)</li>
            <li>Inpatient & Surgical Services</li>
            <li>Cardiology & Heart Checkups</li>
            <li>Eye Care & ENT Services</li>
            <li>Pediatric & Maternity Services</li>
            <li>Neurology & Mental Health Support</li>
            <li>Preventive Health Checkups & Wellness</li>
        </ul>
        <div class="back-home">
            <?php
                if (isset($_SESSION['doctor_email'])) {
                    echo '<a href="doctor.php">← Back to Home</a>';
                } elseif (isset($_SESSION['user_email'])) {
                    echo '<a href="patient.php">← Back to Home</a>';
                } else {
                    echo '<a href="index.html">← Back to Home</a>';
                }
            ?>
        </div>
    </div>
</body>
</html>
