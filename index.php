<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "office";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for storing data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_employee'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $aadhar = $_POST['aadhar'];
    $pan = $_POST['pan'];
    $date_of_joining = $_POST['date_of_joining'];
    $date_of_retirement = date('Y-m-d', strtotime($date_of_joining . ' +60 years'));
    $file = $_FILES['file']['tmp_name'];

    if ($file) {
        $fileContent = file_get_contents($file);
        $stmt = $conn->prepare("INSERT INTO employee (code, name, contact_no, aadhar_no, pan_no, date_of_joining, date_of_retirement, file) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $code, $name, $contact, $aadhar, $pan, $date_of_joining, $date_of_retirement, $fileContent);
        $stmt->execute();
        echo "<script>alert('Employee record added successfully!');</script>";
    }
}

// Handle fetching PDF
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fetch_pdf'])) {
    $code = $_POST['fetch_code'];
    $stmt = $conn->prepare("SELECT file FROM employee WHERE code = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($fileContent);
        $stmt->fetch();
        header('Content-Type: application/pdf');
        echo $fileContent;
        exit;
    } else {
        echo "<script>alert('No document found for the entered code.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Records</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Employee Records Management</h1>

        <!-- Logout Button -->
        <div class="logout">
            <form method="POST" action="logout.php">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>


        <!-- Dashboard Button -->
        <div class="dashboard">
            <form method="POST" action="dashboard.php">
                <button type="submit" name="dashboard">Dashboard</button>
            </form>
        </div>
        

        <div class="form-section">
            <h2>Add Employee Record</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="code" placeholder="Enter Employee Code" required>
                <input type="text" name="name" placeholder="Enter Employee Name" required>
                <input type="text" name="contact" placeholder="Enter Contact Number" required>
                <input type="text" name="aadhar" placeholder="Enter Aadhar Number" required>
                <input type="text" name="pan" placeholder="Enter PAN Number" required>
                <input type="date" name="date_of_joining" id="date_of_joining" placeholder="Date of Joining" required>
                <input type="text" id="date_of_retirement" placeholder="Date of Retirement (calculated)" readonly>
                <input type="file" name="file" accept=".pdf" required>
                <button type="submit" name="add_employee">Add Employee</button>
            </form>
        </div>

        <div class="form-section fetch-section">
            <h2>Fetch Employee PDF</h2>
            <form method="POST">
                <input type="text" name="fetch_code" placeholder="Enter Employee Code to Fetch PDF" required>
                <button type="submit" name="fetch_pdf">Fetch PDF</button>
            </form>
        </div>
    </div>

    <script>
        // Auto-calculate Date of Retirement
        document.getElementById('date_of_joining').addEventListener('change', function() {
            const joiningDate = new Date(this.value);
            if (joiningDate) {
                const retirementDate = new Date(joiningDate.setFullYear(joiningDate.getFullYear() + 60));
                document.getElementById('date_of_retirement').value = retirementDate.toISOString().split('T')[0];
            }
        });
    </script>
</body>
</html>
