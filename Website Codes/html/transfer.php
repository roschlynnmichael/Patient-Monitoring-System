<?php

session_start();
if (!isset($_SESSION['loggedin']))
{
    echo 'Please log into your profile before you continue. Redirecting in 5 seconds to login';
    header ('Refresh:5 ; URL=doctorlogin.html');
    exit;
}

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$DATABASE_HOST='server_ip_or_localhost';
$DATABASE_USER='username';
$DATABASE_PASS='password';
$DATABASE_NAME='db_name';

$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);

if (mysqli_connect_error())
{
    exit ('Failed to connect to MYSQL: ' . mysqli_connect_error());
}

$patientid = $_POST['patient_id'];
$machineid = $_POST['machine_id'];

if($stmt = $con -> prepare('SELECT room_number , bed_number FROM room_details WHERE machine_identifier = ?'))
{
    $stmt -> bind_param('s' , $machineid);
    $stmt -> execute();
    $stmt -> bind_result($room , $bed);
    $stmt -> fetch();
    $stmt -> close();
    $stmt -> next_result();
}

if($stmt = $con -> prepare('SELECT machine_identifier FROM patient_data WHERE patient_id = ?'))
{
    $stmt -> bind_param('s' , $patientid);
    $stmt -> execute();
    $stmt -> bind_result($prev_machine_id);
    $stmt -> fetch();
    $stmt -> close();
    $stmt -> next_result();
}

if($stmt = $con -> prepare("UPDATE machine_available SET availability = 'occupied' WHERE machine_identifier = ?"))
{
    $stmt -> bind_param('s' , $machineid);
    $stmt -> execute();
    $stmt -> close();
    $stmt -> next_result();
}

if($stmt = $con -> prepare("UPDATE machine_available SET availability = 'available' WHERE machine_identifier = ?"))
{
    $stmt -> bind_param('s' , $prev_machine_id);
    $stmt -> execute();
    $stmt -> close();
    $stmt -> next_result();
}

if($stmt = $con -> prepare("UPDATE patient_data SET room_no = ? , bed_no = ? , machine_identifier = ? WHERE patient_id = ?"))
{
    $stmt -> bind_param('ssss' , $room , $bed , $machineid , $patientid);
    $stmt -> execute();
    $stmt -> close();
}

echo 'Update Successful';
header ('Refresh:5 ; URL=viewpatients.php');
$con -> close();

?>
