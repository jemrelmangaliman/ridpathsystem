<?php
    require '../shared/header_registrar.php';
?>

<?php require '../shared/action-message.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Account Registration</h1>
                        
                    </div>
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Generate Registration Codes</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="../processes/Registrar_SaveRegistrationCode.php" method="POST">
                                        <div class="row">
                                            <small>Registration Code</small>
                                            <div class="col-4">
                                                <input type="text" class="form-control" name="code" id="code" oninput="clearField()" required>
                                                <small class="invalid-feedback">You cannot manually input registration code</small>
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-primary" type="button" onclick="generateCode()" id="generatebutton"><i class="bi bi-receipt-cutoff"></i> Generate</button>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <small>User Email Address</small>
                                            <div class="col-4">
                                                <input type="email" class="form-control" name="email" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-">
                                                <button class="btn btn-success" type="submit">Save Registration Code</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    <div class="container">
                                    <div class="table-responsive mt-4">
                                    <table class="table table-hover table-bordered table-sm w-100" id="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="text-center" id="th"><small>ID</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Code</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Owner Email Address</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Is Used</small></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $fetchQuery = "SELECT * FROM registrationcodes";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);
                                        
                                        while($DataArray = mysqli_fetch_assoc($fetchedData)){
                                            $ID = $DataArray['codeID'];
                                            $code = $DataArray['code'];
                                            $owneremail = $DataArray['owneremail'];
                                            $isused = $DataArray['used'];
                                            
                                            ?>
                                            <tr>
                                                <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                <td class="text-center" id="td"><?php echo $code; ?></td>
                                                <td class="text-center" id="td"><?php echo $owneremail; ?></td>
                                                <td class="text-center" id="td"><?php echo $isused; ?></td>
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
                     <div class="modal fade" id="modal-View" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body p-4" style="font-family: Arial;">
                                            <div class="container mb-2" id="view-container">
                                                
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
