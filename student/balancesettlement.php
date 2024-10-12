<?php
require '../shared/header_student.php';
$enrollmentID = $_GET['enrollmentID'];
?>


<!-- Begin Page Content -->
<div class="container-fluid">
<input type="hidden" value="<?php echo $enrollmentID;?>" id="enrollmentID">
<?php require '../shared/action-message.php'; ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payment</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">        
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Admission > Balance Settlement</h6>
                    </div>
                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                        <form action="../processes/Student_sendPaymentRequest.php" method="POST" class="mx-4">
                            <div class="row mb-1">
                                <div class="col">
                                    <small>Payment Option</small>
                                    <select class="form-select" name="paymentmode" id="paymentmode" required>
                                        <option value="0">--Select Payment Mode--</option>
                                    <?php
                                        $fetchQuery = "SELECT * FROM paymentmodes WHERE isactive = 'Yes' ORDER BY description ASC";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);

                                        while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
                                                echo '<option value="'.$DataArray['paymentModeID'].'">'.$DataArray['description'].' ('.$DataArray['paymenttype'].')</option>';
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div> 
                            <div class="container-fluid p-0 m-0" id="onlinepayment-container">
                                
                            </div>
                            
                        </form>   
                        </div>
                </div>
            </div>

    </div>
    <!-- End of Main Content -->
    <script>
        
        var paymentOptionDropdown = document.querySelector('#paymentmode');
        var enrollmentID = document.getElementById('enrollmentID');

        paymentOptionDropdown.addEventListener("change", function() {
        var paymentOptionValue = paymentOptionDropdown.value;

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var onlinepaymentcontainer = document.getElementById('onlinepayment-container');
                        onlinepaymentcontainer.innerHTML = this.responseText;               
                    }
                };
            ajax.open("GET", "../ajax/Student_getPaymentDetails.php?pmID="+paymentOptionValue+"&enrollmentID="+enrollmentID.value, true);
            ajax.send();

            });
        

    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>