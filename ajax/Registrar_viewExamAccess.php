<?php 
$conn = require '../config/config.php';

$studentID = $_REQUEST['studentID'];
$fetchData = mysqli_query($conn, "SELECT * FROM students WHERE tempID='$studentID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$fullname = $DataArray['firstname'].' '.$DataArray['middlename'].' '.$DataArray['lastname'];
$examaccess = $DataArray['allowexam'];


$accesstext = '';


if ($examaccess == "Yes") {
    $accesstext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="access" id="yes" value="Yes" required checked>
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="access" id="no" value="No" required>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>';
}
else {
    $accesstext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="access" id="yes" value="Yes" required>
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="access" id="no" value="No" required checked>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>';
}


echo '<form action="../processes/Registrar_EditAccess.php" method="POST">
                                                <div class="row mb-1">
                                                <input type="text" class="form-control" name="studentID" hidden value="'.$studentID.'">
                                                    <div class="col">
                                                        <small>Student Name</small>
                                                        <input type="text" class="form-control" value="'.$fullname.'" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <small>Is Active</small>
                                                    <div class="col">
                                                        '.$accesstext.'
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <center>
                                                        <div class="row">
                                                                <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                                                                <button class="btn btn-success" id="page-btn" name="EditAccess" style="width:50%;">Submit</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>';
?>