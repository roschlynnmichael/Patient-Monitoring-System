<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
    echo 'Please log in. You are being redirected to doctor login in 5 seconds';
    header ('Refresh:5 ; URL=doctorlogin.html');
    exit;
}

$DATABASE_HOST='localhost';
$DATABASE_USER='admin';
$DATABASE_PASS='dsouza';
$DATABASE_NAME='patient_monitoring';
                            
$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);
                            
if (mysqli_connect_error())
{
    exit ('Failed to connect to MYSQL: ' . mysqli_connect_error());
}

if ($stmt = $con -> prepare('INSERT INTO prescriptions (patient_id , prs_id , given_by , details) VALUES (? , ? , ? , ?)'))
{
    $stmt -> bind_param('ssss' , $_POST['patientid'] , $_SESSION['pres_id'] , $_POST['doctor'] , $_POST['details']);
    $stmt -> execute();
}

$con -> close();
echo 'Updated Prescriptions';
header('Refresh:2 ; URL=prescribe.php');

?>