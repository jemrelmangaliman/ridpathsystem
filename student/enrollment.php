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
        <h1 class="h3 mb-0 text-gray-800">Enrollment</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Row -->
        <div class="row">
            
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Enrollment</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row w-100 mx-1 d-flex justify-content-end">
                                <div class="col-8">
                                <h5>Personal Information</h5>
                                    <div class="container border shadow">
                                        <div class="row mx-1 my-3">
                                            <div class="col">
                                                <small class="fw-bold">First Name</small>
                                                <p><?php echo $firstname; ?></p>
                                            </div>
                                            <div class="col">
                                                <small class="fw-bold">Middle Name</small>
                                                <p><?php echo $middlename; ?></p>
                                            </div>
                                            <div class="col">
                                                <small class="fw-bold">Last Name</small>
                                                <p><?php echo $lastname; ?></p>
                                            </div>
                                        </div> 
                                        <div class="row mx-1">
                                            <div class="col-4">
                                                <small class="fw-bold">Contact Number</small>
                                                <p><?php echo $contactnumber; ?></p>
                                            </div>
                                            <div class="col-4">
                                                <small class="fw-bold">Email Address</small>
                                                <p><?php echo $email; ?></p>
                                            </div>
                                        </div> 
                                    </div>
                                    
                                </div>
                                <div class="col-4">
                                <h5>Strand Selection</h5>
                                    <div class="container border shadow">
                                        <div class="row mx-1 my-3">
                                            <div class="col">
                                                <small class="fw-bold">Interests</small>
                                                <select class="form-select w-100" id="interest-dropdown">
                                                    <?php 
                                                    $fetchQuery2 = "SELECT * FROM interests WHERE isactive = 'Yes'";
                                                    $fetchedData2 = mysqli_query($conn, $fetchQuery2);
                                                    while ($DataArray2 = mysqli_fetch_assoc($fetchedData2)) {
                                                        echo '<option value="'.$DataArray2['interestID'].'">'.$DataArray2['description'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mx-1 my-3">
                                            <div class="col">
                                                <small class="fw-bold">Suggested Strands</small>
                                                <select class="form-select w-100" id="interest-dropdown">
                                                    <?php 
                                                    $fetchQuery2 = "SELECT * FROM interests WHERE isactive = 'Yes'";
                                                    $fetchedData2 = mysqli_query($conn, $fetchQuery2);
                                                    while ($DataArray2 = mysqli_fetch_assoc($fetchedData2)) {
                                                        echo '<option value="'.$DataArray2['interestID'].'">'.$DataArray2['description'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="row mx-1 my-3">
                                            <div class="col">
                                                <small class="fw-bold">Chosen Strand</small>
                                                <select class="form-select w-100" id="interest-dropdown">
                                                    <?php 
                                                    $fetchQuery3 = "SELECT * FROM strands WHERE isactive = 'Yes'";
                                                    $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                    while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                        echo '<option value="'.$DataArray3['strandID'].'">'.$DataArray3['strandname'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
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