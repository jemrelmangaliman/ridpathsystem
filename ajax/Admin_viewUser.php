<?php 
$conn = require '../config/config.php';

$userID = $_REQUEST['userID'];
$fetchData = mysqli_query($conn, "SELECT * FROM users WHERE userID='$userID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$username = $DataArray['username'];
$fullname = $DataArray['fullname'];
$lastname = $DataArray['lastname'];
$firstname = $DataArray['firstname'];

$isActive = $DataArray['isActive'];

$userRole = $DataArray['userRole'];


$isActivetext = '';
$userRoletext = '';

if ($isActive == 1) {
    $isActivetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isActive" id="no" value="0" required>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isActive" id="yes" value="1" required checked>
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>';
}
else {
    $isActivetext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isActive" id="no" value="0" required checked>
                                                            <label class="form-check-label" for="no">
                                                                No
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="isActive" id="yes" value="1" required >
                                                            <label class="form-check-label" for="yes">
                                                                Yes
                                                            </label>
                                                        </div>';
}

if ($userRole == 1) {
    $userRoletext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="userRole" id="registrar" value="2" required>
                                                            <label class="form-check-label" for="no">
                                                                Registrar
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="userRole" id="admin" value="1" required checked>
                                                            <label class="form-check-label" for="yes">
                                                                Administrator
                                                            </label>
                                                        </div>';
}
else {
    $userRoletext .= '<div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="userRole" id="registar" value="2" required checked>
                                                            <label class="form-check-label" for="no">
                                                                Registrar
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="userRole" id="admin" value="1" required >
                                                            <label class="form-check-label" for="yes">
                                                                Administrator
                                                            </label>
                                                        </div>';
}

echo '<form action="../processes/Admin_EditUser.php" method="POST">
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>UserName</small>
                                                        <input type="text" class="form-control" name="userID" hidden value="'.$userID.'">
                                                        <input type="text" class="form-control" name="username" value="' .$username. '"  required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Last Name</small>
                                                        <input type="text" class="form-control" name="lastname" value="' .$lastname. '" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>First Name</small>
                                                        <input type="text" class="form-control" name="firstname" value="' .$firstname. '" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <small>User Role</small>
                                                    <div class="col">'
                                                        .$userRoletext.
                                                    '</div>
                                                </div>
                                                <div class="row mb-1">
                                                    <small>is Active</small>
                                                    <div class="col">'
                                                        .$isActivetext.
                                                    '</div>
                                                </div>
                                                <div class="row mt-3">
                                                    <center>
                                                        <div class="row">
                                                                <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                                                                <button class="btn btn-success" id="page-btn" type="submit" name="EditUser" style="width:50%;">Save</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>';
?>