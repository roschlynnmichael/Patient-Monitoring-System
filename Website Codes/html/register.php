<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/var/www/html/mailer/src/Exception.php';
require '/var/www/html/mailer/src/PHPMailer.php';
require '/var/www/html/mailer/src/SMTP.php';

$DATABASE_HOST='server_ip_or_localhost';
$DATABASE_USER='username';
$DATABASE_PASS='password';
$DATABASE_NAME='db_name';

$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);

if (mysqli_connect_error())
{
    exit ('Failed to connect to MYSQL: ' . mysqli_connect_error());
}

$selectrole = $_POST['roles'];

if(!isset($selectrole))
{
    exit ('You have not selected a role');
}

if (!isset($_POST['username'] , $_POST['password'] , $_POST['email'] , $_POST['f_name'] , $_POST['l_name'] , $_POST['address'] , $_POST['phone_number']))
{
    exit ('Please complete the form as indicated');
}

if (empty ($_POST['username'] || $_POST['password'] || $_POST['email'] || $_POST['f_name'] || $_POST['l_name'] || $_POST['address'] || $_POST['phone_number']))
{
    exit ('The form is still empty. Please complete it as indicated');
}

if (!filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL))
{
    exit ('Email is invalid');
}

if (strlen($_POST['password']) > 30 || strlen($_POST['password']) < 5)
{
    exit ('Password has to be between 5 and 30 characters long');
}

if (strlen($_POST['username']) > 40 || strlen($_POST['username']) < 5)
{
    exit ('Username has to be between 5 and 40 characters long');
}

if (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/" , $_POST['phone_number']))
{
    exit ('Phone Number not valid');
}

if($selectrole == 'administrator')
{
    if ($stmt = $con -> prepare('SELECT id , password FROM admin_users WHERE username = ?'))
        {
            $stmt -> bind_param('s' , $_POST['username']);
            $stmt -> execute();
            $stmt -> store_result();
            if ($stmt -> num_rows > 0)
            {
                echo 'Username already exists in database. If new user, please select a new username';
            }
            else
            {
                if ($stmt = $con -> prepare('INSERT INTO admin_users (username , f_name , l_name , password , email , address , phone_number , activation_code) VALUES (? , ? , ? , ? , ? , ? , ? , ?)'))
                {
                    $password = password_hash($_POST['password'] , PASSWORD_DEFAULT);
                    $uniqid = uniqid();
                    $stmt -> bind_param('ssssssss' , $_POST['username'] , $_POST['f_name'] , $_POST['l_name'] , $password , $_POST['email'] , $_POST['address'] , $_POST['phone_number'] , $uniqid);
                    $stmt -> execute();
                    emailsend($selectrole , $uniqid);
                    echo 'Your account is now partially signed up. You will be redirected to the admin login page in 5 seconds.';
                    header('Refresh:5; URL=adminlogin.html');
                }
                else
                {
                    echo 'Could not prepare statement';
                }
            }
            $stmt -> close();
        }
    else
    {
        echo 'Server Error. Could not prepare statement';
    }
}

if($selectrole == 'doctor')
{
    if ($stmt = $con -> prepare('SELECT id , password FROM doctor_users WHERE username = ?'))
        {
            $stmt -> bind_param('s' , $_POST['username']);
            $stmt -> execute();
            $stmt -> store_result();
            if ($stmt -> num_rows > 0)
            {
                echo 'Username already exists in database. If new user, please select a new username';
            }
            else
            {
                if ($stmt = $con -> prepare('INSERT INTO doctor_users (username , f_name , l_name , password , email , address , phone_number , activation_code) VALUES (? , ? , ? , ? , ? , ? , ? , ?)'))
                {
                    $password = password_hash($_POST['password'] , PASSWORD_DEFAULT);
                    $uniqid = uniqid();
                    $stmt -> bind_param('ssssssss' , $_POST['username'] , $_POST['f_name'] , $_POST['l_name'] , $password , $_POST['email'] , $_POST['address'] , $_POST['phone_number'] , $uniqid);
                    $stmt -> execute();
                    emailsend($selectrole , $uniqid);
                    echo 'Your account is now partially signed up. You will be redirected to the doctor login page in 5 seconds.';
                    header('Refresh:5; URL=doctorlogin.html');
                }
                else
                {
                    echo 'Could not prepare statement';
                }
            }
            $stmt -> close();
        }
    else
    {
        echo 'Server Error. Could not prepare statement';
    }
}

function emailsend($role , $activatecode)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "email@gmail.com";
    $mail->Password   = "email_password";

    $activate_link = 'http://server_ip_here/patient-monitoring/activate.php?email=' . $_POST['email'] . '&code=' . $activatecode . '&role=' . $role;

    $mail->IsHTML(true);
    $mail->AddAddress( $_POST['email'] , $_POST['username']);
    $mail->SetFrom("sent_from_email", "sent_by_name");
    $mail->Subject = "Activation Required for account: " . $_POST['username'];
    $content = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';

    $mail->MsgHTML($content); 
    if (!$mail -> Send())
    {
        echo "Error while sending mail. Ask admin to enable debug mode";
        var_dump($mail);
    }
    else
    {
        echo "Email Sent Successfully. Please check your email and activate your account!";
    }
}

?>
