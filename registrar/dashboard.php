<?php
require '../shared/header_registrar.php';
$userid = $_SESSION['user_id'];

$fetchPending = "SELECT * FROM enrollmentrecords WHERE enrollmentStatusID = 2";
$fetchForResubmit = "SELECT * FROM enrollmentrecords WHERE enrollmentStatusID = 3";
$fetchForAdmission = "SELECT * FROM enrollmentrecords WHERE enrollmentStatusID = 4";


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
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Row -->
        <div class="row">
            <div class="row">
                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card border-left-primary shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col ml-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Pending Enrollments
                                    </div>
                                    <div class="fs-5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo mysqli_num_rows(mysqli_query($conn, $fetchPending)); ?>
                                    </div>
                                </div>              
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card border-left-success shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col ml-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        For Balance Settlement
                                    </div>
                                    <div class="fs-5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo mysqli_num_rows(mysqli_query($conn, $fetchForAdmission)); ?>
                                    </div>
                                </div>              
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-xl-4 col-md-12 mb-3">
                    <div class="card border-left-danger shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col ml-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        For Resubmission
                                    </div>
                                    <div class="fs-5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo mysqli_num_rows(mysqli_query($conn, $fetchForResubmit)); ?>
                                    </div>
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
                        <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            
                            
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