<?php 
$conn = require '../config/config.php';

$sectionID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM sections WHERE sectionID='$sectionID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$sectionname = $DataArray['sectionname'];
$strandID = $DataArray['strandID'];
$gradelevel = $DataArray['gradelevel'];
$defaultslots = $DataArray['defaultslots'];
$availableslots = $DataArray['currentavailableslot'];
$status = $DataArray['isactive'];


$isActivetext = '';
$gradeLeveltext = '';
$stranddropdowntext = '';

$fetchQuery2 = "SELECT * FROM strands WHERE isactive = 'Yes' ORDER BY strandname ASC";
$fetchedData2 = mysqli_query($conn, $fetchQuery2);
while ($DataArray2 = mysqli_fetch_assoc($fetchedData2)) {
    if ($DataArray2['strandID'] == $strandID) {
        $stranddropdowntext .= '<option value="' . $DataArray2['strandID'] . '" selected>' . $DataArray2['strandname'] . '</option>';
    }
    else {
        $stranddropdowntext .=  '<option value="' . $DataArray2['strandID'] . '">' . $DataArray2['strandname'] . '</option>';
    }
}

if ($gradelevel == '11') {
    $gradeLeveltext .= '<option value="11" selected>Grade 11</option>';
    $gradeLeveltext .=  '<option value="12">Grade 12</option>';
}
else if ($gradelevel == '12') {
    $gradeLeveltext .= '<option value="11">Grade 11</option>';
    $gradeLeveltext .=  '<option value="12" selected>Grade 12</option>';
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


echo '<form action="../processes/Admin_EditSection.php" method="POST">

                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <small for="subject">Strand</small>
                                                            <select class="form-select w-100" name="strand" id="stranddropdown" required>
                                                               '.$stranddropdowntext.'
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <small for="subject">Grade Level</small>
                                                            <select class="form-select w-100" name="gradelevel" required>
                                                               '.$gradeLeveltext.'
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <input type="text" class="form-control" name="sectionID" hidden value="'.$sectionID.'">
                                                    <div class="col">
                                                        <small>Strand Name</small>
                                                        <input type="text" class="form-control" name="sectionname" value="'.$sectionname.'" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Default Slot Count</small>
                                                        <input type="number" class="form-control" name="defaultslots" value="'.$defaultslots.'" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Current Available Slots</small>
                                                        <input type="number" class="form-control" name="availableslots" value="'.$availableslots.'" required>
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
                                                                <button class="btn btn-success" id="page-btn" name="EditStrand" style="width:50%;">Submit</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>';
?>