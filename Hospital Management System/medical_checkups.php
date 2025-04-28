<?php
$servername = "localhost";
$username = "root";
$password = "NskAbdul@786";
$dbname = "Hospital";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM medical_checkups";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Medical Checkups</title>
    <link rel="stylesheet" href="checkup_style.css" />
</head>
<body>

<h2>Available Medical Checkups</h2>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='checkup-card'>";
        echo "<div class='checkup-title'>" . htmlspecialchars($row["name"]) . "</div>";
        echo "<div class='checkup-info'><strong>Description:</strong> " . htmlspecialchars($row["description"]) . "</div>";
        echo "<div class='checkup-info'><strong>Duration:</strong> " . htmlspecialchars($row["duration"]) . "</div>";
        echo "<div class='checkup-info'><strong>Price:</strong> ₹" . htmlspecialchars($row["price"]) . "</div>";
        echo "</div>";
    }
} else {
    echo "<p style='text-align:center;'>No checkups available at the moment.</p>";
}
$conn->close();
?>

</body>
</html>
