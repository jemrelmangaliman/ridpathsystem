<?php 
$conn = require '../config/config.php';

$ID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM examquestions WHERE questionID = '$ID'");
$DataArray = mysqli_fetch_assoc($fetchData);
$examCategoryID = $DataArray['examCategoryID'];
$question = $DataArray['question'];
$correctChoiceID = $DataArray['correctChoiceID'];


$fetchCategoryQuery = "SELECT * FROM examcategory";
$fetchedCategoryData = mysqli_query($conn, $fetchCategoryQuery);
$categoryoptions = '';

while ($CategoryDataArray = mysqli_fetch_assoc($fetchedCategoryData)) {
    $categoryID = $CategoryDataArray['examCategoryID'];

    if ($categoryID = $examCategoryID) {
       $categoryoptions .= '<option value="'.$CategoryDataArray['examCategoryID'].'">'.$CategoryDataArray['categoryname'].'</option>';
    }
    else {
        $categoryoptions .= '<option value="'.$CategoryDataArray['examCategoryID'].'">'.$CategoryDataArray['categoryname'].'</option>';
    }
}

//get exam choices
$fetchChoicesQuery = "SELECT * FROM examchoices WHERE questionID = '$ID'";
$fetchedChoicesData = mysqli_query($conn, $fetchChoicesQuery);
$choices = '';

$counter = 1;
while ($ChoiceData = mysqli_fetch_assoc($fetchedChoicesData)) {
    $choiceID = $ChoiceData['choiceID'];
    $choicedescription = $ChoiceData['choicedescription'];
    $iscorrect = $ChoiceData['iscorrect'];
    
    if ($iscorrect) {
        $choices .= 
        '
        <div class="row mb-1">
            <div class="col-8">
            <input type="hidden" class="form-control" name="choiceid'.$counter.'" value="'.$choiceID.'" required>
                <input type="text" class="form-control" name="answer'.$counter.'" value="'.$choicedescription.'" required>
            </div>
            <div class="col-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="iscorrect" value="answer'.$counter.'" required checked>
                    <label class="form-check-label">
                        Correct Answer
                    </label>
                </div>
            </div>
        </div>
        
        ';
    }
    else {
        $choices .= 
        '
        <div class="row mb-1">
            <div class="col-8">
                <input type="hidden" class="form-control" name="choiceid'.$counter.'" value="'.$choiceID.'" required>
                <input type="text" class="form-control" name="answer'.$counter.'" value="'.$choicedescription.'" required>
            </div>
            <div class="col-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="iscorrect" value="answer'.$counter.'" required>
                    <label class="form-check-label">
                        Correct Answer
                    </label>
                </div>
            </div>
        </div>
        
        ';
    }
    $counter++;
}

echo '<form action="../processes/Admin_ExamQuestions.php" method="POST">
                            <div class="row mb-1">
                                <div class="col">
                                    <small>Category</small>
                                    <select class="form-select" name="category" required>
                                    '.$categoryoptions.'
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <small>Question</small>
                                    <input type="text" class="form-control" name="question" value="'.$question.'" required>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col">
                                    <small>Answers</small>
                                    '.$choices.'
                                </div>
                            </div>
                           
                            <div class="row mt-3">
                                <center>
                                    <div class="row">
                                        <input type="hidden" name="ID" value="'.$ID.'">
                                        <button type="button" id="page-btn" class="btn btn-danger" data-bs-dismiss="modal" style="width:50%;">Close</button>
                                        <button class="btn btn-success" id="page-btn" name="EditExamQuestion" style="width:50%;">Submit</button>
                                    </div>
                                </center>
                            </div>
                        </form>';
?>