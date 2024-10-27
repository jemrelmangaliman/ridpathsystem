<?php
    require '../shared/header.php';

    $fetchCurrentSchoolYear = mysqli_query($conn, "SELECT * FROM schoolyear WHERE isactive = 'Yes'");
    $DataArray = mysqli_fetch_assoc($fetchCurrentSchoolYear);
?>



                <!-- Begin Page Content -->
                <div class="container-fluid">

                <?php require '../shared/action-message.php'; ?>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow" style="height: 70vh;">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">End School Year</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body d-flex align-items-center">
                                    <div class="container border shadow w-50 py-3">
                                        <div class="row w-75 py-2 ml-auto mr-auto">  
                                            <div class="col">
                                                <button class="btn btn-danger w-100 fs-3" data-bs-toggle="modal" data-bs-target="#modal-View">End Current School Year</button>
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

    <!-- Modals -->
    <div class="modal fade" id="modal-View" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4" style="font-family: Arial;">
                        <div class="container mb-2" id="view-container">
                            <form action="../processes/endCurrentSchoolYear.php" method="POST">
                                <h5 class="text-danger"><b>Warning</b></h5>
                                <div class="row">
                                    <div class="col">
                                        <p>Ending the current school year will:</p>
                                        <ul>
                                        <li><small>End the current school year <span class="text-success fw-bold">(<?php echo $DataArray['schoolyearname'].' - '.date('M d, Y' , strtotime($DataArray['startdate'])).' to '.date('M d, Y' , strtotime($DataArray['enddate'])) ?>)</span></small></li>
                                            <li><small>Update all the enrollment records with 'Enrolled' status from <span class="text-success fw-bold">'Enrolled'</span> to <span class="text-success fw-bold">'Completed'</span></small></li>
                                            <li><small>Update all the remaining pending enrollment records to <span class="text-danger fw-bold">'Cancelled'</span></small></li>
                                            <li><small>Clear all the sections' student list and reset the available slot to default</small></li>
                                            <li><small>Set the current active school year to <span class="text-danger fw-bold">Inactive</span> (You need to activate the new school year afterwards on School Year Configuration)</small></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <center>
                                        <div class="row">
                                            <div class="col">
                                                <input type="hidden" value="<?php echo $DataArray['schoolYearID'] ?>" name="syID">
                                                <button class="btn btn-danger w-100" id="page-btn" name="ResetList">End School Year</button>
                                            </div>
                                            <div class="col">
                                                <button type="button" id="page-btn" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#table').DataTable();
    });
</script>

<?php
    require '../shared/footer.php';
?>
