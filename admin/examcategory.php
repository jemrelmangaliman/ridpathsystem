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
                    <h6 class="m-0 font-weight-bold text-success">Exam Category</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row" id="page-btn-container">
                        <div class="col-4">
                            <button class="btn btn-success" id="page-btn" data-bs-toggle="modal" data-bs-target="#modal-Add"><i class="bi bi-plus-lg"></i> Add New Category</button>
                        </div>
                    </div>

                    <div class="container">
                        <div class="table-responsive mt-4">
                            <table class="table table-hover table-bordered table-sm w-100" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" id="th"><small>ID</small></th>
                                        <th scope="col" class="text-center" id="th"><small>Strand</small></th>
                                        <th scope="col" class="text-center" id="th"><small>Category Name</small></th>
                                        <th scope="col" class="text-senter" id="th"><small>Actions</small></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $fetchQuery = "SELECT * FROM examcategory ec LEFT JOIN strands st ON ec.strandID = st.strandID";
                                    $fetchedData = mysqli_query($conn, $fetchQuery);

                                    while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
                                        $ID = $DataArray['examCategoryID'];
                                        $categoryname = $DataArray['categoryname'];
                                        $strandname = $DataArray['strandname'];
                                    ?>
                                        <tr>
                                            <td class="text-center" id="td"><?php echo $ID; ?></td>
                                            <td class="text-center" id="td"><?php echo $strandname; ?></td>
                                            <td class="text-center" id="td"><?php echo $categoryname; ?></td>

                                            <td class="text-center" id="td">
                                                <button class="btn btn-success border-0" title="Edit" id="table-button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-Edit"
                                                    data-bs-syID="<?php echo $ID; ?>">
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
                    <h5>Edit Exam Category Information</h5>
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
                    <h5><b>Exam Category Information</b></h5>
                    <div class="container mb-2">
                        <form action="../processes/Admin_ExamCategory.php" method="POST">
                            <div class="row mb-1">
                                <div class="col">
                                    <small>Strand</small>
                                    <select class="form-select" name="strand" required>
                                    <?php
                                        $fetchQuery = "SELECT * FROM strands";
                                        $fetchedData = mysqli_query($conn, $fetchQuery);

                                        while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
                                        
                                                echo '<option value="'.$DataArray['strandID'].'">'.$DataArray['strandname'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <small>Category Name</small>
                                    <input type="text" class="form-control" name="categoryname" required>
                                </div>
                            </div>
                           
                            <div class="row mt-3">
                                <center>
                                    <div class="row">
                                        <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                                        <button class="btn btn-success" id="page-btn" name="AddExamCategory" style="width:50%;">Submit</button>
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
    exampleModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var syID = button.getAttribute('data-bs-syID');

        //ajax call 
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var editcontainer = exampleModal.querySelector('#edit-container');
                editcontainer.innerHTML = this.responseText;
            } else {
                console.log(this.status);
            }
        };
        ajax.open("GET", "../ajax/Admin_viewExamCategory.php?ID=" + syID, true);
        ajax.send();
    });
</script>

<?php
require '../shared/footer.php';
?>