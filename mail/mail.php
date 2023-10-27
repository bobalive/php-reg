<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

function sendEmail($admin_email, $firstName,$lastName,$email, $password,$gender,$heard_from,$country,$about){
    $mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = FALSE;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = "boburdjalalov06@gmail.com";                     //SMTP username
    $mail->Password   = 'xulp mxgd zsqe fatm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('boburdjalalov06@gmail.com', 'site');
    $mail->addAddress("$admin_email", 'Admin');     //Add a recipient



    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = " <table >
    <thead >
      <thead>
        <tr>
          <th >#</th>
          <th>first_name</th>
          <th>last_name</th>
          <th>email</th>
          <th>password</th>
          <th>gender</th>
          <th>heard from</th>
          <th>country</th>
          <th>about</th>
          <th>fileName</th>
          <th> file</th>
  
  
          
        </tr>
      </thead>
    </thead>
    <tbody>
      <tr>
        <th>1</th>
        <td>$firstName</td>
        <td>$lastName</td>
        <td>$email </td>
        <td>(secret)</td>
        <td>$gender</td>
        <td>$heard_from</td>
        <td>$country</td>
        <td>$about</td>
      </tr>
      <?php endforeach;?>
      <?php endif;?>
    </tbody>
  </table>";
    $mail->AltBody = "firstName: $firstName, lastName: $lastName , \n
     email: $email, password:$password , 
     gender: secret,   heard_from : $heard_from ,
     country: $country, about: $about
     ";

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}