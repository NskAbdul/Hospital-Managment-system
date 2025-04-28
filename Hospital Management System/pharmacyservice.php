<?php
session_start();

$homeLink = "index.html";
if (isset($_SESSION['patient_id'])) {
    $homeLink = "patient.php";
} elseif (isset($_SESSION['doctor_id'])) {
    $homeLink = "doctor.php";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pharmacy Services</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style.css">
    <style>
        body {
            background-color: #e8f5e9;
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
        }

        .pharmacy-container {
            max-width: 750px;
            margin: auto;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.15);
            padding: 30px;
            text-align: center;
        }

        h2 {
            color: #2e7d32;
            margin-bottom: 25px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .service-list {
            text-align: left;
            margin: 20px 0;
        }

        .service-list li {
            margin: 10px 0;
            padding: 12px 18px;
            font-size: 17px;
        }

        .contact-links a {
            display: inline-block;
            background-color: #388e3c;
            color: white;
            padding: 10px 18px;
            margin: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .contact-links a:hover {
            background-color: #1b5e20;
        }

        .back-home {
            margin-top: 30px;
        }

        .back-home a {
            color: #2e7d32;
            text-decoration: none;
            font-weight: bold;
        }

        .back-home a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="pharmacy-container">
        <h2>Hospital Pharmacy Services</h2>
        <p>Our in-house pharmacy provides convenient access to prescribed medications, drug information, and counseling on dosage and side effects. We are available 24/7 for emergency needs.</p>
        
        <ul class="service-list">
            <li>Dispensing of Doctor-Prescribed Medications</li>
            <li>Medicine Usage & Dosage Counseling</li>
            <li>Availability of Emergency & OTC Drugs</li>
            <li>Prescription Refill Management</li>
            <li>Patient Awareness on Side Effects</li>
        </ul>

        <div class="contact-links">
            <a href="tel:+911234567891">Call Pharmacy</a>
            <a href="mailto:pharmacy@hospital.com?subject=Pharmacy Inquiry">Email Pharmacy</a>
        </div>

        <div class="back-home">
            <a href="<?php echo $homeLink; ?>">← Back to Home</a>
        </div>
    </div>
</body>
</html>
