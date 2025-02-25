<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submitContact']))
{
// copying the name attribute value and note the id
$fullname= $_POST['full_name'];
$email= $_POST['email'];
$subject= $_POST['Subject'];
$message= $_POST['Message'];


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;
                                       //Enable SMTP authentication
    $mail->Username   = 'patkenmtuku@gmail.com';                     //SMTP username
    $mail->Password   = 'nzvsfuxivcxycesx';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_SMTPS 465 Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('patkenmtuku@gmail.com', 'CODER MUTUKU');
    $mail->addAddress('info@kwlaw.co.ke', 'Karanja Wanjiru Advocates');     //Add a recipient

   

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New enquiry- Coder mutuku';
    $mail->Body    = '<h3> Hello there you have a new inquiry </h3>
    <h4>Fullname: '.$fullname.'</h4>
    <h4>Email:'.$email.' </h4>
    <h4>Subject: '.$subject.'</h4>
    <h4>Message: '.$message.'</h4>
    ';

    if($mail->send())
    {
        $_SESSION['status'] = "Thank you contact us- Team Westvolt";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);

    }
    else{
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);

    }
 

    
    // echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
else
{
    header('Location: index.html');
    exit(0);
}
?>