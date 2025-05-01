<?php
    require '../shared/header_registrar.php';
    require '../shared/action-message.php'; ?>

<?php 
$ExamAccessData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM examaccess"));
$examaccess = '';
if($ExamAccessData['accessstatus'] == 1) {
    $examaccess = 'checked';
}
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Examination Access</h1>
                        
                    </div>
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Examination Access</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="../processes/Registrar_UpdateExamAccess.php" method="POST">
                                        <div class="row">
                                            <div class="col-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="examaccessstatus" name="examaccessstatus" value ="checked" <?php echo $examaccess; ?>>
                                                <label class="form-check-label" for="examaccessstatus">Enable Access</label>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-">
                                                <button class="btn btn-success" type="submit">Update</button>
                                            </div>
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

    var exampleModal = document.getElementById('modal-View')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var enrollmentID = button.getAttribute('data-bs-enrollmentID');
        
        //ajax call 
        var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var viewcontainer = exampleModal.querySelector('#view-container');
                    viewcontainer.innerHTML = this.responseText;   
                    }
                    else {
                        console.log(this.status);
                    }
                };
            ajax.open("GET", "../ajax/Registrar_viewPendingEnrollment.php?ID="+enrollmentID, true);
            ajax.send(); 
    });

</script>

<?php
    require '../shared/footer.php';
?>
