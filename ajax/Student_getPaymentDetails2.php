<?php 
$conn = require '../config/config.php';

$pmID = $_REQUEST['pmID'];
$enrollmentID = $_REQUEST['enrollmentID'];

//get the tuition fee amount
$fetchEnrollmentData = mysqli_query($conn, "SELECT * FROM enrollmentrecords er
LEFT JOIN tuitionfees tf ON er.strandID = tf.strandID
WHERE er.enrollmentID='$enrollmentID'");
$EnrollmentDetails = mysqli_fetch_assoc($fetchEnrollmentData);

$strandID = $EnrollmentDetails['strandID'];

if ($pmID != "0") {
    $fetchData = mysqli_query($conn, "SELECT * FROM paymentmodes WHERE paymentModeID='$pmID'");
    $DataArray = mysqli_fetch_assoc($fetchData);
    $qrimage = $DataArray['qrimgurl'];
    $accountnumber = $DataArray['accountnumber'];
    $paymenttype = $DataArray['paymenttype'];
    //$paymentterm = $DataArray['paymentterm'];
}
else {
    $paymenttype = "None";
}



if ($paymenttype == "Online") {
    echo '<div class="row mb-1">
    <div class="col">
        <small>Account Number</small>
        <input type="text" class="form-control" name="accountnumber2" value="'.$accountnumber.'" disabled>
    </div>
</div>
 <div class="row mb-1">
    <div class="col">
        <small>Payment Amount</small>
        <input type="number" class="form-control" name="amount2" required>
    </div>
</div> 
<div class="row mb-1">
    <div class="col-4">
        <div class="container d-flex justify-content-center">
            <img src="'.$qrimage.'" class="img-thumbnail border shadow" id="qr-preview2" style="width: 150px; height: 150px;">
        </div>
    </div>
    <div class="col-8">
        
            <small id="instructions-text" class="fw-bold">Instructions for Online Payments</small>
            <ul>
                <small id="instructions-text"><li>Scan the QR Code or input the account number as the receipient</li></small>
                <small id="instructions-text"><li>Enter the payment amount</li></small>
                <small id="instructions-text"><li>Double check the information, and then send the payment</li></small>
                <small id="instructions-text"><li>Take a screenshot of the payment as proof</li></small>
                <small id="instructions-text"><li>Upload the screenshot in this page that will serve as proof of payment</li></small>
                
            </ul>  
    </div>
</div>
<div class="row mb-1">
    <div class="col">
        <small>Proof of Payment</small>
        <div class="input-group mb-3">
            <input type="file" class="form-control" name="paymentproof2" accept=".jpg, .jpeg, .png" required>
        </div>
    </div>
</div>  
<div class="row mb-1">
    <div class="col">
        <small>Payment Remarks</small>
        <textarea name="paymentremarks2" class="form-control" placeholder="You can include the payment reference number here or submit any additional information to the registrar"></textarea>
    </div>
</div>
<input type="hidden" name="paymenttype2" value="'.$paymenttype.'">
';
}
else if ($paymenttype == "Offline") {
    echo '<div class="row mb-1">
    <div class="col">
        <small>Payment Amount</small>
        <input type="number" class="form-control" name="amount2" required>
    </div>
</div>
<div class="row mb-1">
    <div class="col">
        <small>Payment Remarks</small>
        <textarea name="paymentremarks2" class="form-control" placeholder="You can include the payment reference number here or submit any additional information to the registrar"></textarea>
    </div>
</div>
<input type="hidden" name="paymenttype2" value="'.$paymenttype.'">
';
}
else if ($paymenttype == "None") {

}

?>