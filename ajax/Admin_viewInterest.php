<?php 
$conn = require '../config/config.php';

$interestID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM interests LEFT JOIN strands ON interests.strandID = strands.strandID WHERE interests.interestID='$interestID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$interestname = $DataArray['description'];
$strandID = $DataArray['strandID'];
$strandname = $DataArray['strandname'];
$status = $DataArray['isactive'];


$isActivetext = '';
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

if ($status == "Yes") {
    $isActivetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isactive" id="yes" value="Yes" required checked>
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isactive" id="no" value="No" required>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>';
}
else {
    $isActivetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isactive" id="yes" value="Yes" required>
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isactive" id="no" value="No" required checked>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>';
}


echo '<form action="../processes/Admin_EditInterest.php" method="POST">
                                                <div class="row mb-1">
                                                <input type="text" class="form-control" name="interestID" hidden value="'.$interestID.'">
                                                    <div class="col">
                                                        <small>Interest Name</small>
                                                        <input type="text" class="form-control" name="interestname" value="'.$interestname.'" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Suggested Strand</small>
                                                        <select class="form-select" name="strand" required>
                                                        '.$strandOptiontext.'
                                                        </select>
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
                                                                <button class="btn btn-success" id="page-btn" name="EditInterest" style="width:50%;">Submit</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>';
?>