<?php 
$conn = require '../config/config.php';

$semesterID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM semester");
$DataArray = mysqli_fetch_assoc($fetchData);
$semestername = $DataArray['semestername'];
$semesterID = $DataArray['semesterID'];
$startdate = $DataArray['startdate'];
$enddate = $DataArray['enddate'];
$status = $DataArray['isactive'];


$isActivetext = '';

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


echo '<form action="../processes/Admin_EditSemester.php" method="POST">
                                                <div class="row mb-1">
                                                <input type="text" class="form-control" name="semesterID" hidden value="'.$semesterID.'">
                                                    <div class="col">
                                                        <small>semester Name</small>
                                                        <input type="text" class="form-control" name="semestername" value="'.$semestername.'" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                <input type="text" class="form-control" name="semesterID" hidden value="'.$semesterID.'">
                                                    <div class="col">
                                                        <small>semester Name</small>
                                                        <input type="date" class="form-control" name="startdate" value="'.$startdate.'" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                <input type="text" class="form-control" name="semesterID" hidden value="'.$semesterID.'">
                                                    <div class="col">
                                                        <small>semester Name</small>
                                                        <input type="date" class="form-control" name="enddate" value="'.$enddate.'" required>
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
                                                                <button class="btn btn-success" id="page-btn" name="Editsemester" style="width:50%;">Submit</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>';
?>