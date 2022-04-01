<?php

session_start();

if(!isset($_SESSION['loggedin']))
{
    echo 'You have not logged in. You will be redirected to the administrator login page in 5 seconds';
    header('Refresh:5; URL=adminlogin.html');
    exit;
}

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
    <title>About</title>
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
                <li class="nav-item"><a href="adminprofile.php" class="nav-link">Profile</a></li>
                <li class="nav-item"><a href="adminuserstats.php" class="nav-link">User Stats</a></li>
                <li class="nav-item"><a href="adminserver.php" class="nav-link">Server Stats</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link active" aria-current="page">About</a></li>
                <li class="nav-item"><a href="logout_admin.php" class="nav-link">Logout</a></li>
            </ul>
            </header>
        </div>
            <div class="container py-5 h-100">
                <h5 class="mb-2" align="center">Hardware Provided by Raspberry Pi Foundation and Arduino &#128151;</h5>
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="raspberry.png" class="rounded-circle img-fluid" style="width:100px;"></img>
                                </div>
                                <h5 class="mb-2">Raspberry Pi Foundation</h5>
                                <p>Ecosystem Provider</p>
                                <p></p>
                                <a href="https://www.raspberrypi.org/" target="_blank">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">Pi Foundation</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="arduino.png" class="square img-fluid" style="width:100px;"></img>
                                </div>
                                <h5 class="mb-2">Arduino</h5>
                                <p>IoT Enabled Projects and Learning</p>
                                <p></p>
                                <a href="https://www.arduino.cc/" target="_blank">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">Arduino</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                </br>
                <h5 class="mb-2" align="center">Made using opensource tools deployed on LAMP server &#128151;</h5>
                <div class="row d-flex justify-content-left align-items-center h-100">
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="github.png" class="rounded-circle img-fluid" style="width:70px;"></img>
                                </div>
                                <h5 class="mb-2">Statsy</h5>
                                <p>Server Statistics using PHP</p>
                                <p></p>
                                <a href="https://github.com/tmrouse/server-stats" target="_blank">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">GitHub</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="mariadb.png" class="square img-fluid" style="width:138px;"></img>
                                </div>
                                <h5 class="mb-2">MariaDB</h5>
                                <p>Open-Source Relational-Database</p>
                                <p></p>
                                <a href="https://mariadb.org/" target="_blank">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">MariaDB</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="raspberry.png" class="rounded-circle img-fluid" style="width:110px;"></img>
                                </div>
                                <h5 class="mb-2">Raspbian Linux Operating System</h5>
                                <p>For Raspberry Pi. A linux distro based on Debian</p>
                                <p></p>
                                <a href="https://www.raspberrypi.com/software/operating-systems/" target="_blank">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">Raspbian</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                <div class="row d-flex justify-content-left align-items-center h-100">
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="apache2.png" class="square img-fluid" style="width:135px;"></img>
                                </div>
                                <h5 class="mb-2">Apache 2 Web Server</h5>
                                <p>Responsible for hosting our Website</p>
                                <p></p>
                                <a href="https://httpd.apache.org/" target="_blank">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">Apache2</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="phpmyadmin.svg" class="square img-fluid" style="width:125px;"></img>
                                </div>
                                <h5 class="mb-2">PHPMyAdmin</h5>
                                <p>Database Management and Organization</p>
                                <p></p>
                                <a href="https://www.phpmyadmin.net/" target="_blank">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">PHPMyAdmin</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="mdb.webp" class="square img-fluid" style="width:200px;"></img>
                                </div>
                                <h5 class="mb-2">MDB Bootstrap</h5>
                                <p>Material Design for Bootstrap V5 and V4</p>
                                <p></p>
                                <a href="https://mdbootstrap.com/" target="_blank">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">MDB Bootstrap</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </br>
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-12 col-xl-4">
                        <div class="card" style="border-radius:15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="github.png" class="square img-fluid" style="width:70px;"></img>
                                </div>
                                <h5 class="mb-2">PHP Server Status</h5>
                                <p>Provides Server Statistics</p>
                                <p></p>
                                <a href="https://github.com/truongan/php.server.status" target="_blank">
                                    <button type="button" class="btn btn-primary btn-rounded btn-lg">GitHub</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
