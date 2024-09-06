<?php 
$conn = require '../config/config.php';

$tuitionID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM tuitionfees LEFT JOIN strands ON tuitionfees.strandID = strands.strandID WHERE tuitionfees.tuitionID='$tuitionID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$amount = $DataArray['amount'];
$strandID = $DataArray['strandID'];
$strandname = $DataArray['strandname'];
$status = $DataArray['isactive'];


$strandOptiontext = '';
$fetchData2 = mysqli_query($conn, "SELECT * FROM strands");
while ($DataArray2 = mysqli_fetch_assoc($fetchData2)) {
    if ($DataArray2['strandID'] == $strandID) {
        $strandOptiontext .= '<option value="'.$DataArray2['strandID'].'" selected>'.$DataArray2['strandname'].'</option>';
    }
    else {
        $strandOptiontext .= '<option value="'.$DataArray2['strandID'].'">'.$DataArray2['strandname'].'</option>';
    }
}




echo '<form action="../processes/Admin_EditTuitionFee.php" method="POST">
                                                <input type="text" class="form-control" name="tuitionID" hidden value="'.$tuitionID.'">
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Strand</small>
                                                        <select class="form-select" name="strand" required>
                                                        '.$strandOptiontext.'
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Amount</small>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">₱</span>
                                                            <input type="number" class="form-control" name="amount" value="'.$amount.'" required>
                                                        </div>
                                                        
                                                    </div>
                                                </div> 
                                                <div class="row mt-3">
                                                    <center>
                                                        <div class="row">
                                                                <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                                                                <button class="btn btn-success" id="page-btn" name="EditTuitionFee" style="width:50%;">Submit</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>';
?>