<?php
session_start();

$conn = new mysqli("localhost", "root", "NskAbdul@786", "Hospital");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $_GET['search'] ?? '';
$specialization = $_GET['specialization'] ?? '';

$sql = "SELECT * FROM doctors WHERE 1";
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " AND name LIKE '%$search%'";
}
if (!empty($specialization)) {
    $specialization = $conn->real_escape_string($specialization);
    $sql .= " AND specialization = '$specialization'";
}

$result = $conn->query($sql);
$specs_result = $conn->query("SELECT DISTINCT specialization FROM doctors");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Doctors</title>
    <link rel="stylesheet" href="/Hospital%20Management%20System/style.css">
    <style>
        .filter-box {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-box input,
        .filter-box select {
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button[type="submit"] {
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            background-color: #00796b;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .appt-link a {
            background-color: #28a745;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .appt-link a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>List of Doctors 🧑‍⚕️</h2>

    <form class="filter-box" method="GET" action="">
        <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
        <select name="specialization">
            <option value="">All Specializations</option>
            <?php while ($row = $specs_result->fetch_assoc()): ?>
                <option value="<?= htmlspecialchars($row['specialization']) ?>" 
                    <?= $specialization == $row['specialization'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['specialization']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <table>
        <tr>
            <th>Doctor Name</th>
            <th>Specialization</th>
            <th>License No</th>
            <th>Action</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($doctor = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($doctor['name']) ?></td>
                    <td><?= htmlspecialchars($doctor['specialization']) ?></td>
                    <td><?= htmlspecialchars($doctor['license_no']) ?></td>
                    <td class="appt-link">
                        <?php if (isset($_SESSION['user_email'])): ?>
                            <a href="appointment.php?doctor_id=<?= $doctor['doctor_id'] ?>">Book</a>
                        <?php else: ?>
                            <a href="user_login.php">Login to Book</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No doctors found.</td></tr>
        <?php endif; ?>
    </table>
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
</body>
</html>

<?php $conn->close(); ?>
