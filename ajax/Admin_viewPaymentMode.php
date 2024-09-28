<?php 
$conn = require '../config/config.php';

$paymentModeID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM paymentmodes WHERE paymentModeID='$paymentModeID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$paymentmodename = $DataArray['description'];
$paymenttype = $DataArray['paymenttype'];
$status = $DataArray['isactive'];
$qrimageurl = $DataArray['qrimgurl'];
$accountnumber = ($DataArray['accountnumber'] != null ? $DataArray['accountnumber']: 0 );


$isActivetext = '';
$paymenttypetext = '';
$qrimage_display = '';
$accountnumber_display = '';
$srctext ='';

if ($status == "Yes") {
    $isActivetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="v-isactive" id="yes" value="Yes" required checked>
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="v-isactive" id="no" value="No" required>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>';
}
else {
    $isActivetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="v-isactive" id="yes" value="Yes" required>
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="v-isactive" id="no" value="No" required checked>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>';
}

if ($paymenttype == "Online") {
    $paymenttypetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="v-paymenttype" id="v-online" value="Online" required checked>
                                                            <label class="form-check-label" for="yes">
                                                                Online Payment
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="v-paymenttype" id="v-offline" value="Offline" required>
                                                            <label class="form-check-label" for="no">
                                                                Offline payment
                                                            </label>
                                                        </div>';
        
    $qrimage_display .= 'display: block;';
    $accountnumber_display = 'display: block;';
    $srctext .= 'src="'.$qrimageurl.'"';
}
else {
    $paymenttypetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="v-paymenttype" id="v-online" value="Online" required>
                                                            <label class="form-check-label" for="yes">
                                                                Online Payment
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="v-paymenttype" id="v-offline" value="Offline" required checked>
                                                            <label class="form-check-label" for="no">
                                                                Offline payment
                                                            </label>
                                                        </div>';
    
    $qrimage_display .= 'display: none;';
    $accountnumber_display = 'display: none;';
    $srctext .= '';
}


echo '<form action="../processes/Admin_EditPaymentMode.php" method="POST" enctype="multipart/form-data">
                                                <div class="row mb-2">
                                                    <input type="hidden" name="v-paymentmodeID" value="'.$paymentModeID.'"> 
                                                    <div class="col">
                                                        <small>Payment Mode Name</small>
                                                        <input type="text" class="form-control" name="v-paymentmodename" value="'.$paymentmodename.'" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <small>Payment Type</small>
                                                    <div class="col">
                                                        '.$paymenttypetext.'
                                                    </div>
                                                </div>
                                                <div class="row mb-1" id="v-accountnumber-input-container" style="'.$accountnumber_display.'">
                                                    <small>Account Number</small>
                                                    <div class="col">
                                                            <input class="form-control" type="number" name="v-accountnumber" id="v-accountnumber" value="'.$accountnumber.'" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1" id="v-qr-input-container" style="'.$qrimage_display.'">
                                                    <small>QR Code Image</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" id="v-qrimage" accept=".jpg, .jpeg, .png" name="v-qrimage">
                                                    </div>
                                                    <div class="container d-flex justify-content-center">
                                                        <img class="img-thumbnail border shadow" '.$srctext.' id="v-qr-preview">
                                                    </div>
                                                </div> 
                                                <div class="row mb-1">
                                                    <small>Is Active</small>
                                                    <div class="col">
                                                        '.$isActivetext.'
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <center>
                                                        <div class="row">
                                                                <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                                                                <button class="btn btn-success" id="page-btn" name="EditPaymentMode" style="width:50%;">Submit</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>';
?>