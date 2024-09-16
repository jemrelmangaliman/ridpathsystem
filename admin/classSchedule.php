<?php
require '../shared/header.php';

$daylist = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',]







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
                        <h1 class="h3 mb-0 text-gray-800">Manage Enrollment > Class Schedule</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- List of Class Label with Button and Modal -->
                        <div class="row">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    List of Class
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="row mt-3">
                                            <div class="col">
                                                <!-- Button to trigger modal -->
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#addClassModal">Add New Class</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addClassModalLabel">Add New Class</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Modal content (form) -->
                                        <form action="../processes/Admin_AddClassSchedule.php" method="POST" id="addClassForm">
                                            <div class="form-group">
                                                <label for="section">Section</label>
                                                <select class="form-select w-100" name="section" id="sectiondropdown" required>
                                                    <option value="0" disabled selected>--Select a section--</option>
                                                    <?php
                                                    $fetchQuery3 = "SELECT * FROM sections WHERE isactive = 'Yes' ORDER BY sectionname ASC";
                                                    $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                    while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                        echo '<option value="' . $DataArray3['sectionID'] . '">' . $DataArray3['sectionname'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="semester">Semester</label>
                                                <select class="form-select w-100" name="semester" id="semesterdropdown" required>
                                                    <option value="0" disabled selected>--Select a Semester--</option>
                                                    <?php
                                                    $fetchQuery3 = "SELECT * FROM semester WHERE isactive = 'Yes' ORDER BY Semestername ASC";
                                                    $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                    while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                        echo '<option value="' . $DataArray3['semesterID'] . '">' . $DataArray3['semestername'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="subject">Subject</label>
                                                <select class="form-select w-100" name="subject" id="subjectdropdown" required>
                                                    <option value="0" disabled selected>--Select a subject--</option>
                                                    <?php
                                                    $fetchQuery3 = "SELECT * FROM subjects WHERE isactive = 'Yes' ORDER BY subjectname ASC";
                                                    $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                    while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                        echo '<option value="' . $DataArray3['subjectID'] . '">' . $DataArray3['subjectname'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="day">Day</label>
                                                <select class="form-select w-100" name="dayname" id="daydropdown" required>
                                                    <option value="0" disabled selected>--Select a day--</option>
                                                    <?php
                                                    $fetchQuery3 = "SELECT * FROM days ";
                                                    $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                    while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                        echo '<option value="' . $DataArray3['dayID'] . '">' . $DataArray3['dayname'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="end-time">Start Time</label>
                                                <input type="time" class="form-control" id="starttime" name="starttime" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="end-time">End Time</label>
                                                <input type="time" class="form-control" id="endtime" name="endtime" required>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" id="btnSaveClass" class="btn btn-primary">Save Class</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>


                        <!-- Search Field -->
                        <div class="row mb-3">
                            <div class="col-xl-12 col-md-12">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search for classes...">
                            </div>
                        </div>

                        <!-- Class Table -->
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Class Overview</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover table-bordered table-sm w-100" id="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center" id="th"><small>Class ID</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Section Name</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Semester</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Subject</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Day</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Start Time</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>End Time</small></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $fetchQuery = "SELECT * FROM classschedule cs 
                                                    left join sections s on s.sectionID = cs.sectionID
                                                    left join semester st on st.semesterID = cs.semesterID
                                                    left join subjects sb on sb.subjectID = cs.subjectID
                                                    left join days d on d.dayID = cs.dayID
                                                    ";
                                                    $fetchedData = mysqli_query($conn, $fetchQuery);

                                                    while ($DataArray = mysqli_fetch_assoc($fetchedData)) {

                                                        $counter = 0;
                                                        $ID = $DataArray['classID'];
                                                        $sectionname = $DataArray['sectionname'];
                                                        $semestername = $DataArray['semestername'];
                                                        $subjectname = $DataArray['subjectname'];
                                                        $dayname = $DataArray['dayname'];
                                                        $starttime = $DataArray['starttime'];
                                                        $endtime = $DataArray['endtime'];

                                                    ?>
                                                        <tr>
                                                            <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                            <td class="text-center" id="td"><?php echo $sectionname; ?></td>
                                                            <td class="text-center" id="td"><?php echo $semestername; ?></td>
                                                            <td class="text-center" id="td"><?php echo $subjectname; ?></td>
                                                            <td class="text-center" id="td"><?php echo $dayname; ?></td>
                                                            <td class="text-center" id="td"><?php echo $starttime; ?></td>
                                                            <td class="text-center" id="td"><?php echo $endtime; ?></td>
                                                            <td class="text-center" id="td">
                                                                <button class="btn btn-success border-0" title="Edit" id="table-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-Edit"
                                                                    data-bs-SectionID="<?php echo $ID; ?>">
                                                                    <i class="bi bi-pencil-fill" id="table-btn-icon"></i> <span id="tablebutton-text">Edit</span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
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



    <?php
    require '../shared/footer.php';
    ?>