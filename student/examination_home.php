<?php
require '../shared/header_student.php';
$tempid = $_SESSION['user_id'];

$fetchQuery = "SELECT * FROM enrollmentrecords ER LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID WHERE ER.studentID = '$tempid'";
$fetchedData = mysqli_query($conn, $fetchQuery);
$EnrollmentData = mysqli_fetch_assoc($fetchedData);
$hide = 'style="display: none;"';
$gobackbutton = '';

if (mysqli_num_rows($fetchedData) != 0) {
    $enrollmentstatus = $EnrollmentData['statusname'];
    $enrollmentbutton = '';
}
else {
    $enrollmentstatus = "Not Enrolled";
    $enrollmentbutton = '<a href="enrollment.php" class="w-100"><button class="btn btn-success w-100" id="page-btn">Enroll Now</button></a>';
    $hide = 'style="display: flex; justify-content: center;"';
    $gobackbutton = '<a href="enrollment.php"><button class="btn btn-secondary" type="button"><i class="bi bi-chevron-left"></i> Go back to enrollment</button></a>';
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

        <div class="row">
            <div class="row mb-2">
                <div class="col-3 ml-2">
                    <?php echo $gobackbutton; ?>
                </div>
            </div>
            <!-- exam links -->
            <div class="col-xl-7">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Exam Links</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <?php

                                //get current school year
                                $getSchoolYear = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schoolyear WHERE isactive='Yes'"));
                                $syID = $getSchoolYear['schoolYearID'];

                                //get all the exam categories
                                $getCategories = mysqli_query($conn, "SELECT * FROM examcategory ORDER BY categoryname ASC");

                                while($CategoryData = mysqli_fetch_assoc($getCategories)) {
                                    $categoryname = $CategoryData['categoryname'];
                                    $categoryID = $CategoryData['examCategoryID'];
                                    $buttontext='';

                                    //check if there's a score for the category already
                                    $getScore = mysqli_query($conn, "SELECT * FROM examscores WHERE studentID='$tempid' AND examCategoryID = '$categoryID' AND schoolYearID = '$syID'");
                                    if (mysqli_num_rows($getScore) != 0) {
                                        $buttontext = '<p class="text-success"><i class="bi bi-patch-check-fill"></i> Completed</p>';
                                    }
                                    else {
                                        $buttontext = '
                                            <a href="exam.php?category='.$categoryID.'&categoryname='.$categoryname.'"><button class="btn btn-success">Begin Exam <i class="bi bi-chevron-right"></i></button></a>';
                                    }
                                    echo 
                                    '
                                    <div class="row mx-3 mb-3">
                                        <div class="col-8 pt-1">
                                            <h5 class="text-success">'.$categoryname.'</h5>
                                        </div>
                                        <div class="col-4 d-flex justify-content-end">
                                            '.$buttontext.'
                                        </div>
                                    </div>
                                    ';
                                }
                                
                            ?>
                            
                        </div>
                    </div>

                </div>
            </div>

            <!-- Exam Scores -->
            <div class="col-xl-5">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Scores</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                        <?php
                                //get all the exam categories
                                $getCategories = mysqli_query($conn, "SELECT * FROM examcategory ORDER BY categoryname ASC");

                                while($CategoryData = mysqli_fetch_assoc($getCategories)) {
                                    $categoryname = $CategoryData['categoryname'];
                                    $categoryID = $CategoryData['examCategoryID'];
                                    $scoretext='';

                                    //check if there's a score for the category already
                                    $getScore = mysqli_query($conn, "SELECT * FROM examscores WHERE studentID='$tempid' AND examCategoryID = '$categoryID' AND schoolYearID = '$syID'");
                                    if (mysqli_num_rows($getScore) != 0) {
                                        $scoreData = mysqli_fetch_assoc($getScore);
                                        $score = $scoreData['score'];
                                        $scoretext = '<p class="fw-bold"><span class="text-success fs-5">'.$score.'</span>/15</p>';
                                    }
                                    else {
                                        $scoretext = '
                                            <p class="text-danger">Not Yet Scored</p>';
                                    }
                                    echo 
                                    '
                                    <div class="row mx-3 mb-3">
                                        <div class="col-8 pt-1">
                                            <p class="text-success">'.$categoryname.'</p>
                                        </div>
                                        <div class="col-4 d-flex justify-content-end">
                                            '.$scoretext.'
                                        </div>
                                    </div>
                                    ';
                                }
                                
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>

    </div>
    <!-- End of Main Content -->
    <script>
        
    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>