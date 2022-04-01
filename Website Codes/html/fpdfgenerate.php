<?php

include '/var/www/html/TCPDF/tcpdf.php';

session_start();
if(!isset($_SESSION['loggedin']))
{
    echo 'Please Log in before you can use this service. You will be redirected to doctor login in 5 seconds';
    header('Refresh:5 ; URL=doctorlogin.html');
}

$patientid = $_POST['patient_id'];
$DATABASE_HOST='localhost';
$DATABASE_USER='admin';
$DATABASE_PASS='dsouza';
$DATABASE_NAME='patient_monitoring';

$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);

if (mysqli_connect_error())
{
    exit ('Failed to connect to MYSQL: ' . mysqli_connect_error());
}

if ($stmt = $con -> prepare('SELECT full_name , dr_incharge , room_no , bed_no FROM patient_data WHERE patient_id = ?'))
{
    $stmt -> bind_param('s' , $patientid);
    $stmt -> execute();
    $stmt -> bind_result($full_name , $dr , $rno , $bno);
    $stmt -> fetch();
    $stmt -> close();
    $stmt -> next_result();
}

$sql = "SELECT machine_identifier , temp , hr , sys_pressure , dias_pressure , oxy_lvl , date_time FROM sensor_data WHERE patient_id = '$patientid'";
$result1 = mysqli_query($con , $sql);

$sqlget = "SELECT prs_id , given_by , details , timestamp FROM prescriptions WHERE patient_id = '$patientid'";
$result2 = mysqli_query($con , $sqlget);

$con -> close();

$pdf = new TCPDF('P','mm','A4');
$pdf->SetAutoPageBreak(true, 0);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();
$pdf->SetFont('Helvetica','B',15);
$pdf->Cell(190,10,"Hospital of Bombay",0,1,'C');

$pdf->SetFont('Helvetica','',12);
$pdf->Cell(190,5,"Patient Monitoring Sheet",0,1,'C');

$pdf->SetFont('Helvetica','',10);
$pdf->Cell(30,5,"Patient ID: ",0);
$pdf->Cell(160,5,$patientid,0);
$pdf->Ln();
$pdf->Cell(30,5,"Patient Name",0);
$pdf->Cell(160,5,$full_name,0);
$pdf->Ln();
$pdf->Cell(30,5,"Doctor Incharge: ",0);
$pdf->Cell(160,5,$dr,0);
$pdf->Ln();
$pdf->Cell(30,5,"Room and Bed No: ",0);
$pdf->Cell(160,5," " . $rno . " " .$bno,0);
$pdf->Ln();
$pdf->Ln(2);

$html1 = "
	<table>
		<tr>
			<th>Machine ID</th>
			<th>Temp</th>
			<th>Pulse</th>
			<th>Systolic Prs</th>
			<th>Dias Prs</th>
            <th>Oxy Level</th>
            <th>Timestamp</th>
		</tr>
		";

while ($rows = mysqli_fetch_array($result1)){	
	$html1 .= "
			<tr>
				<td>". $rows['machine_identifier'] ."</td>
				<td>". $rows['temp'] ."</td>
				<td>". $rows['hr'] ."</td>
				<td>". $rows['sys_pressure'] ."</td>
				<td>". $rows['dias_pressure'] ."</td>
				<td>". $rows['oxy_lvl'] ."</td>
                <td>". $rows['date_time'] ."</td>
			</tr>
			";
}		

$html1 .= "
	</table>
	<style>
	table {
		border-collapse:collapse;
	}
	th,td {
		border:1px solid #888;
	}
	table tr th {
		background-color:#888;
		color:#fff;
		font-weight:bold;
	}
	</style>
";

$pdf->WriteHTMLCell(192,0,9,'',$html1,0);
$pdf->AddPage();
$pdf->Cell(30,5,"Details of Medications Given",0);
$pdf->Ln();
$pdf->Ln(2);

$html2 = "
	<table>
		<tr>
			<th>Prescription ID</th>
			<th>Given by Doctor</th>
			<th>Medications Prescribed</th>
			<th>Given at this time</th>
		</tr>
		";

while ($rows = mysqli_fetch_array($result2)){	
	$html2 .= "
			<tr>
				<td>". $rows['prs_id'] ."</td>
				<td>". $rows['given_by'] ."</td>
				<td>". $rows['details'] ."</td>
				<td>". $rows['timestamp'] ."</td>
			</tr>
			";
}		

$html2 .= "
	</table>
	<style>
	table {
		border-collapse:collapse;
	}
	th,td {
		border:1px solid #888;
	}
	table tr th {
		background-color:#888;
		color:#fff;
		font-weight:bold;
	}
	</style>
";	

$pdf->WriteHTMLCell(192,0,9,'',$html2,0);
$pdf->Output();
?>