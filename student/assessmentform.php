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
        <h1 class="h3 mb-0 text-gray-800">Assessment Form</h1>
        
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
            <button id="downloadBtn">Download PDF</button>
            <?php
            //get current active school year
            $getSchoolYear = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schoolyear WHERE isactive = 'Yes'"));
            $syname = $getSchoolYear['schoolyearname'];
            $syID = $getSchoolYear['schoolYearID'];

            //get student details
            $StudentQuery = "SELECT * FROM students st 
            LEFT JOIN enrollmentrecords er ON st.tempID = er.studentID
            LEFT JOIN enrollmentstatus es ON er.enrollmentStatusID = es.statusID
            LEFT JOIN strands sr ON er.strandID = sr.strandID
            LEFT JOIN studenttype sp ON er.studentTypeID = sp.studentTypeID
            LEFT JOIN sectionstudentlist ssc ON ssc.studentID = st.tempID
            LEFT JOIN sections sc ON sc.sectionID = ssc.sectionID
            WHERE er.schoolYearID = '$syID'";

            $StudentData = mysqli_fetch_assoc(mysqli_query($conn, $StudentQuery));
            $studentname = strtoupper($StudentData['lastname'].', '.$StudentData['firstname'].' '.$StudentData['middlename']);
            $email = $StudentData['email'];
            $strandname = $StudentData['strandname'];
            $studentnumber = $StudentData['studentnumber'];
            $gradelevel = $StudentData['gradelevel'];
            $studenttype = $StudentData['studenttypedescription'];
            $section = $StudentData['sectionname'];
            $sectionID = $StudentData['sectionID'];
            $strandID = $StudentData['strandID'];
            $admissiondate = date('F d, Y', strtotime($StudentData['admissiondate']));
            ?>
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="container shadow bg-white px-4 py-4" id="assessmentform">
                    <div class="container w-75 mt-4" style="margin-right: 120px;">
                        <!--Page Header-->
                        <div class="row">
                            <div class="col-3 d-flex justify-content-end">
                                <img class="img thumbnail" src="../img/ridpath.jpg" style="width: 100px; height: 100px;">
                            </div>
                            <div class="col-9 d-flex align-items-center">
                                <div class="row d-flex flex-column">
                                    <div class="col d-flex justify-content-center">
                                        <small style="font-size: 12px;">Republic of the Philippines</small>
                                    </div>
                                    <div class="col d-flex justify-content-center">
                                        <h4 style="font-family: algerian;" class="text-success fw-bold">Ridpath Academy of Mabuhay</h4>
                                    </div>
                                    <div class="col d-flex justify-content-center" style="margin-top: -10px; font-family: calibri;">
                                        <small class="fw-bold" style="font-size: 15px;">Office of the Registrar</small>
                                    </div>
                                    <div class="col d-flex justify-content-center text-center" style="margin-top: -4px; font-family: calibri;">
                                        <small style="font-size: 12px;">Block 161 Phase 2 Mabuhay City Subdivision, Mamatid, Cabuyao, Laguna</small>
                                    </div>

                                    <div class="col d-flex justify-content-center mt-4" style="font-family: calibri; font-size: 19px;">
                                        <p class="fw-bold">ASSESSMENT FORM</p>
                                    </div>
                                    <div class="col d-flex justify-content-center text-center" style="margin-top: -20px; font-family: calibri;">
                                        <small><?php echo $syname;?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!--Page Header-->
                    </div>

                        <div class="row mt-5" style="font-size: 15px;">
                            <!--Student Information Left Side-->
                            <div class="col-8">
                            
                                <div class="row ml-5">
                                    <div class="col-3">
                                        <small>Student Name:</small>
                                    </div>
                                    <div class="col-9">
                                        <small class="fw-bold"><?php echo $studentname; ?></small>
                                    </div>
                                </div>

                                <div class="row ml-5">
                                    <div class="col-3">
                                        <small>Email:</small>
                                    </div>
                                    <div class="col-9">
                                    <small class="fw-bold"><?php echo $email; ?></small>
                                    </div>
                                </div>
                                <div class="row ml-5">
                                    <div class="col-3">
                                        <small>Student No:</small>
                                    </div>
                                    <div class="col-9">
                                        <small class="fw-bold"><?php echo $studentnumber; ?></small>
                                    </div>
                                </div>
                                <div class="row ml-5">
                                    <div class="col-3">
                                        <small>Strand:</small>
                                    </div>
                                    <div class="col-9">
                                    <small class="fw-bold"><?php echo $strandname; ?></small>
                                    </div>
                                </div>

                            </div>

                            <!--Student Information Right Side-->
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4">
                                        <small>Student Type:</small>
                                    </div>
                                    <div class="col-8">
                                        <small class="fw-bold"><?php echo $studenttype; ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <small>Grade Level:</small>
                                    </div>
                                    <div class="col-8">
                                    <small class="fw-bold">Grade <?php echo $gradelevel; ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <small>Section:</small>
                                    </div>
                                    <div class="col-8">
                                    <small class="fw-bold"><?php echo $section; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                                             
                    <div class="row mt-5 ml-5 mr-5" style="font-size: 15px;">
                        <small class="fw-bold">Class Schedules</small>
                        <div class="row mt-1">
                                <div class="col">
                                    <table class="table table-bordered table-sm w-100" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold">Subject</small></th>
                                                <th scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold">Day</small></th> 
                                                <th scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold">Start Time</small></th>
                                                <th scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold">End Time</small></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            
                                            <?php
                                           
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
                                                <td scope="col" style="border: 1px solid black;"><small class="fw-bold"><?php echo $subjectname; ?></small></td>
                                                <td scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold"><?php echo $dayname; ?></small></td> 
                                                <td scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold"><?php echo $starttimetext; ?></small></td>
                                                <td scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold"><?php echo $endtimetext; ?></small></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                    </div>  

                    <div class="row mt-3 ml-5 mr-5" style="font-size: 15px;">
                        <small class="fw-bold">Assessment Breakdown</small>
                        <div class="row mt-1">
                                <div class="col">
                                    <table class="table table-bordered table-sm w-100" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold">Particulars</small></th> 
                                                <th scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold">Amount</small></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php 
                                            //get tuition fee
                                            $tuitionData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tuitionfees WHERE strandID = '$strandID'"));
                                            $tuitionamount = $tuitionData['amount'];
                                            ?>
                                            <tr>
                                                <td scope="col" style="border: 1px solid black;"><small class="fw-bold">Tuition Fee</small></td>
                                                <td scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold">₱<?php echo $tuitionamount; ?></small></td> 
                                                </tr>
                                            <?php
                                           
                                            $fetchMiscFeeQuery = "SELECT * FROM miscellaneousfees WHERE strandID = '$strandID'";
                                            $fetchMiscFeeData = mysqli_query($conn, $fetchMiscFeeQuery);
                                            $misctotal = 0;
                                            
                                            while($DataArray = mysqli_fetch_assoc($fetchMiscFeeData)){
                                                $description = $DataArray['description'];
                                                $amount = $DataArray['amount'];
                                                $misctotal += $amount;
                                                ?>
                                                <tr>
                                                <td scope="col" style="border: 1px solid black;"><small class="fw-bold"><?php echo $description; ?></small></td>
                                                <td scope="col" class="text-center" style="border: 1px solid black;"><small class="fw-bold">₱<?php echo $amount; ?></small></td> 

                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                    </div> 

                    <div class="row mt-3 ml-5 mr-5" style="font-size: 15px;">
                        <div class="row mt-1">
                                <div class="col">
                                    <table class="table table-bordered table-sm w-100" id="table">
                                        <tbody>
                                                <tr>
                                                    <td scope="col" class="text-center bg-white" rowspan="4" colspan="3" style="border: 2px solid black;">
                                                        <div class="row mt-3">
                                                            <h4 class="fw-bold">Registered</h4>
                                                        </div>
                                                        <div class="row">
                                                            <small style="font-size: 13px;"><?php echo $admissiondate; ?></small>
                                                        </div>
                                                    </td> 
                                                </tr>
                                                <tr>
                                                <td scope="col" style="border: 2px solid black;"><small class="fw-bold float-right">TUITION FEE:</small></td>
                                                <td scope="col" class="text-center" style="border: 2px solid black;"><small class="fw-bold">₱<?php echo $tuitionamount; ?></small></td> 
                                                </tr>
                                                <tr>
                                                <td scope="col" style="border: 2px solid black;"><small class="fw-bold  float-right">OTHER FEES:</small></td>
                                                <td scope="col" class="text-center" style="border: 2px solid black;"><small class="fw-bold">₱<?php echo $misctotal; ?></small></td> 
                                                </tr>
                                                <tr>
                                                <td scope="col" style="border: 2px solid black;"><small class="fw-bold  float-right">TOTAL AMOUNT:</small></td>
                                                <td scope="col" class="text-center" style="border: 2px solid black;"><small class="fw-bold">₱<?php echo $tuitionamount+$misctotal; ?></small></td> 
                                                </tr>
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
    <!-- End of Main Content -->
    <script>
        
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('downloadBtn').addEventListener('click', function() {
                html2canvas(document.getElementById('assessmentform'), {
                scale: 100,
                onrendered: function(canvas) {
                    const imgData = canvas.toDataURL('image/png');
                    
                    // Create jsPDF instance
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();
                    
                    // Add the image to the PDF
                    const scaleFactor = 5;  // Same scale factor used for html2canvas
                    const width = canvas.width / scaleFactor;
                    const height = canvas.height / scaleFactor;

                    // Add image to PDF
                    doc.addImage(imgData, 'PNG', 0, 0, width, height);
                    doc.save('generated.pdf');
                }
            });
            });
        });
        
        


    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   