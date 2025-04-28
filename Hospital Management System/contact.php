<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style.css">
    <link rel="stylesheet" href="contact_style.css">
</head>
<body>
    <div class="contact-container">
        <h2>Contact Us</h2>

        <div class="contact-info">
            <p>Reception: <a href="tel:+919876543210">+91 98765 43210</a></p>
            <p>Email: <a href="mailto:info@lifelinehospital.com">info@lifelinehospital.com</a></p>
        </div>

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
