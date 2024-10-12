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
$tuitionfee = $EnrollmentDetails['amount'];

//get misc fee total using fetched strand ID in the first query
$MiscFeeData = mysqli_query($conn, "SELECT * FROM miscellaneousfees WHERE strandID='$strandID'");
$totalamount = 0;
$totalamount += $tuitionfee; //add the tuition fee to the total amount
while ($Data = mysqli_fetch_assoc($MiscFeeData)) {
    $amount = $Data['amount'];
    $totalamount += $amount; //add the misc fee to the total
}

if ($pmID != "0") {
    $fetchData = mysqli_query($conn, "SELECT * FROM paymentmodes WHERE paymentModeID='$pmID'");
    $DataArray = mysqli_fetch_assoc($fetchData);
    $qrimage = $DataArray['qrimgurl'];
    $accountnumber = $DataArray['accountnumber'];
    $amount = $totalamount;
    $paymenttype = $DataArray['paymenttype'];
}
else {
    $paymenttype = "None";
}



if ($paymenttype == "Online") {
    echo '<div class="row mb-1">
    <div class="col">
        <small>Account Number</small>
        <input type="text" class="form-control" name="accountnumber" value="'.$accountnumber.'" disabled>
    </div>
</div>
 <div class="row mb-1">
    <div class="col">
        <small>Payment Amount</small>
        <input type="text" class="form-control" name="amount" value="'.$amount.'" readonly>
    </div>
</div> 
<div class="row mb-1">
    <div class="col-4">
        <div class="container d-flex justify-content-center">
            <img src="'.$qrimage.'" class="img-thumbnail border shadow" id="qr-preview" style="width: 150px; height: 150px;">
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
            <input type="file" class="form-control" name="paymentproof" required>
        </div>
    </div>
</div>  
<div class="row mb-1">
    <div class="col">
        <small>Payment Remarks</small>
        <textarea name="paymentremarks" class="form-control" placeholder="You can include the payment reference number here or submit any additional information to the registrar"></textarea>
    </div>
</div>
<small class="text-danger">*for offline payments, just submit the payment request in this page and kindly pay at the school registrar right after.</small>
<div class="row mt-3 ml-2 mr-2 mb-3 d-flex justify-content-end">
    <input type="hidden" class="form-control" id ="enrollmentID_hidden" name="enrollmentID" value="'.$enrollmentID.'">
    <div class="col-4">
        <button class="btn btn-success ml-auto mr-auto w-100" id="page-btn" type="submit" name="SendPaymentRequest">Submit Payment</button>
    </div>
</div>
<input type="hidden" name="paymenttype" value="'.$paymenttype.'">
';
}
else if ($paymenttype == "Offline") {
    echo '<div class="row mb-1">
    <div class="col">
        <small>Payment Amount</small>
        <input type="text" class="form-control" name="amount" value="'.$amount.'" readonly>
    </div>
</div>
<div class="row mb-1">
    <div class="col">
        <small>Payment Remarks</small>
        <textarea name="paymentremarks" class="form-control" placeholder="You can include the payment reference number here or submit any additional information to the registrar"></textarea>
    </div>
</div>
<small class="text-danger">*for offline payments, just submit the payment request in this page and kindly pay at the school registrar right after.</small>
<div class="row mt-3 ml-2 mr-2 mb-3 d-flex justify-content-end">
    <input type="hidden" class="form-control" id ="enrollmentID_hidden" name="enrollmentID" value="'.$enrollmentID.'">
    <div class="col-4">
        <button class="btn btn-success ml-auto mr-auto w-100" id="page-btn" type="submit" name="SendPaymentRequest">Submit Payment</button>
    </div>
</div>
<input type="hidden" name="paymenttype" value="'.$paymenttype.'">
';
}
else if ($paymenttype == "None") {

}

?>