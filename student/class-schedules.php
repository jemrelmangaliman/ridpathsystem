<?php
require '../shared/header_student.php';
$tempid = $_SESSION['user_id'];

$fetchEnrollment = "SELECT * FROM enrollmentrecords ER LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID WHERE ER.studentID = '$tempid'";
$fetchedData2 = mysqli_query($conn, $fetchEnrollment);
$EnrollmentData = null;
$enrollmentcount = mysqli_num_rows($fetchedData2);
$enrollmentstatusdisplay = '';
$hide = '';

//get current user's section
$CurrentUserData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sectionstudentlist WHERE studentID = '$studentID'"));
$sectionID = '';
$EnrollmentData = mysqli_fetch_assoc($fetchedData2);

//check if there is an active enrollment record
if ($enrollmentcount != 0 && isset($CurrentUserData['sectionID'])) {

    $sectionID = $CurrentUserData['sectionID'];
    $enrollmentstatusdisplay = '';
    $enrollmentstatus = $EnrollmentData['statusname'];
}
else if ($enrollmentcount == 0) {
    $enrollmentstatus = "Not Enrolled";
    $enrollmentstatusdisplay = '<p class="text-danger ml-3">You are not admitted yet. Content cannot be displayed.</p>';
    $hide = 'style="display: none;"'; //used to hide the page
}
else if (!isset($CurrentUserData['sectionID'])) {
    $enrollmentstatus = $EnrollmentData['statusname'];
    $enrollmentstatusdisplay = '<p class="text-danger ml-3">You are not admitted yet. Content cannot be displayed.</p>';
    $hide = 'style="display: none;"'; //used to hide the page
}
?>

<style>
    .course-hidden {
        display: none;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    
<?php require '../shared/action-message.php'; ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card border-left-success shadow h-100 py-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col ml-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Enrollment Status
                                </div>
                                <div class="fs-5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $enrollmentstatus; ?>
                                </div>
                            </div>              
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" >
            <!-- Area Chart -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Class Calendar</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                        <?php echo $enrollmentstatusdisplay;?>
                            <div id="calendar" class="border shadow m-2 p-4" <?php echo $hide; ?>>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Class Schedules</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                        <?php echo $enrollmentstatusdisplay;?>
                            <div class="row mt-1" <?php echo $hide; ?>>
                                <div class="col">
                                    <table class="table table-hover table-bordered table-sm w-100" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center"><small class="fw-bold">Day</small></th> 
                                                <th scope="col" class="text-center"><small class="fw-bold">Subject Name</small></th>
                                                <th scope="col" class="text-center"><small class="fw-bold">Start Time</small></th>
                                                <th scope="col" class="text-center"><small class="fw-bold">End Time</small></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            $studentID = $_SESSION['user_id'];

                                           
                                            $fetchSchedulesQuery = "SELECT * FROM classschedule cs
                                            LEFT JOIN strandsubjects ssb ON cs.strandSubjectID = ssb.strandSubjectID
                                            LEFT JOIN subjects sj ON ssb.subjectID = sj.subjectID
                                            LEFT JOIN days d ON d.dayID = cs.dayID
                                            WHERE cs.sectionID = '$sectionID' ORDER BY d.dayID ASC, cs.starttime ASC";
                                            $fetchedSchedulesData = mysqli_query($conn, $fetchSchedulesQuery);
                                            
                                            while($DataArray = mysqli_fetch_assoc($fetchedSchedulesData)){
                                                $subjectname = $DataArray['subjectname'];
                                                $dayname = $DataArray['dayname'];
                                                $starttime = $DataArray['starttime'];
                                                $endtime = $DataArray['endtime'];

                                                $starttimetext = date('h:i A',strtotime($starttime));
                                                $endtimetext = date('h:i A',strtotime($endtime));
                                                
                                                ?>
                                                <tr>
                                                <td scope="col" class="text-center"><small><?php echo $dayname; ?></small></td> 
                                                <td scope="col" class="text-center"><small><?php echo $subjectname; ?></small></td>
                                                <td scope="col" class="text-center"><small><?php echo $starttimetext; ?></small></td>
                                                <td scope="col" class="text-center"><small><?php echo $endtimetext; ?></small></td>
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
        </div>

        </div>
       
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            //Calendar JS
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: '../ajax/getStudentSchedules.php',
                eventDisplay: 'block',
                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'timeGridDay' // Add buttons for dayGridMonth and timeGridDay views
                },
                initialView: 'timeGridDay',
                allDaySlot: false
                
            });
            calendar.render();

        }); 
    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>