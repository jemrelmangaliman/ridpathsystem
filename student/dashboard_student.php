<?php
require '../shared/header.php';


// Example array of recent students (typically this would come from a database)
$recentStudents = [
    "Kins Mangaliman",
    "Jemrel Quinagutan",
    "Brian Pogi",
    "Earl Ramilo",
    "Jose Mari Chan",
    "Jerome Demonteverde",
    "CHRIS BROWN NIG"
];

?>
<style>
    .course-hidden {
        display: none;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">



        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Recently Enrolled Students</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Actions:</div>
                                <a class="dropdown-item" href="#">View All Students</a>
                                <a class="dropdown-item" href="#">Add New Student</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Edit Student List</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php foreach ($recentStudents as $student): ?>
                                <li class="list-group-item"><?= $student ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Actions</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <a href="view-class-schedule.php" class="btn btn-primary btn-lg mb-3">VIEW CLASS SCHEDULE</a>
                        <a href="manage-records.php" class="btn btn-secondary btn-lg">MANAGE RECORDS</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="container mt-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Available Courses (10)</h6>
                        </div>
                        <div class="card-body">
                            <!-- First 5 courses -->
                            <div class="course-item">
                                <h4 class="small font-weight-bold">Introduction to Programming <span
                                        class="float-right">Enroll Now</span></h4>
                                <div class="mb-4">
                                    <p>This course covers the basics of programming including syntax, logic, and problem-solving skills.</p>
                                </div>
                            </div>

                            <div class="course-item">
                                <h4 class="small font-weight-bold">Data Structures <span
                                        class="float-right">Enroll Now</span></h4>
                                <div class="mb-4">
                                    <p>Learn about different data structures such as arrays, linked lists, stacks, and queues.</p>
                                </div>
                            </div>

                            <div class="course-item">
                                <h4 class="small font-weight-bold">Web Development <span
                                        class="float-right">Enroll Now</span></h4>
                                <div class="mb-4">
                                    <p>Explore the world of web development with HTML, CSS, JavaScript, and responsive design.</p>
                                </div>
                            </div>

                            <div class="course-item">
                                <h4 class="small font-weight-bold">Database Management <span
                                        class="float-right">Enroll Now</span></h4>
                                <div class="mb-4">
                                    <p>Understand how to design, implement, and manage databases using SQL.</p>
                                </div>
                            </div>

                            <div class="course-item">
                                <h4 class="small font-weight-bold">Machine Learning <span
                                        class="float-right">Enroll Now</span></h4>
                                <div>
                                    <p>Dive into machine learning algorithms, models, and real-world applications.</p>
                                </div>
                            </div>

                            <!-- Additional 5 courses hidden initially -->
                            <div id="more-courses" class="course-hidden">
                                <div class="course-item">
                                    <h4 class="small font-weight-bold">Course 6 <span
                                            class="float-right">Enroll Now</span></h4>
                                    <div class="mb-4">
                                        <p>Details about Course 6.</p>
                                    </div>
                                </div>

                                <div class="course-item">
                                    <h4 class="small font-weight-bold">Course 7 <span
                                            class="float-right">Enroll Now</span></h4>
                                    <div class="mb-4">
                                        <p>Details about Course 7.</p>
                                    </div>
                                </div>

                                <div class="course-item">
                                    <h4 class="small font-weight-bold">Course 8 <span
                                            class="float-right">Enroll Now</span></h4>
                                    <div class="mb-4">
                                        <p>Details about Course 8.</p>
                                    </div>
                                </div>

                                <div class="course-item">
                                    <h4 class="small font-weight-bold">Course 9 <span
                                            class="float-right">Enroll Now</span></h4>
                                    <div class="mb-4">
                                        <p>Details about Course 9.</p>
                                    </div>
                                </div>

                                <div class="course-item">
                                    <h4 class="small font-weight-bold">Course 10 <span
                                            class="float-right">Enroll Now</span></h4>
                                    <div>
                                        <p>Details about Course 10.</p>
                                    </div>
                                </div>
                            </div>

                            <button id="show-more-btn" class="btn btn-primary mt-3">Show All Courses</button>
                        </div>
                    </div>
                </div>

                <!-- Color System -->
                <!--<div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                                Primary
                                <div class="text-white-50 small">#4e73df</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                Success
                                <div class="text-white-50 small">#1cc88a</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-info text-white shadow">
                            <div class="card-body">
                                Info
                                <div class="text-white-50 small">#36b9cc</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-warning text-white shadow">
                            <div class="card-body">
                                Warning
                                <div class="text-white-50 small">#f6c23e</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-danger text-white shadow">
                            <div class="card-body">
                                Danger
                                <div class="text-white-50 small">#e74a3b</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-secondary text-white shadow">
                            <div class="card-body">
                                Secondary
                                <div class="text-white-50 small">#858796</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-light text-black shadow">
                            <div class="card-body">
                                Light
                                <div class="text-black-50 small">#f8f9fc</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-body">
                                Dark
                                <div class="text-white-50 small">#5a5c69</div>
                            </div>
                        </div>
                    </div>
                </div>-->

            </div>

            <div class="col-lg-6 mb-4">

                <!-- Pending Enrollment Applications -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Pending Enrollment Applications</h6>
                        <span class="badge badge-primary badge-pill" style="font-size: 1.25rem;">3</span> <!-- Increased font size -->
                    </div>
                    <div class="card-body">
                        <p>There are currently 3 pending enrollment applications.</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pendingApplicationsModal">
                            Review Applications
                        </button>
                    </div>
                </div>

                <!-- Pending Enrollment Applications Modal -->
                <div class="modal fade" id="pendingApplicationsModal" tabindex="-1" role="dialog" aria-labelledby="pendingApplicationsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pendingApplicationsModalLabel">Pending Enrollment Applications</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Application 1 -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0"><strong>Application 1:</strong> John Doe - Introduction to Programming</p>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-success btn-sm mr-2">Approve</button>
                                        <button type="button" class="btn btn-danger btn-sm">Disapprove</button>
                                    </div>
                                </div>
                                <!-- Application 2 -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0"><strong>Application 2:</strong> Jane Smith - Data Structures</p>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-success btn-sm mr-2">Approve</button>
                                        <button type="button" class="btn btn-danger btn-sm">Disapprove</button>
                                    </div>
                                </div>
                                <!-- Application 3 -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-0"><strong>Application 3:</strong> Michael Johnson - Web Development</p>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-success btn-sm mr-2">Approve</button>
                                        <button type="button" class="btn btn-danger btn-sm">Disapprove</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Approve All</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approved Enrollment Applications -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Approved Enrollment Applications</h6>
                        <span class="badge badge-success badge-pill" style="font-size: 1.25rem;">5</span> <!-- Increased font size -->
                    </div>
                    <div class="card-body">
                        <p>There are currently 5 approved enrollment applications.</p>
                        <a href="#!" class="btn btn-success">View Approved Applications</a>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <script>
        document.getElementById('show-more-btn').addEventListener('click', function() {
            var moreCourses = document.getElementById('more-courses');
            var btn = document.getElementById('show-more-btn');

            if (moreCourses.style.display === 'none' || moreCourses.style.display === '') {
                moreCourses.style.display = 'block';
                btn.textContent = 'Show Less Courses';
            } else {
                moreCourses.style.display = 'none';
                btn.textContent = 'Show All Courses';
            }
        });
    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>