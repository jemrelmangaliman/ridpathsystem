<?php
require '../shared/header_student.php';
$enrollmentID = $_GET['enrollmentID'];

// //get payment transaction record for the enrollment record
// $GetPaymentRecord = mysqli_query($conn, "SELECT * FROM paymentrecord pr
// LEFT JOIN paymentmodes pm ON pr.paymentModeID = pm.paymentModeID
// WHERE pr.enrollmentID='$enrollmentID'");
// if(mysqli_num_rows($GetPaymentRecord) == 1) {
//     $_SESSION['action-error'] = "A payment request is already submitted.";
//     echo "<script>
//     window.location.href = 'admission.php';
//     </script>";
// }

//get the tuition fee amount
$fetchEnrollmentData = mysqli_query($conn, "SELECT * FROM enrollmentrecords er
LEFT JOIN tuitionfees tf ON er.strandID = tf.strandID
WHERE er.enrollmentID='$enrollmentID'");
$EnrollmentDetails = mysqli_fetch_assoc($fetchEnrollmentData);

$strandID = $EnrollmentDetails['strandID'];
$tuitionfee = $EnrollmentDetails['amount'];

//get misc fee total using fetched strand ID in the first query
$MiscFeeData = mysqli_query($conn, "SELECT * FROM miscellaneousfees WHERE strandID='$strandID'");
$totalamount = 0;
$totalamount += $tuitionfee; //add the tuition fee to the total amount
while ($Data = mysqli_fetch_assoc($MiscFeeData)) {
    $amount = $Data['amount'];
    $totalamount += $amount; //add the misc fee to the total
}

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
                        <form action="../processes/Student_sendPaymentRequest.php" method="POST" enctype="multipart/form-data" class="mx-4">
                            <div class="row mb-1">
                                <div class="col">
                                    <small>Payment Terms</small>
                                    <?php
                                        $fetchQuery = "SELECT * FROM enrollmentrecords WHERE enrollmentID = '$enrollmentID'";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);
                                        $enrollmentData = mysqli_fetch_assoc($fetchedData);
                                        $paymentterm = ($enrollmentData['paymentterm'] != "" && $enrollmentData['paymentterm'] != null) ? $enrollmentData['paymentterm'] : "";
                                    
                                        if ($paymentterm != "") {
                                            echo '
                                            <select class="form-select" disabled>
                                            <input type="hidden" name="paymentterm" id="paymentterm" value="'.$paymentterm.'">
                                            ';
                                        }
                                        else {
                                            echo '<select class="form-select" name="paymentterm" id="paymentterm" required>';
                                        }
                                        ?>
                                        <option value="0">--Select Payment Term--</option>
                                        <?php 

                                        if ($paymentterm == "Full") {
                                            echo '
                                            <option value="Full" selected>Full</option>
                                            <option value="Partial">Partial</option>
                                            ';
                                        }
                                        else if ($paymentterm == "Partial") {
                                            echo '
                                            <option value="Full">Full</option>
                                            <option value="Partial" selected>Partial</option>
                                            ';
                                        }
                                        else {
                                            echo '
                                            <option value="Full">Full</option>
                                            <option value="Partial">Partial</option>
                                            ';
                                        }
                                        ?>    
                                    </select>
                                </div>
                            </div> 
                            <div class="row mb-1">
                                <div class="col">
                                    <small>Primary Payment Option</small>
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
                            <div class="row mb-1">
                                <div class="col">
                                    <small>Total Payable Amount (Tuition Fee + Miscellaneous Fees)</small>
                                    <input type="number" class="form-control" value="<?php echo $totalamount; ?>" disabled>
                                </div>
                            </div> 
                            <div class="container-fluid p-0 m-0" id="onlinepayment-container">
                                
                            </div>
                            <div class="container-fluid p-0 m-0" id="onlinepayment-container2">
                                
                            </div>
                            <div class="row mt-3 ml-2 mr-2 mb-3 d-flex justify-content-end">
                                <input type="hidden" class="form-control" id ="enrollmentID_hidden" name="enrollmentID" value="<?php echo $enrollmentID; ?>">
                                <div class="col-4">
                                    <button class="btn btn-success ml-auto mr-auto w-100" id="page-btn" type="submit" name="SendPaymentRequest" disabled>Submit Payment</button>
                                </div>
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

            if (paymentOptionValue != "0") {
                document.getElementById('page-btn').removeAttribute('disabled');
            }
            else {
                document.getElementById('page-btn').disabled = true
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