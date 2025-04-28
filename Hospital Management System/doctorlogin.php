<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "NskAbdul@786";
$dbname = "Hospital";

// Connect to MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password_input = $_POST['password'];

    // DB Connection
    $conn = new mysqli("localhost", "root", "S@i130506", "Hospital");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query Doctor Table
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $doctor = $result->fetch_assoc();

        if ($password_input === $doctor['password']) {
            // ✅ Session Variables
            $_SESSION['doctor_id'] = $doctor['doctor_id'];
            $_SESSION['doctor_name'] = $doctor['name'];
            $_SESSION['doctor_email'] = $doctor['email'];

            // ✅ Redirect
            header("Location: doctor.php");
            exit();
        } else {
            $login_error = "Incorrect password.";
        }
    } else {
        $login_error = "Doctor not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Login</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style4.css">
</head>
<body>
<div class="login-container">
    <h2>Doctor Login 🩺</h2>

    <?php if ($login_error): ?>
        <p class="error"><?= $login_error ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Email</label>
        <input type="email" name="email" required placeholder="Enter your email">

        <label>Password</label>
        <input type="password" name="password" required placeholder="Enter your password">

        <button type="submit">Login</button>
    </form>

    <p><a href="/HOSPITAL%20MANAGEMENT%20SYSTEM/index.html">Back to Home</a></p>
</div>
</body>
</html>
