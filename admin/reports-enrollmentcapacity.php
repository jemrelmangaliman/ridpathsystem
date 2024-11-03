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


        <!-- Content Row -->
        <div class="row d-flex">
            <!-- Area Chart -->
            <div class="col">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Section Capacity</h6>
                    </div>

                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row mx-2">
                                <div class="col-12">
                                    <canvas id="barChart-sectionCapacity"></canvas>
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
        fetch('../ajax/getStudentCountPerSection.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('barChart-sectionCapacity').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Available Student Slots',
                        data: data.data,
                        backgroundColor: 'rgba(25,135,84, 0.6)',
                        borderColor: 'rgba(25,135,84, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
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