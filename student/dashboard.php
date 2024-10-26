<?php
require '../shared/header_student.php';
$tempid = $_SESSION['user_id'];

$fetchQuery = "SELECT * FROM enrollmentrecords ER LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID WHERE ER.studentID = '$tempid'";
$fetchedData = mysqli_query($conn, $fetchQuery);
$EnrollmentData = mysqli_fetch_assoc($fetchedData);
$hide = 'style="display: none;"';

if (mysqli_num_rows($fetchedData) != 0) {
    $enrollmentstatus = $EnrollmentData['statusname'];
    $enrollmentbutton = '';
}
else {
    $enrollmentstatus = "Not Enrolled";
    $enrollmentbutton = '<a href="enrollment.php" class="w-100"><button class="btn btn-success w-100" id="page-btn">Enroll Now</button></a>';
    $hide = 'style="display: flex; justify-content: center;"';
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
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Dashboard</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">

                        <div class="container border shadow w-50 py-3">
                                <h5 class="text-center">Quick Links</h5>
                                <div class="row w-75 py-2 ml-auto mr-auto border-bottom">  
                                    <div class="col">
                                        <button class="btn btn-success w-100 fs-4" data-bs-toggle="modal" data-bs-target="#modal-View">View Strand Catalog <i class="bi bi-arrow-right"></i></button>
                                    </div>
                                </div>
                                <div class="row w-75 py-2 ml-auto mr-auto border-bottom  mt-3">  
                                    <div class="col">
                                        <a href="admission.php"><button class="btn btn-success w-100 fs-4">View Enrollment <i class="bi bi-arrow-right"></i></button></a>
                                    </div>
                                </div>
                                <div class="row w-75 py-2 ml-auto mr-auto mt-3">
                                    <div class="col">
                                        <a href="class-schedules.php"><button class="btn btn-success w-100 fs-4">View Schedules  <i class="bi bi-arrow-right"></i></button></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row w-50 mt-5 py-3 border shadow ml-auto mr-auto" <?php echo $hide ;?>>
                                <div class="col">
                                    <p>Not yet enrolled? Begin enrollment here!</p>
                                    <?php echo $enrollmentbutton; ?>
                                </div>
                            </div>

                            
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
       
        <!-- /.container-fluid -->

        <!-- Modals -->
        <div class="modal fade" id="modal-View" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-4" style="font-family: Arial;">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-center">Strands</h4>
                                <div class="accordion" id="accordionPanel">

                                <?php 
                                    //get all strands
                                    $getStrands = mysqli_query($conn,"SELECT * FROM strands");

                                    while ($DataArray = mysqli_fetch_assoc($getStrands)) {
                                        $strandID = $DataArray['strandID'];
                                        $strandname = $DataArray['strandname'];
                                        ?>

                                    <div class="accordion-item">
                                            <button class="accordion-button bg-success text-white border-bottom pl-0"  style="height: 60px;" type="button" id="accordionButton<?php echo $strandID; ?>" data-bs-toggle="collapse" data-bs-target="#accordionCollapsePanel<?php echo $strandID; ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                <p class="fw-bold mt-3 ml-3"><?php echo $strandname; ?></p>
                                            </button>
                                        <div id="accordionCollapsePanel<?php echo $strandID; ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                            <div class="accordion-body p-1">
                                                <p class="fw-bold text-center mt-2 mb-1">Subjects</p>
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <table class="table table-hover table-bordered table-sm w-100" id="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="text-center" id="dashboard-subjects-text"><small class="fw-bold">Grade Level</small></th> 
                                                                    <th scope="col" class="text-center" id="dashboard-subjects-text"><small class="fw-bold">Subject Name</small></th>
                                                                    <th scope="col" class="text-center" id="dashboard-subjects-text"><small class="fw-bold">Pre Requisite</small></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                
                                                                <?php
                                                                $fetchSubjectsQuery = "SELECT sj1.subjectname as subjectname, sj2.subjectname as prsubjectname, ss.gradelevel 
                                                                FROM strandsubjects ss 
                                                                LEFT JOIN subjects sj1 ON ss.subjectID = sj1.subjectID
                                                                LEFT JOIN subjects sj2 ON sj1.pr_subjectID = sj2.subjectID
                                                                WHERE ss.strandID = '$strandID' ORDER BY sj1.subjectname";
                                                                $fetchedSubjectData = mysqli_query($conn, $fetchSubjectsQuery);
                                                                
                                                                while($DataArray = mysqli_fetch_assoc($fetchedSubjectData)){
                                                                    $subjectname = $DataArray['subjectname'];
                                                                    $prsubjectname = ($DataArray['prsubjectname'] != null) ? $DataArray['prsubjectname']: "None";
                                                                    $gradelevel1 = "Grade ".$DataArray['gradelevel'];
                                                                    
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-center" id="dashboard-subjects-text"><?php echo $gradelevel1; ?></td>
                                                                        <td class="text-center" id="dashboard-subjects-text"><?php echo $subjectname; ?></td>
                                                                        <td class="text-center" id="dashboard-subjects-text"><?php echo $prsubjectname; ?></td>
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

                                    <?php
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col  d-flex justify-content-center">
                                <button type="button" id="page-btn" class="btn btn-secondary w-50" data-bs-dismiss="modal">Close</button>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
    </div>

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