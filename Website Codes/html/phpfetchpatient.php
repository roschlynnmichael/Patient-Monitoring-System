<?php 

$DATABASE_HOST='localhost';
$DATABASE_USER='admin';
$DATABASE_PASS='dsouza';
$DATABASE_NAME='patient_monitoring';

$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);

if(mysqli_connect_error())
{
    exit('Failed to connect to database: '.mysqli_connect_error());
}

$patientid = $_POST['id'];
$patientid = trim($patientid);
$machineid = "";

$stmt = "SELECT * FROM sensor_data WHERE patient_id = '$patientid'";
$result = mysqli_query($con , $stmt);

while ($rows = mysqli_fetch_array($result))
{
    ?>

    <tr>
        <td><?php echo $rows['machine_identifier'];?></td>
        <td><?php echo $rows['temp'];?></td>
        <td><?php echo $rows['hr'];?></td>
        <td><?php echo $rows['sys_pressure'];?></td>
        <td><?php echo $rows['dias_pressure'];?></td>
        <td><?php echo $rows['oxy_lvl'];?></td>
        <td><?php echo $rows['date_time'];?></td>
    </tr>

    <?php
}

?>