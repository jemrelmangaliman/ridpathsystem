<?php
require '../shared/header_student.php';
$tempid = $_SESSION['user_id'];

$fetchQuery = "SELECT * FROM students ST 
LEFT JOIN enrollmentrecords ER ON ST.tempID = ER.studentID
LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID
LEFT JOIN strands SD ON SD.strandID = ER.strandID
LEFT JOIN tuitionfees TF ON TF.strandID = SD.strandID
WHERE ST.tempID = '$tempid'";
$fetchedData = mysqli_query($conn, $fetchQuery);
$DataArray = mysqli_fetch_assoc($fetchedData);

$firstname = $DataArray['firstname'];
$middlename = $DataArray['middlename'];
$lastname = $DataArray['lastname'];
$email = $DataArray['email'];
$contactnumber = $DataArray['contactnumber'];
$strandname = $DataArray['strandname'];
$tuitionfee = $DataArray['amount'];
$enrollmentstatus = $DataArray['statusname'];
$enrollmentstatusID = $DataArray['statusID'];
$strandID = $DataArray['strandID'];
$interest = $DataArray['interest'];
$enrollmentID = $DataArray['enrollmentID'];

$proceedtopayment = '';
$resubmit = 'disabled';

if ($enrollmentstatusID != 4) {
    $proceedtopayment = 'disabled';
}

if ($enrollmentstatusID == 3) {
    $resubmit = '';
}

//get misc fee total using fetched strand ID in the first query
$MiscFeeData = mysqli_query($conn, "SELECT * FROM miscellaneousfees WHERE strandID='$strandID'");
$totalamount = 0;
$totalamount += $tuitionfee; //add the tuition fee to the total amount
$miscfeetext = '';

if (mysqli_num_rows($MiscFeeData) != 0) {
   while ($Data = mysqli_fetch_assoc($MiscFeeData)) {
    $amount = $Data['amount'];
    $totalamount += $amount; //add the misc fee to the total
    $description = $Data['description'];
    $miscfeetext .= '<p><span class="fw-bold">₱'.$amount.' </span>('.$description.')</p>';   
   }
}
else {
    $miscfeetext = '<p><span class="fw-bold">₱0.00 </span></p>';
}


$fetchEnrollment = "SELECT * FROM enrollmentrecords WHERE studentID = '$tempid'";
$fetchedData2 = mysqli_query($conn, $fetchEnrollment);
$enrollmentcount = mysqli_num_rows($fetchedData2);
$enrollmentstatusdisplay = '';

if ($enrollmentcount != 0) {
    $enrollmentstatusdisplay = '';
}
else {
    $enrollmentstatusdisplay = '<p class="text-danger">You have no active enrollment record yet!</p>';
}


