<?php
    require '../shared/header_registrar.php';
?>

<?php require '../shared/action-message.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Enrollment Records</h1>
                        
                    </div>
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Admission Review and Confirmation</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                    <div class="container">
                                    <div class="table-responsive mt-4">
                                    <table class="table table-hover table-bordered table-sm w-100" id="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="text-center" id="th"><small>ID</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Student Name</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Chosen Strand</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Enrollment Status</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Actions</small></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $fetchQuery = "SELECT * FROM enrollmentrecords ER 
                                        LEFT JOIN  students ST ON ST.tempID = ER.studentID
                                        LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID
                                        LEFT JOIN strands SD ON SD.strandID = ER.strandID WHERE ER.enrollmentStatusID = 5";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);
                                        
                                        while($DataArray = mysqli_fetch_assoc($fetchedData)){
                                            $ID = $DataArray['enrollmentID'];
                                            $studentname = ucfirst($DataArray['lastname']).', '.ucfirst($DataArray['firstname']).' '.ucfirst($DataArray['middlename']);
                                            $strandname = $DataArray['strandname'];
                                            $enrollmentstatus = $DataArray['statusname'];
                                            
                                            ?>
                                            <tr>
                                                <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                <td class="text-center" id="td"><?php echo $studentname; ?></td>
                                                <td class="text-center" id="td"><?php echo $strandname; ?></td>
                                                <td class="text-center" id="td"><?php echo $enrollmentstatus; ?></td>
                                                <td class="text-center" id="td">
                                                <a href="studentenrollmentdetails.php?tempID=<?php echo $ID;?>&pagetitle=For Admission Confirmation&returnpage=foradmission">
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
