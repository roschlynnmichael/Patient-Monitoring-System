<?php

$DATABASE_HOST='localhost';
$DATABASE_USER='admin';
$DATABASE_PASS='dsouza';
$DATABASE_NAME='patient_monitoring';

$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);

if (mysqli_connect_error())
{
    exit ('Failed to connect to MYSQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'] , $_POST['password']))
{
    exit ('Please complete the form as indicated');
}

if (empty ($_POST['username'] || $_POST['password']))
{
    exit ('The form is still empty. Please complete it as indicated');
}

if ($stmt = $con -> prepare('SELECT id , password , activation_code FROM doctor_users WHERE username = ?'))
{
    $stmt -> bind_param ('s' , $_POST['username']);
    $stmt -> execute();
    $stmt -> store_result();
    if ($stmt -> num_rows > 0)
    {
        $stmt -> bind_result ($id , $password , $activationcodes);
        $stmt -> fetch();
        if(password_verify($_POST['password'] , $password))
        {
            if ($activationcodes == 'activated')
            {
                session_start();
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['id'] = $_POST['id'];
                header('Location:doctorhome.php');
            }
            else
            {
                echo 'Account not activated!';
            }
        }
        else
        {
            echo 'Incorrect username or password. Please re-check';
        }
    }
    else
    {
        echo 'Incorrent username or password. Please re-check your details and retry.';
    }

    $stmt -> close();
}

?>