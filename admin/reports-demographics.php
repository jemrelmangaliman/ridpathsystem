<?php
require '../shared/header.php';
$userid = $_SESSION['user_id'];

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

        <div class="row d-flex">
            <!-- Area Chart -->
            <div class="col">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Enrollment Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="row w-75">
                            <select id="enrollmentstatus-dropdown" class="form-select ml-2"  onchange="updateChart()">
                                <option value="0">All</option>
                                <?php 
                                $getEnrollmentStatus = mysqli_query($conn, "SELECT * FROM enrollmentstatus WHERE statusID NOT IN (3,7,8,9)");
                                while ($DataArray = mysqli_fetch_assoc($getEnrollmentStatus)) {
                                    echo '<option value="'.$DataArray['statusID'].'">'.$DataArray['statusname'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
         <!-- Content Row -->
         <div class="row d-flex">
            <!-- Area Chart -->
            <div class="col-7">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Student Count By Age</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <canvas id="pieChart-studentCountPerAge"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Student Count By Gender</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <canvas id="pieChart-studentCountPerGender"></canvas>
                        </div>
                    </div>
                </div>
            </div>
             
        </div>
    </div>  

</div>
   
    
    <!-- End of Main Content -->
    <script>
        let pieChart1;
        let pieChart2;
        // pie chart for student count per age
        fetch('../ajax/getStudentCountPerAge.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('pieChart-studentCountPerAge').getContext('2d');
            pieChart1 = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Student Count Per Age',
                        data: data.data,
                        backgroundColor: data.backgroundColors,
                        borderWidth: 1
                    }]
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

        // pie chart for student count per age
        fetch('../ajax/getStudentCountPerGender.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('pieChart-studentCountPerGender').getContext('2d');
            pieChart2 = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Student Count Per Gender',
                        data: data.data,
                        backgroundColor: data.backgroundColors,
                        borderWidth: 1
                    }]
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

        function updateChart () {
            var esdropdown = document.getElementById('enrollmentstatus-dropdown');
            var esID = esdropdown.value;
            var ageurl = "";
            var genderurl = "";
            
            
            if (esID == "0") {
                ageurl = "../ajax/getStudentCountPerAge.php";
                genderurl = "../ajax/getStudentCountPerGender.php";
            }
            else {
                ageurl = "../ajax/getStudentCountPerAge.php?id=" + esID;
                genderurl = "../ajax/getStudentCountPerGender.php?id=" + esID;
            }
            

            // pie chart for student count per age
            fetch(ageurl)
            .then(response => response.json())
            .then(data => {

                const ctx = document.getElementById('pieChart-studentCountPerAge').getContext('2d');
                renderChart(data,ctx,pieChart1,"Student Count Per Age");
            })
            .catch(error => console.error('Error fetching data:', error));

            // pie chart for student count per gender
            fetch(genderurl)
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('pieChart-studentCountPerGender').getContext('2d');
                renderChart(data,ctx,pieChart2,"Student Count Per Gender");
            })
            .catch(error => console.error('Error fetching data:', error));
            
        }

        // Function to create or update the pie chart
        function renderChart(data, ctx, pieChart, label) {

            // Check if the chart instance already exists
            if (pieChart) {
                // Clear existing data and update
                pieChart.data.labels = data.labels;
                pieChart.data.datasets[0].data = data.data;
                pieChart.data.datasets[0].backgroundColor = data.backgroundColors;
                pieChart.update();
            } else {
                // Create a new chart instance
                pieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: label,
                            data: data.data,
                            backgroundColor: data.backgroundColors,
                            borderWidth: 1
                        }]
                    }
                });
            }
        }
        
    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>