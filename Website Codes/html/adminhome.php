<?php

session_start();

if(!isset($_SESSION['loggedin']))
{
    echo 'You have not logged in. You will be redirected to the administrator login page in 5 seconds';
    header('Refresh:5; URL=adminlogin.html');
    exit;
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

$stmt1 = "SELECT * FROM machine_available";
if ($result1 = mysqli_query ($con , $stmt1))
{
    $rowcount1 = mysqli_num_rows($result1);
}

$stmt2 = "SELECT * FROM admin_users";
if ($result2 = mysqli_query ($con , $stmt2))
{
    $rowcount2 = mysqli_num_rows($result2);
}

$stmt3 = "SELECT * FROM doctor_users";
if ($result3 = mysqli_query ($con , $stmt3))
{
    $rowcount3 = mysqli_num_rows($result3);
}

$con -> close();

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7ef9230af3.js" crossorigin="anonymous"></script>
        <link href="special.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet"><title>Administrator Portal</title>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
    </head>
    <title>Administrator Portal</title>
    <body>
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-4">Administrator's Portal</span>
                </a>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="adminhome.php" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="adminprofile.php" class="nav-link">Profile</a></li>
                <li class="nav-item"><a href="adminuserstats.php" class="nav-link">User Stats</a></li>
                <li class="nav-item"><a href="adminserver.php" class="nav-link">Server Stats</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="logout_admin.php" class="nav-link">Logout</a></li>
            </ul>
            </header>
        </div>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="machine.svg" class="square img-fluid" style="width:50px;"></img>
                                </div>
                                <h5 class="mb-2">Total Available Machines in Wards</h5>
                                <h6 class="mb-2"><?php echo $rowcount1;?></h6>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="admin.svg" class="square img-fluid" style="width:50px;"></img>
                                </div>
                                <h5 class="mb-2">Total Administrators Registered</h5>
                                <h6 class="mb-2"><?php echo $rowcount2;?></h6>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="doctor.svg" class="square img-fluid" style="width:50px;"></img>
                                </div>
                                <h5 class="mb-2">Total Doctors Registered</h5>
                                <h6 class="mb-2"><?php echo $rowcount3;?></h6>
                                <p></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </body>
</html>
