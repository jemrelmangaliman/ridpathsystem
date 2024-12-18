<?php
    require '../shared/header_registrar.php';
    
?>

<?php require '../shared/action-message.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Class Students</h1>
                        
                    </div>
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Exam Access Configuration</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                    <div class="container">
                                            
                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover table-bordered table-sm w-100" id="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center" id="th"><small>ID</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Student Name</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Exam Access</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Actions</small></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $fetchQuery = "SELECT * FROM students";
                                                    $fetchedData = mysqli_query($conn, $fetchQuery);

                                                    while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
                                                        $ID = $DataArray['tempID'];
                                                        $fullname = $DataArray['firstname'].' '.$DataArray['middlename'].' '.$DataArray['lastname'];
                                                        $examaccess = $DataArray['allowexam'];

                                                    ?>
                                                        <tr>
                                                            <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                            <td class="text-center" id="td"><?php echo $fullname; ?></td>
                                                            <td class="text-center" id="td"><?php echo $examaccess; ?></td>
                                                            <td class="text-center" id="td">
                                                                <button class="btn btn-success border-0" title="View List" id="table-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-Edit"
                                                                    data-bs-StudentID="<?php echo $ID; ?>">
                                                                    <i class="bi bi-eye-fill" id="table-btn-icon"></i> <span id="tablebutton-text"></span>
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

                                     <!-- Modals -->
                                     <div class="modal fade" id="modal-Edit" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body p-4" style="font-family: Arial;">
                                                            <h5>Edit Access</h5>
                                                            <div class="container mb-2" id="edit-container">
                                                                
                                                            </div>      
                                                    </div>
                                                </div>
                                            </div>
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

    var exampleModal = document.getElementById('modal-Edit');
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var studentID = button.getAttribute('data-bs-StudentID');
        
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
            ajax.open("GET", "../ajax/Registrar_viewExamAccess.php?studentID="+studentID, true);
            ajax.send(); 
    });
    
</script>

<?php
    require '../shared/footer.php';
?>
