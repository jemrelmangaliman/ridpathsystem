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
        <h1 class="h3 mb-0 text-gray-800">Student Enrollment</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">        
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Enrollment Information</h6>
                    </div>
                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <form action="../processes/Student_SubmitEnrollment.php" method="POST" enctype="multipart/form-data">
                                <div class="row w-100 mx-1">
                                    <div class="col-8">
                                        <h5>Personal Information</h5>
                                        <div class="container border shadow mb-3">
                                            <div class="row w-100 mx-1 my-2">
                                                <div class="col">
                                                    <small>First Name</small>
                                                    <p class="border-bottom border-dark fw-bold"><?php echo $firstname; ?></p>
                                                </div>
                                                <div class="col">
                                                    <small>Middle Name</small>
                                                    <p class="border-bottom border-dark fw-bold"><?php echo $middlename; ?></p>
                                                </div>
                                                <div class="col">
                                                    <small>Last Name</small>
                                                    <p class="border-bottom border-dark fw-bold"><?php echo $lastname; ?></p>
                                                </div>
                                            </div> 
                                            <div class="row w-100 mx-1 my-2">
                                                <div class="col-4">
                                                    <small>Contact Number</small>
                                                    <p class="border-bottom border-dark fw-bold"><?php echo $contactnumber; ?></p>
                                                </div>
                                                <div class="col-4">
                                                    <small>Email Address</small>
                                                    <p class="border-bottom border-dark fw-bold"><?php echo $email; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <h5>Attachments</h5>
                                        <div class="container border shadow mb-3">
                                            <div class="row mx-1 mt-2">
                                                <div class="col">
                                                    <small>Original Copy of PSA</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="psa">
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
                                                    <small>Original Report Card</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="reportcard">
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
                                                    <small>Duly Accomplished Enrolment Form</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="enrollmentform">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <small>Certificate of Completion (grade 10)</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="coc">
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="row mx-1 mt-2">
                                                <div class="col-6">
                                                    <small>Form 137</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="form137">
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>     

                                        <h5>Enrollment Costs</h5>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="container border shadow">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small>Miscellaneous Fees</small>
                                                            <div class="container-fluid m-0 p-0" id="miscfeecontainer">
                                                                <p class="fw-bold">₱0.00</p>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="col-4">
                                                <div class="container border shadow">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small>Tuition Fee</small>
                                                            <p><span class="fw-bold">₱<span id="tuitionfeetext">0.00</span></p>
                                                        </div>
                                                    </div> 
                                                </div>  
                                            </div>
                                            <div class="col-4">
                                            <div class="container border shadow">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small>Total Enrollment Cost</small>
                                                            <p><span class="fw-bold">₱<span id="totalamounttext">0.00</span></p>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div>   
                                    </div>

                                    <div class="col-4">
                                        <h5>Strand Selection</h5>
                                        <div class="container border shadow">
                                            <div class="row mx-1 my-3">
                                                <div class="col">
                                                    <small>Interests</small>
                                                    <select class="form-select w-100" name="interest" id="interest-dropdown" onchange="getSuggestedStrands()">
                                                        <option value="0" disabled selected>--Select an interest--</option>
                                                        <?php 
                                                        $fetchQuery2 = "SELECT DISTINCT (description) FROM interests WHERE isactive = 'Yes' ORDER BY description ASC";
                                                        $fetchedData2 = mysqli_query($conn, $fetchQuery2);
                                                        while ($DataArray2 = mysqli_fetch_assoc($fetchedData2)) {
                                                            echo '<option value="'.$DataArray2['description'].'">'.$DataArray2['description'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mx-1 mt-3">
                                                <div class="col">
                                                    <small>Suggested Strands</small>
                                                    <div class="container" id="suggestedstrandcontainer">
                                                        <small><span class="fw-bold">• None</span></small>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row mx-1 my-3">
                                                <div class="col">
                                                    <small>Chosen Strand</small>
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
                                                </div>
                                            </div> 
                                        </div> 
                                        
                                        <div class="row mt-3 ml-2 mr-2">
                                            
                                                <button class="btn btn-success w-100 ml-auto mr-auto" id="page-btn" type="submit" name="EnrollStudent">Submit Enrollment</button>
                                            
                                        </div>
                                    </div>
                                </div> 
                            </form>
                            
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