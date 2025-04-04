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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_employee'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $aadhar = $_POST['aadhar'];
    $pan = $_POST['pan'];
    $designation = $_POST['designation'];
    $gender = $_POST['gender'];
    $caste = $_POST['caste'];
    $religion = $_POST['religion'];
    $id_mark = $_POST['id_mark'];
    $qualification = $_POST['qualification'];
    $marital_status = $_POST['marital_status'];
    $local_address = $_POST['local_address'];
    $permanent_address = $_POST['permanent_address'];
    $pf_ac_no = $_POST['pf_ac_no'];
    $pf_join_date = $_POST['pf_join_date'];
    $employment_end_date = empty($_POST['employment_end_date']) ? NULL : $_POST['employment_end_date'];
    $date_of_birth = $_POST['date_of_birth']; // Changed from date_of_joining
    $date_of_retirement = date('Y-m-d', strtotime($date_of_birth . ' +60 years'));
    $photoContent = null; // Default to null if no photo is uploaded
    $file = $_FILES['file']['tmp_name'];

    // Check if a file is uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileContent = file_get_contents($file);
        $photoContent = file_get_contents($_FILES['photo']['tmp_name']);
        echo "File content length: " . strlen($photoContent); // Debug the file content length
    } else {
        echo "File upload error: " . $_FILES['photo']['error']; // Debug file upload error
        exit;
    }

 
    // Prepare SQL Query
    $stmt = $conn->prepare("INSERT INTO employee (code, name, contact_no, aadhar_no, pan_no, designation, sex, caste, religion, identification_mark, educational_qualification, marital_status, local_address, permanent_address, pf_account_number, date_of_joining_pf, date_of_termination, date_of_joining, date_of_retirement, passport_photo, file) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssssssssss", 
        $code, $name, $contact, $aadhar, $pan, $designation, $gender, $caste, $religion, 
        $id_mark, $qualification, $marital_status, $local_address, $permanent_address, 
        $pf_ac_no, $pf_join_date, $employment_end_date, $date_of_birth, $date_of_retirement, 
        $photoContent, $fileContent);

    // Execute query
    if ($stmt->execute()) {
        echo "<script>alert('Employee record added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workman's Service Record</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>The Durgapur Projects Limited</h1>
         <!-- Photo Upload Preview Section -->
         <div class="photo-upload">
            <h2> </h2>
            <img id="photoPreview" src="#" alt="Preview" style="display: none;">
            <input type="file" name="photo" accept="image/*" onchange="previewPhoto(this)">
         </div>

        <!-- Form Section -->
        <div class="form-section">
            <h2>Add Employee Record</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <input type="text" name="code" placeholder="Enter Employee Code" required>
                </div>
                <div class="form-row">
                    <input type="text" name="name" placeholder="Enter Name" required>
                </div>
                <div class="form-row">
                    <input type="text" name="contact" placeholder="Enter Contact Number" required>
                </div>
                <div class="form-row">
                    <input type="text" name="aadhar" placeholder="Enter Aadhar Number" required>
                </div>
                <div class="form-row">
                    <input type="text" name="pan" placeholder="Enter PAN Number" required>
                </div>
                <div class="form-row">
                    <input type="text" name="designation" placeholder="Designation" required>
                </div>
                <div class="form-row">
                    <select name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-row">
                    <input type="text" name="caste" placeholder="Caste" required>
                </div>
                <div class="form-row">
                    <input type="text" name="religion" placeholder="Religion" required>
                </div>
                <div class="form-row">
                    <input type="text" name="id_mark" placeholder="Identification Mark" required>
                </div>
                <div class="form-row">
                    <input type="text" name="qualification" placeholder="Educational Qualification" required>
                </div>
                <div class="form-row">
                    <select name="marital_status" required>
                        <option value="">Marital Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                    </select>
                </div>
                <div class="form-row">
                    <input type="text" name="local_address" placeholder="Local Address" required>
                </div>
                <div class="form-row">
                    <input type="text" name="permanent_address" placeholder="Permanent Address" required>
                </div>
                <div class="form-row">
                    <input type="text" name="pf_ac_no" placeholder="Enter PF Account Number" required>
                </div>
                <div class="form-row">
                    <input type="date" name="pf_join_date" placeholder="(Date of PF Joining)" required>
                </div>
                <div class="form-row">
                    <input type="date" name="date_of_birth" id="date_of_birth" placeholder="(Date of Birth)" required>
                </div>
                <div class="form-row">
                    <input type="date" name="employment_end_date" placeholder="(Date of Termination)" >
                </div>
                <div class="form-row">
                    <input type="text" id="date_of_retirement" placeholder="Date of Retirement (calculated)" readonly>
                </div>
                <div class="form-row">
                    <input type="file" name="photo" accept="image/*" onchange="previewPhoto(this)" placeholder="Add profile picture" required>
                </div>
                <div class="form-row">
                    <input type="file" name="file" accept=".pdf" required>
                </div>
                <button type="submit" name="add_employee">Submit</button>
            </form>
        </div>

        <!-- Navigation Buttons -->
        <div class="navigation-buttons">
            <button onclick="location.href='dashboard.php'">Dashboard</button>
            <button onclick="location.href='fetch.php'">Fetch Records</button>
            <button onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>
        
    <script>
        document.getElementById('date_of_birth').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            if (birthDate) {
                const retirementDate = new Date(birthDate.setFullYear(birthDate.getFullYear() + 60));
                document.getElementById('date_of_retirement').value = retirementDate.toISOString().split('T')[0];
            }
        });
          // Preview Uploaded Photo
          function previewPhoto(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
