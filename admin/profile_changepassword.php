<?php
    require '../shared/header.php';
?>



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">My Profile > Change Password</h6>
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
                                $currentPassword = $DataArray['password'];

                                ?>
                                            <form action="../processes/Admin_EditProfile_Changepassword.php" method="POST">
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Username</small>

                                                        <input type="text" class="form-control" name="userID" hidden value="<?php echo $userID; ?>">
                                                        <input type="text" class="form-control" name="currentPassword" hidden value="<?php echo $currentPassword; ?>">

                                                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>"  readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Current Password</small>
                                                        <input type="Password" class="form-control" name="currPassword" value="" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>New Password</small>
                                                        <input type="Password" class="form-control" name="newPassword" value="" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Confirm New Password</small>
                                                        <input type="Password" class="form-control" name="confirmnewPassword" value="" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 d-flex justify-content-center">
                                                       <button class="btn btn-success" id="page-btn" type="submit" name="EditUser" style="width:50%;">Save</button>
                                                </div>

                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small style="color:green;"><?php echo $_SESSION['action-success-changepassword']; ?></small>
                                                        <small style="color:red;"><?php echo $_SESSION['action-error-changepassword']; ?></small>
                                                    </div>
                                                </div>

                                            </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php
    require '../shared/footer.php';
?>