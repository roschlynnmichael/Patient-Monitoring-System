<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
    echo 'Please Log in before you can view this page. You will be redirected to the administrator login in 5 seconds';
    header('Refresh:5 ; URL=adminlogin.html');
    exit;
}

$DATABASE_HOST='server_ip_or_localhost';
$DATABASE_USER='username';
$DATABASE_PASS='password';
$DATABASE_NAME='db_name';

$con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);

if (mysqli_connect_error())
{
    exit ('Failed to connect to MYSQL: ' . mysqli_connect_error());
}

$stmt = $con -> prepare ('SELECT username , f_name , l_name , password , email , address , phone_number FROM admin_users WHERE username = ?');
$stmt -> bind_param ('s' , $_SESSION['username']);
$stmt -> execute();
$stmt -> bind_result ($username , $fname , $lname , $password , $email , $address , $phonenumber);
$stmt -> fetch();
$stmt -> close();

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7ef9230af3.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
        <title>Admin Profile Page</title>
    </head>
    <body>
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-4">Administrator's Portal</span>
                </a>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="adminhome.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="adminprofile.php" class="nav-link active" aria-current="page">Profile</a></li>
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
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp" class="rounded-circle img-fluid" style="width:100px;"></img>
                                </div>
                                <h2 class="mb-2">Username: <?=$_SESSION['username']?></h2>
                                <h6 class="mb-2">First Name: <?=$fname?></h6>
                                <h6 class="mb-2">Last Name: <?=$lname?></h6>
                                <h6 class="mb-2">Address: <?=$address?></h6>
                                <h6 class="mb-2">Phone Number: <?=$phonenumber?></h6>
                                <h6 class="mb-2">Email: <?=$email?></h6>
                                <p></p>
                                <a href="adminpasswordupdate.php">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">Update Details</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
