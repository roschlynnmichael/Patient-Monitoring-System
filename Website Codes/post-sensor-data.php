<?php

    $servername="server_ip_here_or_localhost_for_local_mysqldb";
    $dbname="patient_monitoring";
    $username="your_database_username";
    $password="your_database_user_password";

    $patient_id = "";
    $machine_identifier = "";
    $temp = "";
    $hr = "";
    $sys_pressure = "";
    $dias_pressure = "";
    $oxy_lvl = "";
    $room_number = "";
    $bed_number = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $machine_identifier = test_input($_POST["machine_identifier"]);
        $temp = test_input($_POST["temp"]);
        $hr = test_input($_POST["hr"]);
        $sys_pressure = test_input($_POST["sys_pressure"]);
        $dias_pressure = test_input($_POST["dias_pressure"]);
	    $oxy_lvl = test_input($_POST["oxy_lvl"]);
        $room_number = test_input($_POST["room_number"]);
        $bed_number = test_input($_POST["bed_number"]);

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if($conn->connect_error)
        {
            die("Connection Failed: ".$conn->connect_error);
        }
        
        if ($stmt = $conn -> prepare('SELECT patient_id FROM patient_data WHERE machine_identifier = ?'))
        {
            $stmt -> bind_param('s' , $machine_identifier);
            $stmt -> execute();
            $stmt -> bind_result($patient_id);
            $stmt -> fetch();
            $stmt -> close();
        }
        else
        {
            echo "Error: " . $conn->error;
        }

        $sql = "INSERT INTO sensor_data (machine_identifier , patient_id , temp , hr , sys_pressure , dias_pressure , oxy_lvl) VALUES ('$machine_identifier', '$patient_id' , '$temp' , '$hr' , '$sys_pressure' , '$dias_pressure' , '$oxy_lvl')";
        if ($conn->query($sql) == TRUE)
        {
            echo "Recorded Successfully";
        }
        else
        {
            echo "Error: " .$sql. "<br>" .$conn->error;
        }
        
        $sqlinsert1 = "INSERT INTO machine_available (machine_identifier) VALUES ('$machine_identifier')";
        if ($conn->query($sqlinsert1) == TRUE)
        {
            echo "Recorded successfully";
        }
        else
        {
            $sqlupdate1 = "INSERT IGNORE INTO machine_available (machine_identifier) VALUES ('$machine_identifier')";
            if ($conn->query($sqlupdate1) == TRUE)
            {
                echo "Insert Ignored";
            }
            else
            {
                echo "Error: " . $conn->error;
            }
        }

        $sqlinsert2 = "INSERT INTO room_details (machine_identifier , room_number , bed_number) VALUES ('$machine_identifier' , '$room_number' , '$bed_number')";
        if ($conn->query($sqlinsert2) == TRUE)
        {
            echo "Recorded successfully";
        }
        else
        {
            $sqlupdate2 = "INSERT IGNORE INTO room_details (machine_identifier , room_number , bed_number) VALUES ('$machine_identifier' , '$room_number' , '$bed_number')";
            if ($conn->query($sqlupdate2) == TRUE)
            {
                echo "Insert Ignored";
            }
            else
            {
                echo "Error: " . $conn->error;
            }
        }

        $conn->close();
    }
    else
    {
        echo "No data recorded";
    }


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
