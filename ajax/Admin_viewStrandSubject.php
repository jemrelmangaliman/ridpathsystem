<?php 
$conn = require '../config/config.php';

$strandSubjectID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM strandsubjects ss
                                        LEFT JOIN strands st ON ss.strandID = st.strandID
                                        LEFT JOIN subjects sj ON ss.subjectID = sj.subjectID
                                        WHERE strandSubjectID = '$strandSubjectID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$strandID = $DataArray['strandID'];
$subjectID = $DataArray['subjectID'];
$status = $DataArray['isactive'];


$isActivetext = '';
$subjectdropdowntext = '';
$stranddropdowntext = '';

$fetchQuery1 = "SELECT * FROM subjects WHERE isactive = 'Yes' ORDER BY subjectname ASC";
$fetchedData1 = mysqli_query($conn, $fetchQuery1);
while ($DataArray1 = mysqli_fetch_assoc($fetchedData1)) {
    if ($DataArray1['subjectID'] == $subjectID) {
        $subjectdropdowntext .= '<option value="' . $DataArray1['subjectID'] . '" selected>' . $DataArray1['subjectname'] . '</option>';
    }
    else {
        $subjectdropdowntext .= '<option value="' . $DataArray1['subjectID'] . '">' . $DataArray1['subjectname'] . '</option>';
    }

}

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


echo '<form action="../processes/Admin_EditStrandSubject.php" method="POST">
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <small for="subject">Strand</small>
                                                            <select class="form-select w-100" name="strand" id="stranddropdown" required>
                                                                <option value="0" disabled selected>--Select a strand--</option>
                                                                '.$stranddropdowntext.'
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <small for="subject">Subject</small>
                                                            <select class="form-select w-100" name="subject" id="subjectdropdown" required>
                                                                <option value="0" disabled selected>--Select a subject--</option>
                                                                '.$subjectdropdowntext.'
                                                            </select>
                                                        </div>
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
                                                         <input type="text" class="form-control" name="strandSubjectID" hidden value="'.$strandSubjectID.'">
                                                                <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                                                                <button class="btn btn-success" id="page-btn" name="EditStrandSubject" style="width:50%;">Submit</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>';
?>