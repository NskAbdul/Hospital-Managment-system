<?php
session_start();
if (!isset($_SESSION['doctor_email'])) {
    header("Location: login.html"); // Corrected path, no need for full path
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HealthCare Impact</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- Top Bar -->
  <div class="top-bar">
    <div class="container">
        <div class="nav-links">
            <li><a href="tel:+1 800 123 4567">+1 800 123 4567</a></li>
            <li><a href="mailto:contact@hospital.com">contact@hospital.com</a></li>
            </div>
      <div class="auth-links">
        <span>👨‍⚕️ <?php echo $_SESSION['doctor_name']; ?></span> |
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container nav-container">
      <div class="logo">Health<span class="highlight">Care</span></div>
      <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="service.php">Services</a></li>
        <li><a href="doctormenu.php">Doctors</a></li>
        <li><a href="department.php">Departments</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container hero-content">
      <h1>Welcome, <?php echo $_SESSION['doctor_name']; ?>!</h1>
      <p>Your registered email is <strong><?php echo $_SESSION['doctor_email']; ?></strong></p>
      <p>Your health is our priority. We provide top-tier medical services to ensure your well-being.</p>
    </div>
  </section>

  <!-- Services Section -->
  <section class="services">
    <div class="container services-grid">
    <a href="doctor_appointment.php">
      <div class="service-box">
        <h3>Outpatient Services</h3>
      </div>
     </a>
     <a href="history_doctor.php">
      <div class="service-box">
        <h3>Medical Checkups</h3>
      </div>
      </a>
    </div>
  </section>

  <!-- About Section -->
  <section class="about">
    <div class="container">
      <h2>About Us</h2>
      <p>
        HealthCare is a trusted name in medical excellence. Our team of professionals is dedicated to providing
        compassionate and cutting-edge healthcare solutions.
      </p>
      <div class="about-section">
          <h2> Welcome to Health Care </h2>
          <p>
              At <strong>Health Care</strong>, we are more than just a healthcare facility — we are a place where compassion meets innovation, and where every patient is treated like family. With a legacy of excellence and a future focused on innovation, we are proud to be one of the leading healthcare institutions in the region.
          </p>
      
          <p>
              Our hospital is powered by a team of dedicated doctors, nurses, and staff who are passionate about healing and committed to delivering world-class medical care. Whether it’s a routine check-up or a complex surgery, we ensure every patient receives personalized attention, accurate diagnosis, and the most effective treatment available.
          </p>
      
          <p>
              <strong>Why Choose Us?</strong>
              
                  <h3>24/7 Emergency & Critical Care</h3>
                  <h3>Advanced Diagnostic & Surgical Technology</h3>
                  <h3>Multilingual & Patient-Centric Staff</h3>
                  <h3>Specialized Departments with Expert Consultants</h3>
                  <h3>Clean, Safe & Comfortable Healing Environment</h3>
              
          </p>
      
          <p>
              We don’t just treat illnesses — we care for people. Join thousands of patients who trust us with their health. Your journey to wellness begins here.
          </p>
      
          <p style="text-align: center; font-weight: bold; color: #2e7d32;">
              Because your health deserves nothing but the best.
          </p>
      </div>
    </div>
  </section>

</body>
</html>

