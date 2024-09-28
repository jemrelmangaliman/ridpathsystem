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
                                    <h6 class="m-0 font-weight-bold text-primary">Manage Payment Modes</h6>
                                </div>
                               
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row" id="page-btn-container">
                                        <div class="col-4">
                                        <button class="btn btn-primary" id="page-btn" data-bs-toggle="modal" data-bs-target="#modal-Add"><i class="bi bi-plus-lg"></i> Add New Payment Mode</button>
                                        </div>
                                    </div>

                                    <div class="container">
                                    <div class="table-responsive mt-4">
                                    <table class="table table-hover table-bordered table-sm w-100" id="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="text-center" id="th"><small>Mode ID</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Payment Mode Name</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Payment Type</small></th>
                                            <th scope="col" class="text-center" id="th"><small>QR Image</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Account Number</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Is Active</small></th>
                                            <th scope="col" class="text-center" id="th"><small>Actions</small></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $fetchQuery = "SELECT * FROM paymentmodes";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);
                                        
                                        while($DataArray = mysqli_fetch_assoc($fetchedData)){
                                            $ID = $DataArray['paymentModeID'];
                                            $paymentname = $DataArray['description'];
                                            $paymenttype = $DataArray['paymenttype'];
                                            $status = $DataArray['isactive'];
                                            $qrimgurl = $DataArray['qrimgurl'];
                                            $accountnumber = $DataArray['accountnumber'];
                                            
                                            ?>
                                            <tr>
                                                <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                <td class="text-center" id="td"><?php echo $paymentname; ?></td>
                                                <td class="text-center" id="td"><?php echo $paymenttype; ?></td>
                                                <td class="text-center" id="td">
                                                    <?php 
                                                    if ($qrimgurl != null && $qrimgurl != "") {
                                                        echo '<img src="'.$qrimgurl.'" class="img-thumbnail" id="table-qr-preview">';
                                                    }
                                                    else {
                                                        echo "N/A";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center" id="td">
                                                    <?php 
                                                    if ($accountnumber != null && $accountnumber != "") {
                                                        echo $accountnumber;
                                                    }
                                                    else {
                                                        echo "N/A";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center" id="td"><?php echo $status; ?></td>
                                                <td class="text-center" id="td">
                                                    <button class="btn btn-success border-0" title="Edit" id="table-button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-Edit"
                                                            data-bs-pmID="<?php echo $ID;?>"
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
                                            <h5>Edit Payment Mode Information</h5>
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
                                        <h5><b>Payment Mode Information</b></h5>
                                        <div class="container mb-2">
                                            <form action="../processes/Admin_AddPaymentMode.php" method="POST" enctype="multipart/form-data">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <small>Payment Mode Name</small>
                                                        <input type="text" class="form-control" name="paymentmodename" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <small>Payment Type</small>
                                                    <div class="col">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="paymenttype" id="online" value="Online" required checked>
                                                            <label class="form-check-label" for="yes">
                                                                Online Payment
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="paymenttype" id="offline" value="Offline" required>
                                                            <label class="form-check-label" for="no">
                                                                Offline payment
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-1" id="accountnumber-input-container">
                                                    <small>Account Number</small>
                                                    <div class="col">
                                                            <input class="form-control" type="number" name="accountnumber" id="accountnumber" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-1" id="qr-input-container">
                                                    <small>QR Code Image</small>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" id="qrimage" accept=".jpg, .jpeg, .png" name="qrimage" required>
                                                    </div>
                                                    <div class="container d-flex justify-content-center">
                                                        <img class="img-thumbnail border shadow" id="qr-preview">
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
                                                                <button class="btn btn-success" id="page-btn" name="AddPaymentMode" style="width:50%;">Submit</button>
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

        // Get all radio buttons with the name 'paymenttype' -- ADDING PAYMENT MODES
        var paymentTypeRadios = document.querySelectorAll('input[name="paymenttype"]');
        var qrInputContainer = document.getElementById('qr-input-container');
        var qrImage = document.getElementById('qrimage');
        var accountnumber = document.getElementById('accountnumber'); 
        var accountnumbercontainer = document.getElementById('accountnumber-input-container'); 


        // Add event listeners to each radio button
        paymentTypeRadios.forEach(function(radio) {
            radio.addEventListener("change", function() {
                // Check if the selected radio button's value is 'online'
                if (document.getElementById('online').checked) {
                    qrInputContainer.style.display = 'block';  // Show the qr div
                    qrImage.setAttribute('required','required');

                    accountnumbercontainer.style.display = 'block';  // Show the accountnumber div
                    accountnumber.setAttribute('required','required');
                } else {
                    qrInputContainer.style.display = 'none';   // Hide the qr div
                    qrImage.removeAttribute('required');

                    accountnumbercontainer.style.display = 'none';  // Show the accountnumber div
                    accountnumber.removeAttribute('required');
                }
            });
        });

        document.getElementById('qrimage').addEventListener("change", function (event) {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('qr-preview').src = src;
        });
    });

    var exampleModal = document.getElementById('modal-Edit')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var pmID = button.getAttribute('data-bs-pmID');
        
        //ajax call 
        var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var editcontainer = exampleModal.querySelector('#edit-container');
                        editcontainer.innerHTML = this.responseText;  
                        

                        // Get all radio buttons with the name 'paymenttype' -- EDITING PAYMENT MODES
                        var paymentTypeRadios1 = document.querySelectorAll('input[name="v-paymenttype"]');
                        var qrInputContainer1 = document.getElementById('v-qr-input-container');
                        var qrImage1 = document.getElementById('v-qrimage');
                        var accountnumber1 = document.getElementById('v-accountnumber'); 
                        var accountnumbercontainer1 = document.getElementById('v-accountnumber-input-container'); 


                                // Add event listeners to each radio button
                                paymentTypeRadios1.forEach(function(radio1) {
                                    radio1.addEventListener("change", function() {
                                        // Check if the selected radio button's value is 'online'
                                        if (document.getElementById('v-online').checked) {
                                            qrInputContainer1.style.display = 'block';  // Show the qr div
                                            qrImage1.setAttribute('required','required');

                                            accountnumbercontainer1.style.display = 'block';  // Show the accountnumber div
                                            accountnumber1.setAttribute('required','required');
                                        } else {
                                            qrInputContainer1.style.display = 'none';   // Hide the qr div
                                            qrImage1.removeAttribute('required');

                                            accountnumbercontainer1.style.display = 'none';  // Hide the accountnumber div
                                            accountnumber1.removeAttribute('required');
                                        }
                                    });
                                });

                        qrImage1.addEventListener("change", function (event) {
                        var src = URL.createObjectURL(this.files[0])
                        document.getElementById('v-qr-preview').src = src;
                        });
                    }
                };
            ajax.open("GET", "../ajax/Admin_viewPaymentMode.php?ID="+pmID, true);
            ajax.send(); 
            
            
            
    });

</script>

<?php
    require '../shared/footer.php';
?>
