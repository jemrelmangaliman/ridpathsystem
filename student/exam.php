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
           
            <!-- exam-->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success"><?php echo $_GET['categoryname']; ?> Examination</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 ml-2">
                                <a href="examination_home.php"><button class="btn btn-secondary" type="button"><i class="bi bi-chevron-left"></i> Go back</button></a>
                                </div>
                            </div>
                            <form method="POST" action="../processes/Student_SubmitExam.php" id="examForm">
                                <?php
                                    $categoryID = $_GET['category'];
                                    $questioncounter = 1;
                                    
                                    //get all the exam categories
                                    $getQuestions = mysqli_query($conn, "SELECT * FROM examquestions WHERE examCategoryID = '$categoryID' ORDER BY questionID ASC");

                                    while($QuestionData = mysqli_fetch_assoc($getQuestions)) {
                                        $questionID = $QuestionData['questionID'];
                                        $question = $QuestionData['question'];

                                        //display the question
                                        echo 
                                        '
                                        <div class="row mx-3">
                                            <div class="col-12 pt-1">
                                                <p class="fw-bold">'.$question.' <span class="text-danger">*</span></p>
                                            </div>
                                        </div>
                                        ';

                                        echo '
                                            <div class="row mx-3 mb-3">
                                            ';
                                        //get question choices
                                        $getChoices = mysqli_query($conn, "SELECT * FROM examchoices WHERE questionID = '$questionID' ORDER BY choiceID ASC");
                                        $choicecounter = 1;
                                        while ($ChoiceData = mysqli_fetch_assoc($getChoices)) {
                                            $choiceID = $ChoiceData['choiceID'];
                                            $choicedesc = $ChoiceData['choicedescription'];
                                            echo '
                                                <div class="col-12 ml-5">
                                                    <input class="form-check-input" type="radio" name="q'.$questioncounter.'" value="'.$choiceID.'" id="q'.$questioncounter.'c'.$choicecounter.'" required>
                                                    <label class="form-check-label" for="q'.$questioncounter.'c'.$choicecounter.'">
                                                        &nbsp'.$choicedesc.'
                                                    </label>
                                                </div>
                                            
                                            ';

                                            $choicecounter++;
                                        }
                                        echo '
                                            </div>
                                            ';

                                        $questioncounter++;
                                    }
                                    
                                ?>
                                <div class="row mx-3 mt-4">
                                    <div class="col-3 pt-1">
                                        <input type="hidden" value="<?php echo $categoryID?>" name="categoryID">
                                        <button class="btn btn-success w-100" type="submit" id="SubmitExam" onclick="disableButton(this)"><i class="bi bi-check-lg"></i> Finish Exam</button>
                                    </div>
                                </div>
                            </form>
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