<?php 
$conn = require '../config/config.php';

$ID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM examcategory WHERE examCategoryID = '$ID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$categoryname = $DataArray['categoryname'];
$strandID = $DataArray['strandID'];


$fetchQuery = "SELECT * FROM strands";
$fetchedData = mysqli_query($conn, $fetchQuery);
$strandoption = '';

while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
        if ($DataArray['strandID'] == $strandID) {
            $strandoption .= '<option value="'.$DataArray['strandID'].'" selected>'.$DataArray['strandname'].'</option>';
        }
        else {
            $strandoption .= '<option value="'.$DataArray['strandID'].'">'.$DataArray['strandname'].'</option>';
        }

}


echo '<form action="../processes/Admin_ExamCategory.php" method="POST">
        <div class="row mb-1">
            <div class="col">
                <small>Strand</small>
                <select class="form-select" name="strand" required>
                '.$strandoption.'
                </select>
            </div>
        </div>
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