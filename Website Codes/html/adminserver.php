<?php

include '/var/www/html/patient-monitoring/server-stats/Statsy/statsy.php';

session_start();

if(!isset($_SESSION['loggedin']))
{
    echo 'You have not logged in. You will be redirected to the administrator login page in 5 seconds';
    header('Refresh:5; URL=adminlogin.html');
    exit;
}

header('Refresh:2');

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7ef9230af3.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet"><title>Server Statistics</title>
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
                <li class="nav-item"><a href="adminserver.php" class="nav-link active" aria-current="page">Server Stats</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="logout_admin.php" class="nav-link">Logout</a></li>
            </ul>
            </header>
        </div>
            <div class="container py-5 h-100">
                <h5 class="mb-2">Server statistics (Refreshes every 2 seconds):</h5>
                    </br>
                <h6 class="mb-2">Server IP: <?php echo get_ip();?></h5>
                    </br>
                <h6 class="mb-2">System Uptime: <?php echo get_uptime('secs');?></h5>
                    </br>
                <h6 class="mb-2">System Information: <?php system("uname -a");?></h5>
                    </br>
                <h6 class="mb-2">Memory Information</h6>
                    </br>
                    <table class="table table-striped" id="statistics">
                        <tr>
                            <th>Parameter</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <th>Total Memory</th>
                            <td><?php echo get_total_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>Available Memory</th>
                            <td><?php echo get_available_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>Cached Memory</th>
                            <td><?php echo get_cached_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>Swap Memory</th>
                            <td><?php echo get_swap_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>Buffer Memory</th>
                            <td><?php echo get_buffer_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>SHMemory</th>
                            <td><?php echo get_shmem_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>SReclaimable Memory</th>
                            <td><?php echo get_sreclaimable_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>SUReclaim Memory</th>
                            <td><?php echo get_sunreclaim_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>Free Memory</th>
                            <td><?php echo get_free_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>Real Free Memory</th>
                            <td><?php echo get_realfree_mem('mb');?> MB</td>
                        </tr>
                        <tr>
                            <th>Used Memory</th>
                            <td><?php echo get_used_mem('mb');?> MB</td>
                        </tr>
                    </table>
                    </br>
                    <h6 class="mb-2">Disk Information</h6>
                    </br>
                    <table class="table table-striped" id="statistics">
                        <tr>
                            <th>Parameter</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <th>Total Disk Space Available</th>
                            <td><?php echo get_disk_total('gb');?> GB</td>
                        </tr>
                        <tr>
                            <th>Free Disk Space Available</th>
                            <td><?php echo get_disk_free('gb');?> GB</td>
                        </tr>
                        <tr>
                            <th>Used Disk Space</th>
                            <td><?php echo get_disk_used('gb');?> GB</td>
                        </tr>
                    </table>
                    <a href="checkup.php">
                        <button class="btn btn-primary btn-rounded btn-lg">Server Service Check</button>
                    </a>
                    </br>
                </div>
    </body>
</html>
