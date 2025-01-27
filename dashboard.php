<?php
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

// Fetch total number of employees
$totalEmployeesQuery = "SELECT COUNT(*) AS total FROM employee";
$result = $conn->query($totalEmployeesQuery);
$totalEmployees = $result->fetch_assoc()['total'];

// Fetch active employees
$activeEmployeesQuery = "SELECT COUNT(*) AS active FROM employee WHERE date_of_retirement > CURDATE()";
$result = $conn->query($activeEmployeesQuery);
$activeEmployees = $result->fetch_assoc()['active'];

// Fetch retired employees
$retiredEmployees = $totalEmployees - $activeEmployees;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with Charts</title>
    <link rel="stylesheet" href="dstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Employee Dashboard</h1>
        <canvas id="employeeChart" width="400" height="200"></canvas>
    </div>

     <!-- Home Button -->
     <div class="home">
            <form method="POST" action="index.php">
                <button type="submit" name="home">Home</button>
            </form>
        </div>

    <script>
        // Fetch data from PHP
        const totalEmployees = <?php echo $totalEmployees; ?>;
        const activeEmployees = <?php echo $activeEmployees; ?>;
        const retiredEmployees = <?php echo $retiredEmployees; ?>;

        // Render Chart
        const ctx = document.getElementById('employeeChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut', // You can also use 'bar', 'line', etc.
            data: {
                labels: ['Active Employees', 'Retired Employees'],
                datasets: [{
                    data: [activeEmployees, retiredEmployees],
                    backgroundColor: ['#4CAF50', '#f44336'], // Active: Green, Retired: Red
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const percentage = ((value / totalEmployees) * 100).toFixed(2);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
