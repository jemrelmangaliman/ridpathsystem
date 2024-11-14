<?php 
$conn = require '../config/config.php';

$ID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM examcategory WHERE examCategoryID = '$ID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$categoryname = $DataArray['categoryname'];



echo '<form action="../processes/Admin_ExamCategory.php" method="POST">
        <div class="row mb-1">
            <div class="col">
                <small>Category Name</small>
                <input type="text" class="form-control" name="categoryname" value="'.$categoryname.'" required>
            </div>
        </div>
        
        <div class="row mt-3">
            <center>
                <div class="row">
                    <input type="hidden" name="ID" value="'.$ID.'">
                    <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                    <button class="btn btn-success" id="page-btn" name="EditExamCategory" style="width:50%;">Submit</button>
                </div>
            </center>
        </div>
    </form>';
?>