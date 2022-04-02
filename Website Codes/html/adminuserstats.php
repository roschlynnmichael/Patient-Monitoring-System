<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
    echo 'You are not logged in. You are being redirected to administrator login in 5 seconds';
    header('Refresh:5 ; URL=adminlogin.html');
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
        <title>User Statistics</title>
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
                <li class="nav-item"><a href="adminuserstats.php" class="nav-link active" aria-current="page">User Stats</a></li>
                <li class="nav-item"><a href="adminserver.php" class="nav-link">Server Stats</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="logout_admin.php" class="nav-link">Logout</a></li>
            </ul>
            </header>
        </div>
            <div class="container py-5 h-100">
                    <h5 class="mb-2">List of all administrators available to manage:</h5>
                <table class="table table-striped" id="admin">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Account Status</th>
                    </tr>
                    <?php
                        $DATABASE_HOST='server_ip_or_localhost';
                        $DATABASE_USER='username';
                        $DATABASE_PASS='password';
                        $DATABASE_NAME='db_name';
                        
                        $con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);
                        
                        if (mysqli_connect_error())
                        {
                            exit ('Failed to connect to MYSQL: ' . mysqli_connect_error());
                        }

                        $sql = "SELECT id , username , f_name , l_name , email , address , phone_number , activation_code FROM admin_users WHERE 1";
                        $result = $con -> query($sql);
                        $con -> close();
                        while ($row = $result -> fetch_assoc())
                        {
                            ?>
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['username'];?></td>
                                <td><?php echo $row['f_name'];?></td>
                                <td><?php echo $row['l_name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['address'];?></td>
                                <td><?php echo $row['phone_number'];?></td>
                                <td><?php echo $row['activation_code'];?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
                <a href="upd_anyadmin.php">
                    <button class="btn btn-primary btn-rounded btn-lg">Update Details of any Admin</button>
                </a>
                </br>
                </br>
                </br>
                    <h5 class="mb-2">List of all doctors available:</h5>
                <table class="table table-striped" id="doctor">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Account Status</th>
                    </tr>
                    <?php
                        $DATABASE_HOST='server_ip_or_localhost';
                        $DATABASE_USER='username';
                        $DATABASE_PASS='password';
                        $DATABASE_NAME='db_name';
                        
                        $con = mysqli_connect($DATABASE_HOST , $DATABASE_USER , $DATABASE_PASS , $DATABASE_NAME);
                        
                        if (mysqli_connect_error())
                        {
                            exit ('Failed to connect to MYSQL: ' . mysqli_connect_error());
                        }

                        $sql = "SELECT id , username , f_name , l_name , email , address , phone_number , activation_code FROM doctor_users WHERE 1";
                        $result = $con -> query($sql);
                        $con -> close();
                        while ($row = $result -> fetch_assoc())
                        {
                            ?>
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['username'];?></td>
                                <td><?php echo $row['f_name'];?></td>
                                <td><?php echo $row['l_name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['address'];?></td>
                                <td><?php echo $row['phone_number'];?></td>
                                <td><?php echo $row['activation_code'];?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
                <a href="upd_anydoctor.php">
                    <button class="btn btn-primary btn-rounded btn-lg">Update Details of any Doctor</button>
                </a>
                </br>
                </br>
                </br>
                </br>
            </div>
    </body>
</html>
