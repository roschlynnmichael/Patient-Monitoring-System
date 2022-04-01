<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
    echo 'You are not logged in. Redirecting to admin login in 5 seconds';
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
        <link href="special.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
        <title>Any admin user update</title>
    </head>
    <body>
    <section class="vh-10000 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-7">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4" pb-2 pb-md-0 mb-md-5">Admin's Details Update</h3>
                                <form action="universalupdate.php" method="post" autocomplete="off">
                                <h5 class="mb-4 pb-2 pb-md-0 mb-md-5">Note down the username to be updated from the user stats page</h5>
                                <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" name="username" id="username" class="form-control form-control-lg">
                                                <label class="form-label" for="username">Username</label>
                                            </div>
                                        </div>
                                </div>
                                <h5 class="mb-4 pb-2 pb-md-0 mb-md-5">You can leave the fields you do not want to update blank</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" name="phone_number" id="phone_number" class="form-control form-control-lg">
                                                <label class="form-label" for="phone_number">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" name="email" id="email" class="form-control form-control-lg">
                                                <label class="form-label" for="phone_number">Email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-outline">
                                                <input type="password" name="password" id="password" class="form-control form-control-lg">
                                                <label class="form-label" for="f_name">Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p></p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-outline">
                                                <input type="text" name="address" id="address" class="form-control form-control-lg">
                                                <label class="form-label" for="address">Address</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p></p>
                                    <input type="hidden" name="role" id="role" value="admin"></input>
                                    <div class="mt-4 pt-2">
                                        <input class="btn btn-primary btn-lg" type="submit" value="Submit">
                                    </div>
                                </form>
                                    </br>
                                <div>
                                    <p class="mb-0">Click here to <a href="adminuserstats.php" class="text-black fw-bold">go back!</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>