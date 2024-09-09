<?php
// Start the session
session_start();
$conn = require 'config/config.php';

// Mock data for demonstration purposes
$monthlyEarnings = 40000;
$annualEarnings = 215000;
$taskProgress = 50;
$pendingRequests = 18;
$projects = [
    ['name' => 'Server Migration', 'progress' => 20, 'color' => 'bg-danger'],
    ['name' => 'Sales Tracking', 'progress' => 40, 'color' => 'bg-warning'],
    ['name' => 'Customer Database', 'progress' => 60, 'color' => 'bg-primary'],
    ['name' => 'Payout Details', 'progress' => 80, 'color' => 'bg-success'],
];

// Simulate user info
$user = [
    'name' => 'admin',
    'role' => 'admin',
    'profile_image' => 'profile.png', // Replace with actual image path
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ridpath Academy ES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            background-color: #4e73df;
            height: 100vh;
            color: white;
            padding-top: 20px;
            position: fixed;
            width: 250px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            font-weight: bold;
        }
        .sidebar a:hover {
            background-color: #2e59d9;
            border-radius: 5px;
        }
        .dashboard-header {
            margin-left: 250px;
            background-color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e3e6f0;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            margin-top: 20px;
            border-radius: 10px;
        }
        .sidebar-heading {
            text-transform: uppercase;
            font-size: 0.85rem;
            color: #b7b9cc;
            padding: 10px 15px;
            margin-top: 20px;
        }
        .sidebar .nav-link.active {
            color: #4e73df;
            background-color: #eaecf4;
            border-left: 4px solid #4e73df;
            border-radius: 5px;
        }
        .topbar {
            margin-left: 250px;
            background-color: #fff;
            padding: 20px;
            border-bottom: 1px solid #e3e6f0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <div class="text-center">
                    <img src="logo.png" alt="Logo" class="img-fluid" style="width: 50px; margin-bottom: 10px;">
                    <h4>RIDPATH ACADEMY ES</h4>
                </div>
                <a href="#" class="nav-link active">Dashboard</a>
                <div class="sidebar-heading">Menu</div>
                <a href="#">Class Schedule</a>
                <a href="#">My Records</a>
                <a href="#">My Profile</a>
                <div class="sidebar-heading">Configurations</div>
                <a href="#">System Definition</a>
                <a href="#">Manage User Accounts</a>
                <div class="sidebar-heading">Reports</div>
                <a href="#">Generate Reports</a>
                <a href="#">Tables</a>
            </nav>

            <!-- Main Content -->
            <div class="col-md-10 offset-md-2">
                <div class="dashboard-header">
                    <h1 class="h3 mb-0">Dashboard</h1>
                    <div class="d-flex align-items-center">
                        <span><?php echo $user['name'] . ', ' . $user['role']; ?></span>
                        <img src="<?php echo $user['profile_image']; ?>" alt="Profile" class="img-fluid" style="width: 40px; height: 40px; border-radius: 50%; margin-left: 10px;">
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6>Earnings (Monthly)</h6>
                                    <h2>$<?php echo number_format($monthlyEarnings); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6>Earnings (Annual)</h6>
                                    <h2>$<?php echo number_format($annualEarnings); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6>Tasks</h6>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $taskProgress; ?>%;" aria-valuenow="<?php echo $taskProgress; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $taskProgress; ?>%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6>Pending Requests</h6>
                                    <h2><?php echo $pendingRequests; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Earnings Overview</h6>
                                    <canvas id="earningsChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Revenue Sources</h6>
                                    <canvas id="revenueSourcesChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Projects</h6>
                                    <?php foreach ($projects as $project): ?>
                                        <div class="mb-2">
                                            <p><?php echo $project['name']; ?></p>
                                            <div class="progress">
                                                <div class="progress-bar <?php echo $project['color']; ?>" role="progressbar" style="width: <?php echo $project['progress']; ?>%;" aria-valuenow="<?php echo $project['progress']; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $project['progress']; ?>%</div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Illustrations</h6>
                                    <p>Add some quality, SVG illustrations to your project...</p>
                                    <a href="#" class="btn btn-primary">Browse Illustrations on unDraw</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Earnings Overview Chart
        var ctx = document.getElementById('earningsChart').getContext('2d');
        var earningsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                datasets: [{
                    label: 'Earnings',
                    data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 40000],
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Revenue Sources Chart
        var ctx = document.getElementById('revenueSourcesChart').getContext('2d');
        var revenueSourcesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Direct', 'Social', 'Referral'],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: 'rgba(234, 236, 244, 1)',
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: '80%'
            }
        });
    </script>
</body>
</html>
