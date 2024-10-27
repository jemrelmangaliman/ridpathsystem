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
                                    <h6 class="m-0 font-weight-bold text-success">Student Records</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <!-- <div class="row" id="page-btn-container">
                                        <div class="col-4">
                                        <button class="btn btn-success" id="page-btn" data-bs-toggle="modal" data-bs-target="#modal-Add"><i class="bi bi-plus-lg"></i> Add New User</button>
                                        </div>
                                    </div> -->

                                    <div class="container">
                                    <div class="table-responsive mt-4">
                                    <table class="table table-hover table-bordered table-sm w-100" id="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="text-center" id="th"><small>ID</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Full Name</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Email</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Contact Number</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Student Number</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Actions</small></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $fetchQuery = "SELECT * FROM students";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);
                                        
                                        while($DataArray = mysqli_fetch_assoc($fetchedData)){
                                            $ID = $DataArray['tempID'];
                                            $fullname = ucfirst($DataArray['firstname']).' '.ucfirst($DataArray['middlename']).' '.ucfirst($DataArray['lastname']);
                                            $email = $DataArray['email'];
                                            $contactnumber = $DataArray['contactnumber'];
                                            $studentnumber = ($DataArray['studentnumber'] != null) ? $DataArray['studentnumber'] : "Not Yet Defined" ;
                                            
                                            ?>
                                            <tr>
                                                <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                <td class="text-center" id="td"><?php echo $fullname; ?></td>
                                                <td class="text-center" id="td"><?php echo $email; ?></td>
                                                <td class="text-center" id="td"><?php echo $contactnumber; ?></td>
                                                <td class="text-center" id="td"><?php echo $studentnumber; ?></td>
                                                <td class="text-center" id="td">
                                                    <button class="btn btn-success border-0" title="Edit Student Details" id="table-button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-Edit"
                                                            data-bs-tempID="<?php echo $ID;?>"
                                                            >
                                                            <i class="bi bi-pencil-fill" id="table-btn-icon"></i>
                                                    </button>   
                                                    <button class="btn btn-secondary border-0" title="Change Password" id="table-button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-EditPassword"
                                                            data-bs-tempID="<?php echo $ID;?>"
                                                            >
                                                            <i class="bi bi-gear-fill" id="table-btn-icon"></i>
                                                    </button>     
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                    </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modals -->
                     <div class="modal fade" id="modal-Edit" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body p-4" style="font-family: Arial;">
                                            <h5>Edit Student Information</h5>
                                            <div class="container mb-2" id="edit-container">
                                                
                                            </div>      
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal fade" id="modal-EditPassword" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-4" style="font-family: Arial;">
                                        <h5><b>Change Password</b></h5>
                                        <div class="container mb-2">
                                            <form action="../processes/Admin_EditStudent.php" method="POST">
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>New Password</small>
                                                        <input type="text" class="form-control" name="password" required>
                                                    </div>
                                                </div> 
                                                <div class="row mt-3">
                                                    <center>
                                                        <div class="row w-100">
                                                            <div class="col">
                                                                <button type="button" id="page-btn" class="btn btn-danger w-100" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                            <div class="col">
                                                                <input type="hidden" class="form-control" name="ID" id="ID" required>
                                                                <button class="btn btn-success w-100" id="page-btn" type="submit" name="EditStudentPassword">Save Password</button> 
                                                            </div>        
                                                        </div>
                                                    </center>
                                                </div>
                                            </form>
                                        </div>                         
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

    var exampleModal = document.getElementById('modal-Edit')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var ID = button.getAttribute('data-bs-tempID');
        
        //ajax call 
        var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var editcontainer = exampleModal.querySelector('#edit-container');
                        editcontainer.innerHTML = this.responseText;   
                    }
                    else {
                        console.log(this.status);
                    }
                };
            ajax.open("GET", "../ajax/Admin_viewStudentRecord.php?ID="+ID, true);
            ajax.send(); 
    });
    var editPasswordModal = document.getElementById('modal-EditPassword')
    editPasswordModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var ID = button.getAttribute('data-bs-tempID');

        editPasswordModal.querySelector('#ID').value = ID;

    });

</script>

<?php
    require '../shared/footer.php';
?>