//get current uploaded enrollment attachments
$attachmentlist = ['psa','goodmoral','reportcard','idpicture','enrollmentform','coc','form137'];
$attachmentlabellist = 
['Original Copy of PSA','Certificate of Good Moral Character','Original Report Card','2pcs 2×2 and 1x1 picture (white background)','Duly Accomplished Enrolment Form','Certificate of Completion (grade 10)','Form 137'];
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
        <h1 class="h3 mb-0 text-gray-800">Admission</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">        
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Admission Details</h6>
                    </div>
                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                                <div class="row w-100 mx-1">
                                    <div class="col-8">
                                        <?php echo $enrollmentstatusdisplay;?>
                                        <h5>Personal Information</h5>
                                        <div class="container border shadow mb-3">
                                            <div class="row w-100 mx-1 mt-2">
                                                <div class="col">
                                                    <small id="small">First Name</small>
                                                    <p class="fw-bold"><?php echo $firstname; ?></p>
                                                </div>
                                                <div class="col">
                                                    <small id="small">Middle Name</small>
                                                    <p class="fw-bold"><?php echo $middlename; ?></p>
                                                </div>
                                                <div class="col">
                                                    <small id="small">Last Name</small>
                                                    <p class="fw-bold"><?php echo $lastname; ?></p>
                                                </div>
                                            </div> 
                                            <div class="row w-100 mx-1 mb-2">
                                                <div class="col-4">
                                                    <small id="small">Contact Number</small>
                                                    <p class="fw-bold"><?php echo $contactnumber; ?></p>
                                                </div>
                                                <div class="col-4">
                                                    <small id="small">Email Address</small>
                                                    <p class="fw-bold"><?php echo $email; ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <h5>Enrollment Information</h5>
                                        <div class="container border shadow mb-3">
                                            <div class="row w-100 mx-1 my-2">
                                                <div class="col-4">
                                                    <small>Interest</small>
                                                    <p class="fw-bold"><?php echo $interest; ?></p>
                                                </div>
                                                <div class="col-8">
                                                    <small>Selected Strand</small>
                                                    <p class="fw-bold"><?php echo $strandname; ?></p>
                                                </div>
                                            </div> 
                                            <div class="row w-100 mx-1 my-2">
                                                <div class="col">
                                                    <small>Enrollment Status</small>
                                                    <h5 class="fw-bold text-primary"><?php echo $enrollmentstatus; ?></h5>
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
                                                            <?php echo $miscfeetext; ?>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="col-4">
                                                <div class="container border shadow">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small>Tuition Fee</small>
                                                            <p><span class="fw-bold">₱<span id="tuitionfeetext"><?php echo $tuitionfee; ?>.00</span></p>
                                                        </div>
                                                    </div> 
                                                </div>  
                                            </div>

                                            <div class="col-4">
                                            <div class="container border shadow">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small>Total Enrollment Cost</small>
                                                            <p><span class="fw-bold">₱<span id="totalamounttext"><?php echo $totalamount; ?>.00</span></p>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row w-100 mt-3 ml-1 mb-3">
                                                <div class="col">
                                                    <button class="btn btn-success w-100 ml-auto mr-auto" 
                                                    id="page-btn" name="UpdateChecklist"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-View"
                                                    data-bs-enrollmentID="<?php echo $enrollmentID;?>" 
                                                    <?php echo $proceedtopayment; ?>>Proceed to Payment</button>
                                                </div>
                                                <div class="col">
                                                    <form action="../processes/Student_ResubmitEnrollment.php" method="POST">
                                                        <input type="hidden" value="<?php echo $enrollmentID; ?>" name="enrollmentID">
                                                        <button class="btn btn-success w-100 ml-auto mr-auto" id="page-btn" type="submit" name="Resubmit" <?php echo $resubmit; ?>>Resubmit Enrollment</button>
                                                    </form> 
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="col-4">
                                        <form action="../processes/Student_UpdateChecklist.php" method="POST" enctype="multipart/form-data">
                                            <h5>Checklist</h5>
                                            <div class="container border shadow">
                                                <?php 
                                                $ctr = 0;
                                                if ($enrollmentcount != 0) {
                                                    foreach ($attachmentlist as $attachmentitem) {
                                                        $isfound = 0;
                                                        $attachmentname = '';
                                                        $attachmentlabel = $attachmentlabellist[$ctr];
                                                        $attachmentsData = mysqli_query($conn, "SELECT * FROM fileattachments WHERE enrollmentID='$enrollmentID'");
                                                        
                                                        while ($fetchedAttachments = mysqli_fetch_assoc($attachmentsData)) {
                                                                $attachmentname = $fetchedAttachments['attachmentname'];
                                                                $filename = $fetchedAttachments['filename'];
                                                                $attachmentlink = $fetchedAttachments['attachmenturl'];
                                                                if ($attachmentitem == $attachmentname) {
                                                                    echo '<div class="row mx-1 mt-2">
                                                                            <div class="col">
                                                                                <small>'.$attachmentlabel.'</small>
                                                                                <div class="input-group mb-3">
                                                                                    <i class="bi bi-check-circle-fill text-success mr-2"></i><a href="'.$attachmentlink.'" download="'.$filename.'">'.$filename.'</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>';
                                                                    $isfound = 1;
                                                                    break;
                                                                }  
                                                        } 
                                                        
                                                        //if an attachment is not found, display a file input field instead
                                                        if ($isfound == 0) {
                                                            echo '<div class="row mx-1 mt-2">
                                                                    <div class="col">
                                                                        <small>'.$attachmentlabel.'</small>
                                                                        <div class="input-group mb-3">
                                                                            <input type="file" class="form-control" name="'.$attachmentitem.'">
                                                                        </div>
                                                                    </div>
                                                                </div>   ';
                                                        }
                                                        $ctr++;
                                                    }
                                                }
                                                ?>
                                                <div class="row mt-3 ml-2 mr-2 mb-3">
                                                    <input type="hidden" class="form-control" name="enrollmentID" value="<?php echo $enrollmentID; ?>">
                                                    <button class="btn btn-success w-100 ml-auto mr-auto" id="page-btn" type="submit" name="UpdateChecklist">Update Checklist</button>
                                                </div>
                                            </div> 
                                        </form>
                                    </div>
                                </div> 
                        </div>
                </div>
            </div>
<!-- Modals -->
<div class="modal fade" id="modal-View" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4" style="font-family: Arial;">
                        <h5>Select Payment Mode</h5>
                        <form action="../processes/Student_updatePaymentMode.php" method="POST">
                            <div class="row mb-1">
                                <div class="col">
                                    <small>Payment Option</small>
                                    <select class="form-select" name="paymentmode" id="paymentmode" required>
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
                                    <div class="container d-flex justify-content-center">
                                        <img class="img-thumbnail border shadow" id="qr-preview" style="display: none; width: 300px; height: 300px;">
                                    </div>
                                </div>
                            </div>
                            <small class="text-danger">*for offline payments, please pay at the school registrar.</small>
                            <div class="row mt-3 ml-2 mr-2 mb-3">
                                <input type="hidden" class="form-control" id ="enrollmentID_hidden" name="enrollmentID">
                                <div class="col">
                                    <button class="btn btn-success ml-auto mr-auto w-100" id="page-btn" type="button" name="UpdateChecklist">Save</button>
                                </div>
                                <div class="col">
                                    <button type="button" id="page-btn" class="btn btn-danger w-100" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>   
                </div>
            </div>
        </div>
</div>

    </div>
    <!-- End of Main Content -->
    <script>
        var exampleModal = document.getElementById('modal-View')
        exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var enrollmentID = button.getAttribute('data-bs-enrollmentID');
        
        var enrollmentIDHidden = exampleModal.querySelector('#enrollmentID_hidden'); 

        enrollmentIDHidden.value = enrollmentID;

        var paymentOptionDropdown = exampleModal.querySelector('#paymentmode');
        var qrPreview = exampleModal.querySelector('#qr-preview');

        paymentOptionDropdown.addEventListener("change", function() {
            var paymentOptionValue = paymentOptionDropdown.value;

            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var src = this.responseText;

                        if (src != "") {
                            qrPreview.style.display = "block";
                            qrPreview.src = src;
                        }
                        else {
                            qrPreview.style.display = "none";
                        }
                    }
                };
            ajax.open("GET", "../ajax/Student_getQRurl.php?ID="+paymentOptionValue, true);
            ajax.send();

            });
        


    });
    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>