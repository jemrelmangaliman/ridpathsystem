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


$secondpaymentmode = '';
$fetchQuery = "SELECT * FROM paymentmodes WHERE isactive = 'Yes' ORDER BY description ASC";
$fetchedData = mysqli_query($conn, $fetchQuery);

while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
    $secondpaymentmode .= '<option value="'.$DataArray['paymentModeID'].'">'.$DataArray['description'].' ('.$DataArray['paymenttype'].')</option>';
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
        <input type="number" class="form-control" name="amount" required>
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
            <input type="file" class="form-control" name="paymentproof" accept=".jpg, .jpeg, .png" required>
        </div>
    </div>
</div>  
<div class="row mb-1">
    <div class="col">
        <small>Payment Remarks</small>
        <textarea name="paymentremarks" class="form-control" placeholder="You can include the payment reference number here or submit any additional information to the registrar"></textarea>
    </div>
</div>
<hr>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" name="secondpaymentcheck" id="secondpaymentmode" value="Yes" onchange="displaySecondPaymentMode(this)">
  <label class="form-check-label" for="secondpaymentmode">Pay using another payment mode</label>
</div>
<div class="row mb-1" style="display: none;" id="secondpaymentmode-row">
    <div class="col">
        <small>Secondary Payment Option</small>
        <select class="form-select" name="paymentmode2" id="paymentmode2" required onchange="displaySecondPaymentForm(this)">
            <option value="0">--Select Payment Mode--</option>
            '.$secondpaymentmode.'
        </select>
    </div>
</div> 
<input type="hidden" name="paymenttype" value="'.$paymenttype.'">
';
}
else if ($paymenttype == "Offline") {
    echo '<div class="row mb-1">
    <div class="col">
        <small>Payment Amount</small>
        <input type="number" class="form-control" name="amount" required>
    </div>
</div>
<div class="row mb-1" >
    <div class="col">
        <small>Payment Remarks</small>
        <textarea name="paymentremarks" class="form-control" placeholder="You can include the payment reference number here or submit any additional information to the registrar"></textarea>
    </div>
</div>
<hr>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" name="secondpaymentcheck" value="Yes" id="secondpaymentmode" onchange="displaySecondPaymentMode(this)">
  <label class="form-check-label" for="secondpaymentmode">Pay using another payment mode</label>
</div>
<div class="row mb-1" style="display: none;" id="secondpaymentmode-row">
    <div class="col">
        <small>Secondary Payment Option</small>
        <select class="form-select" name="paymentmode2" id="paymentmode2" required onchange="displaySecondPaymentForm(this)">
            <option value="0">--Select Payment Mode--</option>
            '.$secondpaymentmode.'
        </select>
    </div>
</div> 
<input type="hidden" name="paymenttype" value="'.$paymenttype.'">
';
}
else if ($paymenttype == "None") {

}

?>