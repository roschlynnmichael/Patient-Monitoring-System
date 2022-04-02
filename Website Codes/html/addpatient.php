<?php

session_start();
if (!isset($_SESSION['loggedin']))
{
    echo 'Please log into your profile before you continue. Redirecting in 5 seconds to login';
    header ('Refresh:5 ; URL=doctorlogin.html');
    exit;
}

$patient_id = $_SESSION['generate_id'];
$machineid = $_POST['machine_available'];

$DATABASE_HOST = 'server_ip_or_localhost';
$DATABASE_USER = 'username';
$DATABASE_PASS = 'password';
$DATABASE_NAME = 'db_name';

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);

if (mysqli_connect_error())
{
    exit ('Failed to connect to MYSQL: ' . mysqli_connect_error());
}

$rnumber = "";
$bnumber = "";

if ($stmt = $con -> prepare('SELECT patient_id , full_name FROM patient_data WHERE patient_id = ?'))
{
    $stmt -> bind_param('s' , $patient_id);
    $stmt -> execute();
    $stmt -> store_result();
    if ($stmt -> num_rows > 0)
    {
        echo 'Patient already exists in database';
        mysqli_free_result($stmt);
    }
    else
    {
        if ($stmt = $con -> prepare ('SELECT room_number , bed_number FROM room_details WHERE machine_identifier = ?'))
        {
            $stmt -> bind_param('s' , $machineid);
            $stmt -> execute();
            $stmt -> bind_result($rnumber , $bnumber);
            $stmt -> fetch();
            $stmt -> close();
            $stmt -> next_result();
        }
        else
        {
            echo "SQL Error" . $stmt->error();
        }
        if ($stmt = $con -> prepare ('INSERT INTO patient_data (patient_id , full_name , address , phone_number , room_no , bed_no , dr_incharge , machine_identifier , admitted_for , added_by) VALUES (? , ? , ? , ? , ? , ? , ? , ? , ? , ?)'))
        {
            $stmt -> bind_param('ssssssssss' , $patient_id , $_POST['full_name'] , $_POST['address'] , $_POST['phone_number'] , $rnumber , $bnumber , $_POST['dr_incharge'] , $machineid , $_POST['admitted_for'] , $_SESSION['username']);
            $stmt -> execute();
            $stmt -> close();
            $stmt -> next_result();
        }
        else
        {
            echo "SQL Error" . $stmt->error();
        }
        if ($stmt = $con -> prepare ("UPDATE machine_available SET availability = 'occupied' WHERE machine_identifier = ?"))
        {
            $stmt -> bind_param('s' , $machineid);
            $stmt -> execute();
            $stmt -> close();
            $stmt -> next_result();
        }
        else
        {
            echo "SQL Error" . $stmt -> error();
        }
    }
    $con -> close();
    echo 'Redirecting to add patients in 5 seconds';
    header ('Refresh:5 ; URL=viewpatients.php');
}

?>
