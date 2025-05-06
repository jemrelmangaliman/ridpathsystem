<?php
session_start();

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require '../vendor/autoload.php';

$conn = require '../config/config.php';
    $code = $_POST['code'];
    $email = $_POST['email'];
    $sender = '';
    $subject = '';
    $content = '';

    //Check if the code already exists
    $checkCode = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM registrationcodes WHERE code='$code'"));
    if ($checkCode != 0) {
        $_SESSION['action-error'] = "Registration code already exists. Please generate a new one.";
        header("Location: ../registrar/registration.php");
        exit();
    }

    $Query = "INSERT INTO registrationcodes (code, owneremail, used) VALUES ('$code','$email','No')";
    if (mysqli_query($conn, $Query)) {
            
                $subject = 'Account Registration - Ridpath Academy of Mabuhay Admissions';
                $content = '
                <bold><p>Dear '.$email.',</bold>
                <br>
                Please use the code below to register an account on Ridpath Academy of Mabuhay Enrollment System. Thank you.
                <br><br>


                Registration Code: <bold>'.$code.'</bold><br>
                Registration link: <a href="http://localhost/ridpathsystem/register_form.php">Account Registration Form</a>
                <br><br><br>


                Ridpath Academy of Mabuhay
                ';

            if (SendMailToStudent($sender, $email, $subject, $content)) {
                $_SESSION['action-success'] = "Registration code is now ready for use. An email has been sent to the user.";
                header("Location: ../registrar/registration.php");
                exit();
            }
            else {
                $_SESSION['action-success'] = "Registration code is now ready for use. (Warning: Unable to send email to student. Please send the email manually.)";
                header("Location: ../registrar/registration.php");
                exit();
            }


        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            // header("Location: ../registrar/registration.php");
            // exit();
        }


function SendMailToStudent ($sender, $receipient, $subject, $content) {


    $mail = new PHPMailer(true);

    try{
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       =  'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'loisymiller14@gmail.com';                     //SMTP username
        $mail->Password   = 'uwgt oiga xmjn scpe';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('admissions.ridpathacademy@gmail.com', '(NO REPLY) Admissions - Ridpath Academy of Mabuhay');       //Add a recipient
        $mail->addAddress($receipient);               //Name is optional
    
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
    
        $mail->send();

        return true;
    } catch (Exception $e) {
        return false;
    }
    
}
?>