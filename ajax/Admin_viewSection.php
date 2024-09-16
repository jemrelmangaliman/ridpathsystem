<?php 
$conn = require '../config/config.php';

$sectionID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM sections WHERE sectionID='$sectionID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$sectionname = $DataArray['sectionname'];

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


echo '<form action="../processes/Admin_EditSection.php" method="POST">
                                                <div class="row mb-1">
                                                    <input type="text" class="form-control" name="sectionID" hidden value="'.$sectionID.'">
                                                    <div class="col">
                                                        <small>Strand Name</small>
                                                        <input type="text" class="form-control" name="sectionname" value="'.$sectionname.'" required>
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