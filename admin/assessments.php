<?php
require '../shared/header.php';
?>

<!-- Custom CSS for Wider Dropdown -->
<style>
    .dropdown-menu-wide {
        width: 250px;
        /* Adjust the width as needed */
    }
</style>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Ridpath Elementary School</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Assessments</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Date Selection Card (Start and End Dates) -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Select Start and End Date
                                            </div>
                                            <!-- Start Date Input -->
                                            <div class="form-group">
                                                <label for="startDate">Start Date</label>
                                                <input type="date" class="form-control" id="startDate">
                                            </div>
                                            <!-- End Date Input -->
                                            <div class="form-group">
                                                <label for="endDate">End Date</label>
                                                <input type="date" class="form-control" id="endDate">
                                            </div>
                                            <!-- Selected Dates Label -->
                                            <label id="dateRangeLabel" class="text-muted">No dates selected</label>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Subjects Table -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Subjects Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="subjectsTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Subject Name</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody id="subjectsTableBody">
                                                <tr>
                                                    <td colspan="2" class="text-center">Please select a class from the dropdown above.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Display Selected Class Name Here -->
                                    <div id="selectedClass" class="mt-3 text-primary font-weight-bold"></div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</div>
<!-- /.container-fluid -->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<!-- Custom Script for Dynamic Table Population -->
<script>
    function showSubjects(className) {
        var subjects = {
            'Introduction to Programming': [{
                    name: 'Variables and Data Types',
                    description: 'Understanding basic data types and variables in programming.'
                },
                {
                    name: 'Control Structures',
                    description: 'Learning about loops, conditionals, and flow control.'
                },
                {
                    name: 'Functions',
                    description: 'Introduction to functions and modular programming.'
                }
            ],
            'Data Structures': [{
                    name: 'Arrays and Lists',
                    description: 'Understanding arrays, lists, and their usage.'
                },
                {
                    name: 'Stacks and Queues',
                    description: 'Learning about stack and queue data structures.'
                },
                {
                    name: 'Trees and Graphs',
                    description: 'Introduction to tree and graph data structures.'
                }
            ],
            'Web Development': [{
                    name: 'HTML & CSS',
                    description: 'Basics of web development using HTML and CSS.'
                },
                {
                    name: 'JavaScript',
                    description: 'Learning the fundamentals of JavaScript for web development.'
                },
                {
                    name: 'Web Frameworks',
                    description: 'Introduction to popular web development frameworks.'
                }
            ],
            'Database Management': [{
                    name: 'SQL Basics',
                    description: 'Learning SQL and database management basics.'
                },
                {
                    name: 'Normalization',
                    description: 'Understanding database normalization and its importance.'
                },
                {
                    name: 'Advanced SQL Queries',
                    description: 'Writing advanced SQL queries and optimizing them.'
                }
            ],
            'Machine Learning': [{
                    name: 'Supervised Learning',
                    description: 'Introduction to supervised learning techniques.'
                },
                {
                    name: 'Unsupervised Learning',
                    description: 'Learning about unsupervised learning and clustering.'
                },
                {
                    name: 'Neural Networks',
                    description: 'Understanding the basics of neural networks and deep learning.'
                }
            ]
        };

        var tableBody = document.getElementById('subjectsTableBody');
        tableBody.innerHTML = '';

        if (subjects[className]) {
            subjects[className].forEach(function(subject) {
                var row = document.createElement('tr');
                var nameCell = document.createElement('td');
                nameCell.textContent = subject.name;
                var descriptionCell = document.createElement('td');
                descriptionCell.textContent = subject.description;
                row.appendChild(nameCell);
                row.appendChild(descriptionCell);
                tableBody.appendChild(row);
            });
        } else {
            var row = document.createElement('tr');
            var cell = document.createElement('td');
            cell.colSpan = 2;
            cell.textContent = 'No subjects found for the selected class.';
            row.appendChild(cell);
            tableBody.appendChild(row);
        }

        // Update the selected class name
        var selectedClassDiv = document.getElementById('selectedClass');
        selectedClassDiv.textContent = 'Selected Class: ' + className;
    }

    // Function to update the selected dates
    function updateDateLabel() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        var dateRangeLabel = document.getElementById('dateRangeLabel');

        if (startDate && endDate) {
            dateRangeLabel.textContent = "Selected Range: " + startDate + " to " + endDate;
        } else if (startDate) {
            dateRangeLabel.textContent = "Selected Start Date: " + startDate;
        } else if (endDate) {
            dateRangeLabel.textContent = "Selected End Date: " + endDate;
        } else {
            dateRangeLabel.textContent = "No dates selected";
        }
    }

    // Add event listeners to update the label when either date changes
    document.getElementById('startDate').addEventListener('change', updateDateLabel);
    document.getElementById('endDate').addEventListener('change', updateDateLabel);
</script>

<?php
require '../shared/footer.php';
?>