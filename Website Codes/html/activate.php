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

$role = $_GET['role'];

if ($role == 'administrator')
{
    if (isset($_GET['email'] , $_GET['code']))
    {
        if($stmt = $con -> prepare('SELECT * FROM admin_users WHERE email = ? AND activation_code = ?'))
        {
            $stmt -> bind_param('ss' , $_GET['email'] , $_GET['code']);
            $stmt -> execute();
            $stmt -> store_result();
            if ($stmt -> num_rows > 0)
            {
                if ($stmt = $con -> prepare('UPDATE admin_users SET activation_code = ? WHERE email = ? AND activation_code = ?'))
                {
                    $newcode = "activated";
                    $stmt -> bind_param('sss' , $newcode , $_GET['email'] , $_GET['code']);
                    $stmt -> execute();
                    echo 'Your account is now activate. Please proceed to login. Auto proceed in 5 seconds';
                    header('Refresh:5; URL=adminlogin.html');
                }
                else
                {
                    echo 'This account is already activated';
                }
            }
        }
    }
}

if ($role == 'doctor')
{
    if (isset($_GET['email'] , $_GET['code']))
    {
        if($stmt = $con -> prepare('SELECT * FROM doctor_users WHERE email = ? AND activation_code = ?'))
        {
            $stmt -> bind_param('ss' , $_GET['email'] , $_GET['code']);
            $stmt -> execute();
            $stmt -> store_result();
            if ($stmt -> num_rows > 0)
            {
                if ($stmt = $con -> prepare('UPDATE doctor_users SET activation_code = ? WHERE email = ? AND activation_code = ?'))
                {
                    $newcode = "activated";
                    $stmt -> bind_param('sss' , $newcode , $_GET['email'] , $_GET['code']);
                    $stmt -> execute();
                    echo 'Your account is now activate. Please proceed to login. Auto proceed in 5 seconds';
                    header('Refresh:5; URL=doctorlogin.html');
                }
                else
                {
                    echo 'This account is already activated';
                }
            }
        }
    }
}

?>