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
    <title>Emergency Services</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style.css">
    <style>
        body {
            background-color: #fff3e0;
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
        }

        .emergency-container {
            max-width: 700px;
            margin: auto;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.15);
            padding: 30px;
            text-align: center;
        }

        h2 {
            color: #d84315;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .contact-buttons a {
            display: inline-block;
            background-color: #d84315;
            color: white;
            padding: 12px 20px;
            margin: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }

        .contact-buttons a:hover {
            background-color: #b71c1c;
        }

        .back-home {
            margin-top: 30px;
        }

        .back-home a {
            color: #d84315;
            text-decoration: none;
            font-weight: bold;
        }

        .back-home a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="emergency-container">
        <h2>🚨 Emergency Services - 24/7</h2>
        <p>Our hospital provides round-the-clock emergency medical services for all critical situations. Our team is trained to handle trauma, accidents, and life-threatening conditions with utmost urgency.</p>
        <p>If you are facing a medical emergency, please call us or send an emergency email immediately.</p>

        <div class="contact-buttons">
            <a href="tel:+911234567890">📞 Call Reception</a>
            <a href="mailto:emergency@hospital.com?subject=Emergency Help Required">📧 Send Emergency Email</a>
        </div>

        <div class="back-home">
            <a href="<?php echo $homeLink; ?>">← Back to Home</a>
        </div>
    </div>
</body>
</html>
