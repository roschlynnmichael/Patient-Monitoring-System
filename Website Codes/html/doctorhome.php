<?php

session_start();

if(!isset($_SESSION['loggedin']))
{
    echo 'Please log in. You are being redirected to doctor login in 5 seconds';
    header ('Refresh:5 ; URL=doctorlogin.html');
    exit;
}

$DATABASE_HOST='server_ip_or_localhost';
$DATABASE_USER='username';
$DATABASE_PASS='password';
$DATABASE_NAME='db_name';

$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);

if(mysqli_connect_error())
{
    exit('Failed to connect to database: '.mysqli_connect_error());
}

$stmt1 = "SELECT * FROM machine_available";
if($result1 = mysqli_query($con , $stmt1))
{
    $rowcount1 = mysqli_num_rows($result1);
}

$stmt2 = "SELECT * FROM machine_available WHERE availability = 'available'";
if($result2 = mysqli_query($con , $stmt2))
{
    $rowcount2 = mysqli_num_rows($result2);
}

$stmt3 = "SELECT * FROM patient_data";
if($result3 = mysqli_query($con , $stmt3))
{
    $rowcount3 = mysqli_num_rows($result3);
}

$con -> close();

?>

<!DOCTYPE HTML>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/7ef9230af3.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <title>Doctor's Portal</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-auto bg-light sticky-top">
                    <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
                        <a href="/" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                            <i class="bi bi-bandaid fs-3"></i>
                        </a>
                        <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                            <li class="nav-item">
                                <a href="doctorhome.php" class="nav-link py-3 px-2 active" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                                <i class="bi-house fs-3"></i>
                                </a>
                            </li>
                            <li>
                                <a href="generatepdf.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Generate PDF">
                                    <i class="bi bi-bar-chart-line fs-3"></i>
                                </a>
                            </li>
                            <li>
                                <a href="viewreports.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="View Reports">
                                    <i class="bi bi-book-half fs-3"></i>
                                </a>
                            </li>
                            <li>
                                <a href="manage.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Add Patients">
                                    <i class="bi-people fs-3"></i>
                                </a>
                            </li>
                            <li>
                                <a href="viewpatients.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="View Patients">
                                    <i class="bi bi-table fs-3"></i>
                                </a>
                            </li>
                            <li>
                                <a href="viewstaff.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-orifinal-title="View Staff">
                                    <i class="bi bi-incognito fs-3"></i>
                                </a>
                            </li>
                            <li>
                                <a href="prescribe.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-orifinal-title="Prescribe Medications">
                                    <i class="bi bi-journal-medical fs-3"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-check fs-3"></i>
                            </a>
                            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                                <li><a class="dropdown-item" href="doctorpasswordupdate.php">Update Details</a></li>
                                <li><a class="dropdown-item" href="doctorprofile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="logout_doctor.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm p-3 min-vh-100">
                    <h3 class="mb-2">Welcome <?php echo $_SESSION['username']?>! </h3>
                    </br>
                    <div class="row">
                        <div class="row d-flex justify-content-center align-items-center w-100 h-100">
                            <div class="col-md-12 col-xl-4">
                                <div class="shadow card" style="border-radius:15px">
                                    <div class="card-body text-center">
                                        <div class="mt-3 mb-4">
                                            <img src="machine.svg" class="square img-fluid" style="width:45px;"></img>
                                        </div>
                                        <h5 class="mb-2">Total Machines Registered</h5>
                                        <h6 class="mb-2"><?php echo $rowcount1;?></h6>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-4">
                                <div class="shadow card" style="border-radius:15px">
                                    <div class="card-body text-center">
                                        <div class="mt-3 mb-4">
                                            <img src="availablemachine.svg" class="square img-fluid" style="width:45px;"></img>
                                        </div>
                                        <h5 class="mb-2">Total Machines Available</h5>
                                        <h6 class="mb-2"><?php echo $rowcount2;?></h6>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-4">
                                <div class="shadow card" style="border-radius:15px">
                                    <div class="card-body text-center">
                                        <div class="mt-3 mb-4">
                                            <img src="patient.svg" class="square img-fluid" style="width:45px;"></img>
                                        </div>
                                        <h5 class="mb-2">No. of Patients Registered</h5>
                                        <h6 class="mb-2"><?php echo $rowcount3;?></h6>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
