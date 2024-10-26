<?php
require '../shared/header_student.php';
$tempid = $_SESSION['user_id'];

$fetchEnrollment = "SELECT * FROM enrollmentrecords ER LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID WHERE ER.studentID = '$tempid'";
$fetchedData2 = mysqli_query($conn, $fetchEnrollment);
$EnrollmentData = null;
$enrollmentcount = mysqli_num_rows($fetchedData2);
$enrollmentstatusdisplay = '';
$hide = '';

//check if there is an active enrollment record
if ($enrollmentcount != 0) {
    $EnrollmentData = mysqli_fetch_assoc($fetchedData2);
    $enrollmentstatusdisplay = '';
    $enrollmentstatus = $EnrollmentData['statusname'];
}
else {
    $enrollmentstatus = "Not Enrolled";
    $enrollmentstatusdisplay = '<p class="text-danger ml-3">You are not admitted yet. Content cannot be displayed.</p>';
    $hide = 'style="display: none;"'; //used to hide the page
}
?>

<?php require '../shared/action-message.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Enrollment Records</h1>
                        
                    </div>

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

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">My Enrollment Records</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                    <div class="container">
                                    <div class="table-responsive mt-4">
                                    <table class="table table-hover table-bordered table-sm w-100" id="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="text-center" id="th"><small>ID</small></th>
                                            <th scope="col" class="text-center" id="th"><small>School Year</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Strand</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Enrollment Status</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Actions</small></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $fetchQuery = "SELECT * FROM enrollmentrecords ER 
                                        LEFT JOIN  students ST ON ST.tempID = ER.studentID
                                        LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID
                                        LEFT JOIN strands SD ON SD.strandID = ER.strandID
                                        LEFT JOIN schoolyear SY ON ER.schoolYearID = SY.schoolYearID
                                        WHERE ER.studentID = '$tempid'";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);
                                        
                                        while($DataArray = mysqli_fetch_assoc($fetchedData)){
                                            $ID = $DataArray['enrollmentID'];
                                            $syname = $DataArray['schoolyearname'];
                                            $strandname = $DataArray['strandname'];
                                            $enrollmentstatus = $DataArray['statusname'];
                                            
                                            ?>
                                            <tr>
                                                <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                <td class="text-center" id="td"><?php echo $syname; ?></td>
                                                <td class="text-center" id="td"><?php echo $strandname; ?></td>
                                                <td class="text-center" id="td"><?php echo $enrollmentstatus; ?></td>
                                                <td class="text-center" id="td">
                                                <a href="studentenrollmentdetails.php?enrollmentID=<?php echo $ID;?>">
                                                        <button class="btn btn-success border-0" title="View" id="table-button">
                                                            <i class="bi bi-eye-fill" id="table-btn-icon"></i> <span id="tablebutton-text">View</span>
                                                        </button>  
                                                    </a>           
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

              

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#table').DataTable();
    });    
</script>

<?php
    require '../shared/footer.php';
?>
