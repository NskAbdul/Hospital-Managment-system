<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>About Our Hospital</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="about_style.css" />
</head>
<body>
    <div class="about-container">
        <h2>About Our Hospital</h2>
        <p>
            Welcome to <span class="highlight">Lifeline Multispeciality Hospital</span>, a trusted name in compassionate and quality healthcare...
        </p>

        <p>
            Our hospital offers a wide range of services including outpatient care, diagnostics, surgical procedures, emergency treatment, and specialty clinics...
        </p>

        <p>
            Your health is our mission, and we are here to serve you with dedication and heart.
        </p>

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
