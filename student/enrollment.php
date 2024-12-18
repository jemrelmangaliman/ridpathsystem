<?php
require '../shared/header_student.php';
$tempid = $_SESSION['user_id'];

$fetchQuery = "SELECT * FROM students WHERE tempID = '$tempid'";
$fetchedData = mysqli_query($conn, $fetchQuery);
$DataArray = mysqli_fetch_assoc($fetchedData);

$firstname = $DataArray['firstname'];
$middlename = $DataArray['middlename'];
$lastname = $DataArray['lastname'];
$email = $DataArray['email'];
$contactnumber = $DataArray['contactnumber'];
$studentnumber = $DataArray['studentnumber'];
$gender = $DataArray['gender'];
$birthday = date('M d, Y', strtotime($DataArray['birthday']));
$address = ($DataArray['address'] != null ) ? $DataArray['address']  : 'Not yet defined';
$disabled = 'disabled';
$buttontype = 'submit';
$examaccess = $DataArray['allowexam'];

//get current school year
$getSchoolYear = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schoolyear WHERE isactive='Yes'"));
$syID = $getSchoolYear['schoolYearID'];
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
        <h1 class="h3 mb-0 text-gray-800">Student Enrollment</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">        
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Enrollment Information</h6>
                    </div>
                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <form action="../processes/Student_SubmitEnrollment.php" method="POST" enctype="multipart/form-data" id="enrollmentform">
                                <div class="row w-100 mx-1">
                                    <div class="col-8">
                                        <h5>Personal Information</h5>
                                        <div class="container-fluid mb-3 py-3 px-4 border shadow">
                                            <!-- Full Name Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Full Name</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small><?php echo $lastname.', '.$firstname.' '.$middlename; ?></small>
                                                </div>
                                            </div> 
                                            <!-- Birthday Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Birthday</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                <small><?php echo $birthday; ?></small>
                                                </div>
                                            </div>
                                            <!-- Gender Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Gender</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                <small><?php echo $gender; ?></small>
                                                </div>
                                            </div>
                                            <!-- Contact Number Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Contact Number</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                <small><?php echo $contactnumber; ?></small>
                                                </div>
                                            </div> 
                                            <!-- Email Address Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Email Address</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small><?php echo $email; ?></small>
                                                </div>
                                            </div> 
                                            <!-- Home Address Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Home Address</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                <small><?php echo $address; ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <h5>Attachments</h5>
                                        <div class="container border shadow mb-3">
                                            <div class="row mx-1 mt-2">
                                            <small><span class="text-danger fw-bold">(Note: Fields with asterisk are required)</span></small>
                                                <div class="col">
                                                    <small>Original Copy of PSA <span class="text-danger fw-bold" id="required-indicator">*</span></small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="psa" id="psa" required>
                                                        <div class="invalid-feedback"><small>PSA is required</small></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <small>Certificate of Good Moral Character</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="goodmoral">
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="row mx-1 mt-2">
                                                <div class="col">
                                                    <small>Original Report Card <span class="text-danger fw-bold" id="required-indicator">*</span></small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="reportcard" id="reportcard">
                                                        <div class="invalid-feedback">Report card is required</div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <small>2pcs 2×2 and 1x1 picture (white background)</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="idpicture">
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="row mx-1 mt-2">
                                                <div class="col">
                                                    <small>Duly Accomplished Enrolment Form <span class="text-danger fw-bold" id="required-indicator">*</span></small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="enrollmentform" id="enrollmentformfile" required>
                                                        <div class="invalid-feedback">Enrollment form is required</div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <small>Certificate of Completion (grade 10)</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="coc">
                                                    </div>
                                                </div>
                                            </div>   
                                            <!-- <div class="row mx-1 mt-2">
                                                <div class="col-6">
                                                    <small>Form 137</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="form137">
                                                    </div>
                                                </div>
                                            </div>   -->
                                        </div>     

                                        <h5>Estimated Enrollment Costs</h5>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="container border shadow pb-2">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small class="fw-bold">Miscellaneous Fees</small>
                                                            <div class="container-fluid m-0 p-0" id="miscfeecontainer">
                                                                <small>₱0.00</small>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="col-4">
                                                <div class="container border shadow pb-2">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small class="fw-bold">Tuition Fee</small>
                                                            <div class="container-fluid m-0 p-0">
                                                                <small>₱<span id="tuitionfeetext">0.00</span></small>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>  
                                            </div>
                                            <div class="col-4">
                                            <div class="container border shadow pb-2">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small clas="fw-bold">Total Enrollment Cost</small>
                                                            <div class="container-fluid m-0 p-0">
                                                                <small><span class="fw-bold">₱<span id="totalamounttext">0.00</span></small>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div>   
                                    </div>

                                    <div class="col-4">
                                        <h5>Other Enrollment Details</h5>
                                        <div class="container border shadow">
                                            <div class="row mx-1 my-3">
                                                <div class="col">
                                                    <small>Student Type</small>
                                                    <?php 
                                                    //if student number is existing, it means the student is an old student
                                                    if($studentnumber == null && $studentnumber == ""){
                                                        echo '<select class="form-select w-100" name="studenttype" required>
                                                        <option value="1">New Student</option>
                                                        <option value="3">Transferee</option>
                                                        </select>';
                                                    }
                                                    else {
                                                        echo '<select class="form-select w-100" required disabled>
                                                        <option value="2">Old Student</option>
                                                        </select>
                                                        <input type="hidden" value="2" name="studenttype">';
                                                    }
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                            <div class="row mx-1 my-3">
                                                <div class="col">
                                                    <small>Grade Level <span class="text-danger">*</span></small>
                                                    <select class="form-select w-100" name="gradelevel" id="gradelevel" onchange="onchangeGradeLevel()" required>
                                                        <option value="11">Grade 11</option>
                                                        <option value="12">Grade 12</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 

                                        <h5 class="mt-2" id="exambutton-label">Examination</h5>
                                        <div class="container border shadow" id="exambutton-container">
                                            <div class="row mx-1 my-3">
                                                <div class="col">
                                                    
                                                    <a href="examination_home.php" id="exambuttonlink"><button class="btn btn-success w-100 ml-auto mr-auto" id="page-btn" type="button">Examination Page</button></a> 
                                                    <small class="text-danger" style="font-size: 11px;">Examination is required to proceed with enrollment</small> 
                                                </div>
                                            </div>
                                            
                                            <?php 
                                            //check if all exams are answered
                                            $getScores = mysqli_query($conn, "SELECT * FROM examcategory ec 
                                            LEFT JOIN examscores es ON ec.examCategoryID = es.examCategoryID
                                            LEFT JOIN strands st ON ec.strandID = st.strandID
                                            WHERE es.studentID = '$tempid' AND es.schoolYearID = '$syID' ORDER BY es.score DESC");
                                            $highestScore = 0;
                                            
                                            
                                            //highscore array
                                            $highScoreArray = [];
                                            $highestScoreCategoryID = [];
                                            $categoryname = [];
                                            $strandname = [];

                                            $CategoryCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM examcategory"));
                                            $ScoreCount = mysqli_num_rows($getScores);
                                           
                                            while ($scoreData = mysqli_fetch_assoc($getScores)) {
                                                if (empty($highScoreArray)) {
                                                    $highScoreArray[] = $scoreData['score'];
                                                    $highestScore = $scoreData['score'];
                                                    $highestScoreCategoryID[] = $scoreData['examCategoryID'];
                                                    $categoryname[] = $scoreData['categoryname'];
                                                    $strandname[] = $scoreData['strandname'];
                                                }
                                                else {
                                                    if ($highestScore == $scoreData['score']) {
                                                        $highScoreArray[] = $scoreData['score'];
                                                        $highestScoreCategoryID[] = $scoreData['examCategoryID'];
                                                        $categoryname[] = $scoreData['categoryname'];
                                                        $strandname[] = $scoreData['strandname'];
                                                    }
                                                }
                                                
                                            }

                                            if ($CategoryCount == $ScoreCount) {
                                                if ($examaccess == 'Yes') {
                                                    mysqli_query($conn, "UPDATE students SET allowexam = 'No' WHERE tempID='$tempid'");
                                                }

                                                echo '<small class=" ml-3 mt-2">Highest Exam Score(s)</small>';
                                                
                                                $counter = 0;
                                                foreach($highScoreArray as $score) {
                                                    echo '  <div class="row mx-1">
                                                        <div class="col">
                                                        <p class="fw-bold"><span class="text-success">'.$score.'/15 ('.$categoryname[$counter].')</span></p>
                                                        </div>
                                                    </div>';
                                                    $counter++;
                                                }
                                               

                                                echo ' <small class=" ml-3 mt-2">Suggested Strand</small>';
                                                $counter = 0;
                                                foreach($highScoreArray as $score) {
                                                    echo '<div class="row mx-1">
                                                        <div class="col">
                                                        <p class="fw-bold"><span class="text-success">'.$strandname[$counter].'</span></p>
                                                        </div>
                                                    </div>
                                                    ';
                                                    $counter++;
                                                }
                                                

                                                $buttontype = 'submit';
                                                $disabled = '';
                                            }
                                            else {
                                                $buttontype = 'button';
                                                $disabled = 'disabled';
                                            }  
                                            ?>
                                            
                                        </div> 

                                        <h5 class="mt-2">Strand Selection</h5>
                                        <div class="container border shadow">
                                            <!-- <div class="row mx-1 my-3">
                                                <div class="col">
                                                    <small>Interests <span class="text-danger">*</span></small>
                                                     <select class="form-select w-100" name="interest" id="interest-dropdown" onchange="getSuggestedStrands()">
                                                        <option value="0" disabled selected>--Select an interest--</option>
                                                        <?php 
                                                        // $fetchQuery2 = "SELECT DISTINCT (description) FROM interests WHERE isactive = 'Yes' ORDER BY description ASC";
                                                        // $fetchedData2 = mysqli_query($conn, $fetchQuery2);
                                                        // while ($DataArray2 = mysqli_fetch_assoc($fetchedData2)) {
                                                        //     echo '<option value="'.$DataArray2['description'].'">'.$DataArray2['description'].'</option>';
                                                        // }
                                                        ?>
                                                    </select>
                                                    <div class="invalid-feedback">Please choose an interest</div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="row mx-1 mt-3">
                                                <div class="col">
                                                    <small>Suggested Strands</small>
                                                    <div class="container" id="suggestedstrandcontainer">
                                                        <p><span class="fw-bold text-success">None</span></p>
                                                    </div>
                                                </div>
                                            </div>  -->
                                            <div class="row mx-1 my-3">
                                                <div class="col">
                                                    <small>Chosen Strand <span class="text-danger">*</span></small>
                                                    <select class="form-select w-100" name="strand" id="strand-dropdown" onchange="getTuitionFee()" required>
                                                        <option value="0" disabled selected>--Select a strand--</option>
                                                        <?php 
                                                        $fetchQuery3 = "SELECT * FROM strands WHERE isactive = 'Yes' ORDER BY strandname ASC";
                                                        $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                        while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                            echo '<option value="'.$DataArray3['strandID'].'">'.$DataArray3['strandname'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="invalid-feedback">Please choose a strand</div>
                                                </div>
                                            </div> 
                                        </div> 
                                        
                                        <div class="row mt-3 ml-2 mr-2">
                                            
                                                <button class="btn btn-success w-100 ml-auto mr-auto" id="page-btn" type="<?php echo $buttontype; ?>" name="EnrollStudent" id="EnrollStudent" onclick="checkEnrollmentInputs(this)" <?php echo $disabled; ?>>Submit Enrollment</button>
                                            
                                        </div>
                                    </div>
                                </div> 
                            </form>
                            
                        </div>
                </div>
            </div>

            <input type="hidden" id="access" value="<?php echo $examaccess; ?>">
    </div>
    <!-- End of Main Content -->
    <script>
        if (document.getElementById('access').value != 'Yes') {
            document.getElementById('exambuttonlink').style.display = 'none';
        }
    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>