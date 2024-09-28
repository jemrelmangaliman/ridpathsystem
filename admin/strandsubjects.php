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
                                    <h6 class="m-0 font-weight-bold text-primary">Manage Strand Subjects</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row" id="page-btn-container">
                                        <div class="col-4">
                                        <button class="btn btn-primary" id="page-btn" data-bs-toggle="modal" data-bs-target="#modal-Add"><i class="bi bi-plus-lg"></i> Add New Strand Subject</button>
                                        </div>
                                    </div>

                                    <div class="container">
                                    <div class="table-responsive mt-4">
                                    <table class="table table-hover table-bordered table-sm w-100" id="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="text-center" id="th"><small>ID</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Strand Name</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Subject</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Is Active</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Actions</small></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $fetchQuery = "SELECT * FROM strandsubjects ss
                                        LEFT JOIN strands st ON ss.strandID = st.strandID
                                        LEFT JOIN subjects sj ON ss.subjectID = sj.subjectID
                                        ";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);
                                        
                                        while($DataArray = mysqli_fetch_assoc($fetchedData)){
                                            $ID = $DataArray['strandSubjectID'];
                                            $strandname = $DataArray['strandname'];
                                            $subjectname = $DataArray['subjectname'];
                                            $status = $DataArray['isactive'];
                                            
                                            ?>
                                            <tr>
                                                <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                <td class="text-center" id="td"><?php echo $strandname; ?></td>
                                                <td class="text-center" id="td"><?php echo $subjectname; ?></td>
                                                <td class="text-center" id="td"><?php echo $status; ?></td>
                                                <td class="text-center" id="td">
                                                    <button class="btn btn-success border-0" title="Edit" id="table-button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-Edit"
                                                            data-bs-ID="<?php echo $ID;?>"
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
                                            <h5>Edit Strand Information</h5>
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
                                        <h5><b>New Item</b></h5>
                                        <div class="container mb-2">
                                            <form action="../processes/Admin_AddStrandSubject.php" method="POST">
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <small for="subject">Strand</small>
                                                            <select class="form-select w-100" name="strand" id="stranddropdown" required>
                                                                <option value="0" disabled selected>--Select a strand--</option>
                                                                <?php
                                                                $fetchQuery3 = "SELECT * FROM strands WHERE isactive = 'Yes' ORDER BY strandname ASC";
                                                                $fetchedData3 = mysqli_query($conn, $fetchQuery3);
                                                                while ($DataArray3 = mysqli_fetch_assoc($fetchedData3)) {
                                                                    echo '<option value="' . $DataArray3['strandID'] . '">' . $DataArray3['strandname'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <small for="subject">Subject</small>
                                                            <select class="form-select w-100" name="subject" id="subjectdropdown" required>
                                                                <option value="0" disabled selected>--Select a subject--</option>
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
                                                                <button class="btn btn-success" id="page-btn" name="AddStrandSubject" style="width:50%;">Submit</button>
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
        var ID = button.getAttribute('data-bs-ID');
        
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
            ajax.open("GET", "../ajax/Admin_viewStrandSubject.php?ID="+ID, true);
            ajax.send(); 
    });

</script>

<?php
    require '../shared/footer.php';
?>
