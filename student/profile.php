<?php
    require '../shared/header_student.php';
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
                                    <h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
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
                                $studentID = $_SESSION['user_id'];
                                $fetchQuery = "SELECT * FROM students WHERE tempID = '$studentID'";
                                $fetchedData = mysqli_query($conn, $fetchQuery);
                                $DataArray = mysqli_fetch_assoc($fetchedData);

                                $firstname = $DataArray['firstname'];
                                $middlename = $DataArray['middlename'];
                                $lastname = $DataArray['lastname'];
                                $email = $DataArray['email'];
                                $contactnumber = $DataArray['contactnumber'];
                                $gender = $DataArray['gender'];
                                $birthday = $DataArray['birthday'];
                                $address = $DataArray['address'];
                                ?>
                                            <form action="../processes/Student_EditProfile.php" method="POST">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <small>First Name</small>
                                                        <input type="text" class="form-control" name="userID" hidden value="<?php echo $studentID; ?>">
                                                        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>" placeholder="First Name" required>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <small>Middle Name</small>
                                                        <input type="text" class="form-control" name="middlename" value="<?php echo $middlename; ?>" placeholder="Middle Name" required>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <small>Last Name</small>
                                                        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>" placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <small>Birthday</small>
                                                        <input type="date" name="birthday" class="form-control" value="<?php echo $birthday; ?>">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <small>Gender</small>
                                                        <select class="form-select" name="gender" placeholder="Gender">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                    <small>Contact Number</small>
                                                    <input type="text" class="form-control" name="contactnumber" value="<?php echo $contactnumber; ?>" placeholder="Contact Number" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <small>Email</small>
                                                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email Address" required>
                                                </div>
                                                <div class="form-group">
                                                    <small>Home Address</small>
                                                    <textarea type="text" class="form-control" name="address" placeholder="Home Address" required><?php echo $address; ?></textarea>
                                                </div>
                                                
                                                <div class="row mt-3 d-flex justify-content-center">
                                                       <button class="btn btn-success" id="page-btn" type="submit" name="EditStudent" style="width:50%;">Save Changes</button>
                                                </div>
                                            </form>
                                    
                                </div>
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
