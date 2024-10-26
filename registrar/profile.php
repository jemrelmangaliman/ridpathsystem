<?php
    require '../shared/header_registrar.php';
?>

<?php require '../shared/action-message.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <?php 
                    $userID = $_SESSION['user_id'];
                    $fetchQuery = "SELECT * FROM users WHERE userID = '$userID'";
                    $fetchedData = mysqli_query($conn, $fetchQuery);
                    $DataArray = mysqli_fetch_assoc($fetchedData);

                    $username = $DataArray['username'];
                    $firstname = $DataArray['firstname'];
                    $lastname = $DataArray['lastname'];
                    $isactive = $DataArray['isActive'];
                    $userrole = $DataArray['userRole'];
                    $registrarChecked = '';
                    $adminChecked = '';

                    switch ($userrole) {
                        case 2:
                            $registrarChecked = 'checked';
                            break;
                        case 1:
                            $adminChecked = 'checked';
                            break;
                    }

                    ?>
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">My Profile > Edit Information</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Actions: </div>
                                            <a class="dropdown-item" href="profile.php">Edit Information</a>
                                            <a class="dropdown-item" href="profile_changepassword.php">Change Password</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                            <form action="../processes/Registrar_EditProfile.php" method="POST">
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Username</small>
                                                        <input type="text" class="form-control" name="userID" hidden value="<?php echo $userID; ?>">
                                                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>"  required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Last Name</small>
                                                        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>First Name</small>
                                                        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <small>User Role</small>
                                                    <div class="col">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="userRole" id="registrar" value="2" required <?php echo $registrarChecked; ?>>
                                                        <label class="form-check-label" for="user">
                                                            Registrar
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="userRole" id="admin" value="1" required <?php echo $adminChecked; ?>>
                                                        <label class="form-check-label" for="admin">
                                                            Administrator
                                                        </label>
                                                    </div>
                                                 
                                                    </div>
                                                </div>
                                                <div class="row mt-3 d-flex justify-content-center">
                                                       <button class="btn btn-success" id="page-btn" type="submit" name="EditUser" style="width:50%;">Save</button>
                                                </div>

                                                
                                            </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Profile Picture</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="container d-flex justify-content-center">
                                        <img class="rounded-circle ml-auto mr-auto" src="<?php echo $profileimgurl; ?>" id="viewInfo-Image">
                                        <button class="btn rounded-circle" title="Change Profile Picture" style="position: absolute;" id="viewInfo-uploadImage" data-bs-toggle="modal" data-bs-target="#modal-Picture"><i class="bi bi-camera-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <div class="modal fade" id="modal-Picture" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST" action="../processes/changeprofilepicture.php" enctype="multipart/form-data">
                            <div class="modal-body p-4" style="font-family: Arial;">
                            <h5>Change Profile Picture</h5>
                                
                            <div class="row">
                                <div class="col">
                                    <small>Image File</small>
                                    <input type="file" class="form-control" name="image" id="picture" accept="image/jpeg, image/png" required>
                                    <div class="invalid-feedback">Image is required</div>

                                    <div class="row d-flex justify-content-center mt-4">
                                    <small class="text-center"><strong>Image Preview</strong></small>
                                        <div class="col-6 d-flex justify-content-center">
                                            <img class="img img-thumbnail" id="image-preview">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div class="row d-flex justify-content-end mt-4">
                                    <input type="hidden" value="registrar" name="returnpage">
                                    <div class="col-6 d-flex">
                                        <button type="button" class="btn btn-secondary w-100" id="button-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    <div class="col-6 d-flex">       
                                        <button type="submit" class="btn btn-success w-100" id="button-customcolor" name="updateStudentPicture"><i class="bi bi-upload"></i> Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#table').DataTable();

        document.getElementById('picture').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image-preview').src = src;
        }
    });
</script>

<?php
    require '../shared/footer.php';
?>
