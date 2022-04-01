<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
    echo 'Please Log in before you can use this service. You will be redirected to admin login in 5 seconds';
    header('Refresh:5 ; URL=adminlogin.html');
}

$DATABASE_HOST='localhost';
$DATABASE_USER='admin';
$DATABASE_PASS='dsouza';
$DATABASE_NAME='patient_monitoring';

$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);

if(mysqli_connect_error())
{
    exit('Failed to connect to database: '.mysqli_connect_error());
}

if (!empty($_POST['email']))
{
    if (!filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL))
    {
        exit ('Email is invalid');
    }
    if ($stmt = $con -> prepare('UPDATE doctor_users SET email = ? WHERE username = ?'))
    {
        $stmt -> bind_param('ss' , $_POST['email'] , $_SESSION['username']);
        $stmt -> execute();
        echo 'Email updated successfully. Re-directing to profile page once again in 5 seconds';
        header('Refresh:5 ; URL=doctorprofile.php');
    }
}

if (!empty($_POST['phone_number']))
{
    if (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/" , $_POST['phone_number']))
    {
        exit ('Phone Number not valid');
    }
    if ($stmt = $con -> prepare('UPDATE doctor_users SET phone_number = ? WHERE username = ?'))
    {
        $stmt -> bind_param('ss' , $_POST['phone_number'] , $_SESSION['username']);
        $stmt -> execute();
        echo 'Phone Number updated successfully. Re-directing to profile page once again in 5 seconds';
        header('Refresh:5 ; URL=doctorprofile.php');
    }
}

if (!empty($_POST['address']))
{
    if ($stmt = $con -> prepare('UPDATE doctor_users SET address = ? WHERE username = ?'))
    {
        $stmt -> bind_param('ss' , $_POST['address'] , $_SESSION['username']);
        $stmt -> execute();
        echo 'Address updated successfully. Re-directing to profile page once again in 5 seconds';
        header('Refresh:5 ; URL=doctorprofile.php');
    }
}

if (!empty($_POST['password']))
{
    if (strlen($_POST['password']) > 30 || strlen($_POST['password']) < 5)
    {
        exit ('Password has to be between 5 and 30 characters long');
    }
    if ($stmt = $con -> prepare('UPDATE doctor_users SET password = ? WHERE username = ?'))
    {
        $password = password_hash($_POST['password'] , PASSWORD_DEFAULT);
        $stmt -> bind_param('ss' , $password , $_SESSION['username']);
        $stmt -> execute();
        echo 'Password updated successfully. Re-directing to profile page once again in 5 seconds';
        header('Refresh:5 ; URL=doctorprofile.php');
    }
}

$stmt -> close();

?>
