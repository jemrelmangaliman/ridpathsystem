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
                                    <h6 class="m-0 font-weight-bold text-success">Manage Subjects</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row" id="page-btn-container">
                                        <div class="col-4">
                                        <button class="btn btn-success" id="page-btn" data-bs-toggle="modal" data-bs-target="#modal-Add"><i class="bi bi-plus-lg"></i> Add New Subject</button>
                                        </div>
                                    </div>

                                    <div class="container">
                                    <div class="table-responsive mt-4">
                                    <table class="table table-hover table-bordered table-sm w-100" id="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="text-center" id="th"><small>Subject ID</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Subject Name</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Pre Requisite Subject</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Is Active</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Actions</small></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $fetchQuery = "SELECT sj1.subjectID, sj1.pr_subjectID, sj1.subjectname as subjectname, sj2.subjectname as prerequisite, sj1.isactive
                                        FROM subjects sj1
                                        LEFT JOIN subjects sj2 ON sj1.pr_subjectID = sj2.subjectID";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);
                                        
                                        while($DataArray = mysqli_fetch_assoc($fetchedData)){
                                            $ID = $DataArray['subjectID'];
                                            $subjectname = $DataArray['subjectname'];
                                            $pr_subjectID = $DataArray['pr_subjectID'];
                                            $prerequisite = $DataArray['prerequisite'];
                                            $status = $DataArray['isactive'];
                                            
                                            ?>
                                            <tr>
                                                <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                <td class="text-center" id="td"><?php echo $subjectname; ?></td>
                                                <td class="text-center" id="td">
                                                    <?php 
                                                    if ($pr_subjectID != 0) {
                                                        echo $prerequisite; 
                                                    }
                                                    else {
                                                        echo "None"; 
                                                    }         
                                                    ?>
                                                </td>
                                                <td class="text-center" id="td"><?php echo $status; ?></td>
                                                <td class="text-center" id="td">
                                                    <button class="btn btn-success border-0" title="Edit" id="table-button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-Edit"
                                                            data-bs-subjectID="<?php echo $ID;?>"
                                                            >
                                                            <i class="bi bi-pencil-fill" id="table-btn-icon"></i> <span id="tablebutton-text">Edit</span>
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
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body p-4" style="font-family: Arial;">
                                            <h5>Edit Subject Information</h5>
                                            <div class="container mb-2" id="edit-container">
                                                
                                            </div>      
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal fade" id="modal-Add" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-4" style="font-family: Arial;">
                                        <h5><b>Subject Information</b></h5>
                                        <div class="container mb-2">
                                            <form action="../processes/Admin_AddSubjects.php" method="POST">
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <small>Subject Name</small>
                                                        <input type="text" class="form-control" name="subjectname" required>
                                                    </div>
                                                </div>        
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <small for="subject">Pre Requisite Subject</small>
                                                            <select class="form-select w-100" name="prerequisite" required>
                                                                <option value="0" disabled selected>None</option>
                                                                <?php
                                                                $fetchQuery3 = "SELECT * FROM subjects WHERE isactive = 'Yes' ORDER BY subjectname ASC";
                                                                $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                                while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                                    echo '<option value="' . $DataArray3['subjectID'] . '">' . $DataArray3['subjectname'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                   
                                                <div class="row mb-1">
                                                    <small>Is Active</small>
                                                    <div class="col">
                                                        <div class="form-check form-check-inline">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <center>
                                                        <div class="row">
                                                                <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                                                                <button class="btn btn-success" id="page-btn" name="AddSubject" style="width:50%;">Submit</button>
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
        var subjectID = button.getAttribute('data-bs-subjectID');
        
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
            ajax.open("GET", "../ajax/Admin_viewSubjects.php?ID="+subjectID, true);
            ajax.send(); 
    });

</script>

<?php
    require '../shared/footer.php';
?>
