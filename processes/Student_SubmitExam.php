<?php
session_start();
$conn = require '../config/config.php';
    
    $studentID = $_SESSION['user_id'];
    $categoryID = $_POST['categoryID'];
    $answersArray = [];
    $counter = 1;
    $score = 0;
    //get current school year
    $getSchoolYear = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schoolyear WHERE isactive='Yes'"));
    $syID = $getSchoolYear['schoolYearID'];

    //get all the categories' questions
    $getQuestions = mysqli_query($conn, "SELECT * FROM examquestions WHERE examCategoryID = '$categoryID' ORDER BY questionID ASC");
    while($QuestionData = mysqli_fetch_assoc($getQuestions)) {
        $questionID = $QuestionData['questionID'];
        $question = $QuestionData['question'];
        $correctChoiceID = $QuestionData['correctChoiceID'];

        //get the answers
        $answer_choiceID = $_POST['q'.$counter];
        if ($correctChoiceID == $answer_choiceID) {
            //insert exam record (correct)
            $query = "INSERT INTO examrecords
            (studentID, schoolYearID, examCategoryID, questionID, iscorrect)
            VALUES
            ('$studentID','$syID','$categoryID','$questionID',1)";
            mysqli_query($conn,$query);
            $score++;
        }
        else {
            //insert exam record (correct)
            $query = "INSERT INTO examrecords
            (studentID, schoolYearID, examCategoryID, questionID, iscorrect)
            VALUES
            ('$studentID','$syID','$categoryID','$questionID',0)";
            mysqli_query($conn,$query);
        }
        $counter++;
    }

    //insert score record
    mysqli_query($conn, "INSERT INTO examscores (studentID, schoolYearID, examCategoryID, score) VALUES ('$studentID','$syID','$categoryID','$score')");


    $_SESSION['action-success'] = "Congratulations! You have completed the exam.";
    header("Location: ../student/examination_home.php");
    exit();

   

?>