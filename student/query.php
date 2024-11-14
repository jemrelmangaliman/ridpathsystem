<?php
session_start();
$conn = require '../config/config.php';


$questionArray = 
[
    "Solve for xxx: 5x−3=2x+95x - 3 = 2x + 95x−3=2x+9",
    "Simplify: (3x2y)(4xy2)(3x^2y)(4xy^2)(3x2y)(4xy2)",
    "If f(x)=2x+3f(x) = 2x + 3f(x)=2x+3, find f(5)f(5)f(5):",
    "Solve for xxx: x2−5x+6=0x^2 - 5x + 6 = 0x2−5x+6=0",
    "The sum of the roots of the equation x2+3x−4=0x^2 + 3x - 4 = 0x2+3x−4=0 is:",
    "If f(x)=x2f(x) = x^2f(x)=x2, the derivative f′(x)f'(x)f′(x) is:",
    "The integral of 3x23x^23x2 with respect to xxx is:",
    "If y=x3+2xy = x^3 + 2xy=x3+2x, find dy/dxdy/dxdy/dx:",
    "The area under y=4xy = 4xy=4x from x=0x = 0x=0 to x=2x = 2x=2 is:",
    "Find the slope of the tangent line to y=x2−3x+2y = x^2 - 3x + 2y=x2−3x+2 at x=1x = 1x=1:",
    "If a die is rolled, what is the probability of getting a 5?",
    "If 60% of students passed a test, what is the probability that a randomly selected student did not
pass?",
    "What is the mean of the data set 2,5,7,10,122, 5, 7, 10, 122,5,7,10,12?",
    "A card is drawn from a deck of 52 cards. The probability of drawing a spade is:",
    "The median of the data set 4,6,8,10,124, 6, 8, 10, 124,6,8,10,12 is:"
];

foreach ($questionArray as $question) {
    $cleanstring = mysqli_real_escape_string($conn, $question);
    mysqli_query($conn, "INSERT INTO examquestions (examCategoryID, question) VALUES (1,'$cleanstring')");
}

?>