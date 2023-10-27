<?
include_once ("helpers/connectDb.php");
include_once ("helpers/config.php");
include_once ('mail/mail.php');





if($_SERVER["REQUEST_METHOD"] === "POST"){

    $firstName = trim($_REQUEST['firstName']);
    $lastName = trim($_REQUEST['lastName']);
    $email = trim($_REQUEST['email']);
    $password = password_hash(trim($_REQUEST['password']), PASSWORD_DEFAULT);
    $gender =trim($_REQUEST['gender']);
    $heard_from = '';
    $country = trim($_REQUEST['country']);
    $about = trim($_REQUEST['about']);


    if(isset($_REQUEST['from'])){
        foreach($_REQUEST['from'] as $value){
            $heard_from .= ' '. $value;
        }
    }

    if(isset($_FILES['file'])){
        if($_FILES['file']['error'] == 0){
            $uploadFile = $_FILES['file'];

            $fileName = mysqli_real_escape_string($link,$uploadFile['name']);
            $fileType =  $uploadFile['type'];
            $file = mysqli_real_escape_string($link,file_get_contents($uploadFile['tmp_name']));
            
            $sendToBd = "INSERT INTO tickets (firstName , lastName, email,password, gender,heardFrom , country ,about ,fileName, file_type,file) 
            VALUES ('$firstName','$lastName' , '$email' , '$password', '$gender' , '$heard_from' , '$country' , '$about' , '$fileName' ,'$fileType', '$file')";
            
            if(!mysqli_query($link , $sendToBd)){
                echo "failed to add" . mysqli_error($link);
            }
        }

    } else {
        
    $sendToBd = "INSERT INTO tickets (firstName , lastName, email,password, gender,heardFrom , country ,about ,fileName, file) 
        VALUES ('$firstName','$lastName' , '$email' , '$password', '$gender' , '$heard_from' , '$country' , '$about' , 'no file' , 'no file')";

        if(!mysqli_query($link , $sendToBd)){
            echo "failed to add" . mysqli_error($link);

        }
    }
    sendEmail($admin_email,$firstName,$lastName,$email,$password,$gender,$heard_from,$country,$about);

}

include 'reg.html';