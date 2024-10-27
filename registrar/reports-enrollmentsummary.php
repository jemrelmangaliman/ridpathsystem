<?php
require '../shared/header_registrar.php';
$userid = $_SESSION['user_id'];

$fetchPending = "SELECT * FROM enrollmentrecords WHERE enrollmentStatusID = 2";
$fetchForResubmit = "SELECT * FROM enrollmentrecords WHERE enrollmentStatusID = 3";
$fetchForBalanceSettlement = "SELECT * FROM enrollmentrecords WHERE enrollmentStatusID = 4";
$fetchForAdmission = "SELECT * FROM enrollmentrecords WHERE enrollmentStatusID = 5";


?>

<?php require '../shared/action-message.php'; ?>

<style>
    .course-hidden {
        display: none;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reports</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row  d-flex justify-content-center">

        <!-- Enrollment Status Count Row -->
        <div class="row">
            <div class="row">
                <div class="col-xl-3 col-md-12 mb-3">
                    <div class="card border-left-success shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col ml-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
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
                <div class="col-xl-3 col-md-12 mb-3">
                    <div class="card border-left-success shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col ml-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        For Balance Settlement
                                    </div>
                                    <div class="fs-5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo mysqli_num_rows(mysqli_query($conn, $fetchForBalanceSettlement)); ?>
                                    </div>
                                </div>              
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-xl-3 col-md-12 mb-3">
                    <div class="card border-left-success shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col ml-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        For Admission Confirmation
                                    </div>
                                    <div class="fs-5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo mysqli_num_rows(mysqli_query($conn, $fetchForAdmission)); ?>
                                    </div>
                                </div>              
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-xl-3 col-md-12 mb-3">
                    <div class="card border-left-success shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col ml-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
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
        </div> 

         <!-- Content Row -->
        <div class="row d-flex">
            <!-- Area Chart -->
            <div class="col">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Enrollment Summary</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row mx-2">
                                <div class="col-12">
                                    <canvas id="barChart-strandStudents"></canvas>
                                </div>

                                <div class="col-12">
                                    <canvas id="lineChart-enrollmentCount"></canvas>
                                </div>
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

        // bar chart for strand students
        fetch('../ajax/getStudentCountPerStrand.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('barChart-strandStudents').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Enrolled Students Per Strand',
                        data: data.data,
                        backgroundColor: 'rgba(25,135,84, 0.6)',
                        borderColor: 'rgba(25,135,84, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

        // bar chart for strand students
        fetch('../ajax/getStudentCountPerSchoolYear.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('lineChart-enrollmentCount').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Enrollment Counts Per School Year',
                        data: data.data,
                        borderColor: 'rgba(25,135,84, 1)',
                        fill: false,
                        borderWidth: 3,
                        tension: 0.5
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>