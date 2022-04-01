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

$stmt = "SELECT * FROM prescriptions WHERE patient_id = '$patientid'";
$result = mysqli_query($con , $stmt);
$con -> close();

while ($rows = mysqli_fetch_array($result))
{
    ?>

    <tr>
        <td><?php echo $rows['prs_id'];?></td>
        <td><?php echo $rows['given_by'];?></td>
        <td><?php echo $rows['details'];?></td>
        <td><?php echo $rows['timestamp'];?></td>
    </tr>

    <?php
}

?>