<?php
$servername = "localhost";
$username = "root";
$password = "Pk3745st@";
$dbname = "office";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store employee data
$employee = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fetch_code'])) {
    $fetch_code = $_POST['fetch_code'];

    // Fetch employee details based on the provided code
    $stmt = $conn->prepare("SELECT * FROM employee WHERE code = ?");
    $stmt->bind_param("s", $fetch_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "<script>alert('No record found for the provided employee code!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Employee Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Container styling */
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            background-color: #f9f9f9;
        }

        h1, h2 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Photo styling */
        .image-section {
            position: absolute;
            top: 290px;
            right: 20px;
            width: 150px;
            height: 150px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .image-section img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        /* Section styling */
        .details-section, .pdf-section {
            margin-top: 20px;
        }

        .details-section p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee Details</h1>

        <!-- Employee Code Input Form -->
        <form method="POST" action="">
            <label for="fetch_code">Enter Employee Code:</label>
            <input type="text" name="fetch_code" id="fetch_code" required>
            <button type="submit">Fetch Records</button>
        </form>

        <?php if ($employee): ?>
            <!-- Display Uploaded Photo in the Top Right Corner -->
            <div class="image-section">
                <?php if ($employee['passport_photo']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($employee['passport_photo']); ?>" alt="Employee Photo">
                <?php else: ?>
                    <p>No Photo</p>
                <?php endif; ?>
            </div>

            <!-- Display Employee Details -->
            <div class="details-section">
                <h2>Personal Information</h2>
                <p><strong>Code:</strong> <?php echo htmlspecialchars($employee['code']); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($employee['name']); ?></p>
                <p><strong>Designation:</strong> <?php echo htmlspecialchars($employee['designation']); ?></p>
                <p><strong>Sex:</strong> <?php echo htmlspecialchars($employee['sex']); ?></p>
                <p><strong>Caste:</strong> <?php echo htmlspecialchars($employee['caste']); ?></p>
                <p><strong>Religion:</strong> <?php echo htmlspecialchars($employee['religion']); ?></p>
                <p><strong>Identification Mark:</strong> <?php echo htmlspecialchars($employee['identification_mark']); ?></p>
                <p><strong>Educational Qualification:</strong> <?php echo htmlspecialchars($employee['educational_qualification']); ?></p>
                <p><strong>Marital Status:</strong> <?php echo htmlspecialchars($employee['marital_status']); ?></p>
                <p><strong>Local Address:</strong> <?php echo htmlspecialchars($employee['local_address']); ?></p>
                <p><strong>Permanent Address:</strong> <?php echo htmlspecialchars($employee['permanent_address']); ?></p>
                <p><strong>PF Account Number:</strong> <?php echo htmlspecialchars($employee['pf_account_number']); ?></p>
                <p><strong>Date of Joining PF:</strong> <?php echo htmlspecialchars($employee['date_of_joining_pf']); ?></p>
                <p><strong>Date of Termination:</strong> <?php echo htmlspecialchars($employee['date_of_termination']); ?></p>
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($employee['contact_no']); ?></p>
                <p><strong>Aadhar:</strong> <?php echo htmlspecialchars($employee['aadhar_no']); ?></p>
                <p><strong>PAN:</strong> <?php echo htmlspecialchars($employee['pan_no']); ?></p>
                <p><strong>Date of Joining:</strong> <?php echo htmlspecialchars($employee['date_of_joining']); ?></p>
                <p><strong>Date of Retirement:</strong> <?php echo htmlspecialchars($employee['date_of_retirement']); ?></p>
            </div>
             <!-- Display Uploaded PDF -->
             <div class="pdf-section">
                <h2>Uploaded PDF</h2>
                <?php if ($employee['file']): ?>
                    <a href="data:application/pdf;base64,<?php echo base64_encode($employee['file']); ?>" download="employee_<?php echo htmlspecialchars($employee['code']); ?>.pdf">Download PDF</a>
                <?php else: ?>
                    <p>No PDF uploaded.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
