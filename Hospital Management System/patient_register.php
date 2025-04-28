<?php
$servername = "localhost";
$username = "root";
$password = "NskAbdul@786";
$dbname = "Hospital";

// Connect to MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $pass = $_POST['password'];

    // You can hash the password for security if needed: $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO patients (name, email, phone, dob, gender, address, password)
            VALUES ('$name', '$email', '$phone', '$dob', '$gender', '$address', '$pass')";

    if (mysqli_query($conn, $sql)) {
        header("Location: http://localhost/Hospital%20Management%20System/index.html");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 35px 40px;
            border-radius: 10px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
            width: 450px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056cc;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Patient Registration</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST" onsubmit="return validateForm();">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" required>

            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="address">Address:</label>
            <textarea name="address" id="address" rows="3" required></textarea>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Register</button>
        </form>
    </div>

    <script>
        function validateForm() {
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const dob = document.getElementById("dob").value;
            const gender = document.getElementById("gender").value;
            const address = document.getElementById("address").value.trim();
            const password = document.getElementById("password").value;

            const phonePattern = /^[0-9]{10}$/;
            const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

            // Password pattern (at least one uppercase, one lowercase, one digit, one special character)
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;

            // Check if any field is empty
            if (!name || !email || !phone || !dob || !gender || !address || !password) {
                alert("Please fill out all fields.");
                return false;
            }

            // Email validation
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Phone number validation
            if (!phonePattern.test(phone)) {
                alert("Phone number should be exactly 10 digits.");
                return false;
            }

            // Password validation
            if (!passwordPattern.test(password)) {
                alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one digit, and one special character.");
                return false;
            }

            // If everything is valid, return true to allow form submission
            return true;
        }
    </script>

</body>
</html>
