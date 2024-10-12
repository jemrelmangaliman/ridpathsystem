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
                                    <h6 class="m-0 font-weight-bold text-primary">Student List Configuration</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                    <div class="container">
                                            <div class="container-fluid" id="ViewStudentContainer">

                                            </div>
                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover table-bordered table-sm w-100" id="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center" id="th"><small>Section ID</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Section</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Default Slots</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Available Slots</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Is Active</small></th>
                                                        <th scope="col" class="text-center" id="th"><small>Actions</small></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $fetchQuery = "SELECT * FROM sections ss
                                                    LEFT JOIN strands st ON ss.strandID = st.strandID";
                                                    $fetchedData = mysqli_query($conn, $fetchQuery);

                                                    while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
                                                        $ID = $DataArray['sectionID'];
                                                        $SectionName = $DataArray['sectionname'];
                                                        $abbreviation = $DataArray['abbreviation'];
                                                        $gradelevel = $DataArray['gradelevel'];
                                                        $status = $DataArray['isactive'];
                                                        $defaultslots = $DataArray['defaultslots'];
                                                        $availableslots = $DataArray['currentavailableslot'];

                                                    ?>
                                                        <tr>
                                                            <td class="text-center" id="td"><?php echo $ID; ?></td>
                                                            <td class="text-center" id="td"><?php echo $abbreviation." ".$gradelevel."-".$SectionName; ?></td>
                                                            <td class="text-center" id="td"><?php echo $defaultslots; ?></td>
                                                            <td class="text-center" id="td"><?php echo $availableslots; ?></td>
                                                            <td class="text-center" id="td"><?php echo $status; ?></td>
                                                            <td class="text-center" id="td">
                                                                <button class="btn btn-success border-0" title="View List" id="table-button"
                                                                    data-bs-SectionID="<?php echo $ID; ?>"
                                                                    onclick="AddStudentToSection(this)">
                                                                    <i class="bi bi-eye-fill" id="table-btn-icon"></i> <span id="tablebutton-text"></span>
                                                                </button>
                                                                <button class="btn btn-danger border-0" title="Reset Student List" id="table-button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-Delete"
                                                                        data-bs-SectionID="<?php echo $ID;?>"
                                                                        >
                                                                        <i class="bi bi-arrow-clockwise" id="table-btn-icon"></i> <span id="tablebutton-text"></span>
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
                                    <div class="modal fade" id="modal-Delete" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body p-4" style="font-family: Arial;">
                                                            <div class="container mb-2" id="view-container">
                                                                <form action="../processes/resetStudentList.php" method="POST">
                                                                    <h5><b>Reset Student List</b></h5>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <input type="hidden" name="section" id="section">
                                                                            <p>This will clear all the students from the list. Are you sure you want to reset the student list? </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <center>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <button class="btn btn-danger w-100" id="page-btn" name="ResetList">Reset List</button>
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

    var deleteModal = document.getElementById('modal-Delete')
    deleteModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var sectionID = button.getAttribute('data-bs-SectionID');   
        
        deleteModal.querySelector('#section').value = sectionID;
    });
</script>

<?php
    require '../shared/footer.php';
?>
