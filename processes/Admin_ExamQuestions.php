<?php
session_start();
$conn = require '../config/config.php';

if (isset($_POST['AddExamQuestion'])) {
    $question = $_POST['question'];
    $categoryID = $_POST['category'];
    $correctanswer = 0;

    for ($counter = 1; $counter <= 4; $counter++) {
        if($_POST['iscorrect'] == 'answer'.$counter) {
            $correctanswer = $counter;
            break;
        }
    }

    //insert the question
    $Query = "INSERT INTO examquestions (examCategoryID, question) VALUES ('$categoryID','$question')";
    mysqli_query($conn, $Query);


    //get question ID
    $QuestionData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM examquestions ORDER BY questionID DESC LIMIT 1"));
    $questionID = $QuestionData['questionID'];

    //insert the choices
    for ($counter = 1; $counter <= 4; $counter++) {
        $answer = $_POST['answer'.$counter];

        if ($counter == $correctanswer) {
            mysqli_query($conn, "INSERT INTO examchoices (questionID, choicedescription, iscorrect) VALUES ('$questionID','$answer',1)");

            //get choice ID
            $AnswerData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM examchoices WHERE questionID = '$questionID' AND iscorrect = 1"));
            $choiceID = $AnswerData['choiceID'];

            //update question data
            mysqli_query($conn, "UPDATE examquestions SET correctChoiceID = '$choiceID' WHERE questionID = '$questionID'");
        }
        else {
            mysqli_query($conn, "INSERT INTO examchoices (questionID, choicedescription, iscorrect) VALUES ('$questionID','$answer',0)");
        }
    }

    $_SESSION['action-success'] = "Exam question added.";
    header("Location: ../admin/examquestions.php");
    exit();
}
if (isset($_POST['EditExamQuestion'])) {
    $question = $_POST['question'];
    $categoryID = $_POST['category'];
    $correctanswer = 0;
    $questionID = $_POST['questionID'];

    for ($counter = 1; $counter <= 4; $counter++) {
        if($_POST['iscorrect'] == 'answer'.$counter) {
            $correctanswer = $counter;
            break;
        }
    }
    
    //get the question choices
    $ChoicesQuery = mysqli_query($conn, "SELECT * FROM examchoices WHERE questionID = '$questionID' ORDER BY choiceID ASC");

    //update the choices
    $counter = 1;
    while ($ChoiceData = mysqli_fetch_assoc($ChoicesQuery)) {
        $answer = $_POST['answer'.$counter];
        $choiceID = $ChoiceData['choiceID'];

        if ($counter == $correctanswer) {
            //update choice data
            mysqli_query($conn, "UPDATE examchoices SET iscorrect = 1, choicedescription = '$answer' WHERE choiceID = '$choiceID'");

            //update question data
            mysqli_query($conn, "UPDATE examquestions SET correctChoiceID = '$choiceID' WHERE questionID = '$questionID'");
        }
        else {
            mysqli_query($conn, "UPDATE examchoices SET iscorrect = 0, choicedescription = '$answer' WHERE choiceID = '$choiceID'");
        }
    }

    $_SESSION['action-success'] = "Exam question updated.";
    header("Location: ../admin/examquestions.php");
    exit();
}
   

?>