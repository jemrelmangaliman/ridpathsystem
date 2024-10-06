<?php
    require '../shared/header.php';
?>



                <!-- Begin Page Content -->
                <div class="container-fluid">

                <?php require '../shared/action-message.php'; ?>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">My Profile > Edit Information</h6>
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
                                        $userChecked = 'checked';
                                        break;
                                    case 1:
                                        $adminChecked = 'checked';
                                        break;
                                }

                                ?>
                                            <form action="../processes/Admin_EditProfile.php" method="POST">
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
                    </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#table').DataTable();
    });
</script>

<?php
    require '../shared/footer.php';
?>
