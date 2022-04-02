<?php

session_start();
if(!isset($_SESSION['loggedin']))
{
    echo 'Please log in. You are being redirected to doctor login in 5 seconds';
    header ('Refresh:5 ; URL=doctorlogin.html');
    exit;
}


$prsid = rand();
$_SESSION['pres_id'] = "$prsid";

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
                                <a href="doctorhome.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
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
                                <a href="prescribe.php" class="nav-link py-3 px-2 active" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-orifinal-title="Prescribe Medications">
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
                    <h3 class="mb-2">Prescribe Medications</h3>
                    </br>
                    <form action="prescriptions.php" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <div class="form-outline">
                                    <input type="text" name="prsid" id="prsid" value="<?php echo $_SESSION['pres_id'];?>" class="form-control form-control-lg" disabled>
                                    <label class="form-label" for="patient_id">Prescription ID</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="form-outline">
                                    <input type="text" name="patientid" id="patientid" class="form-control form-control-lg" required>
                                    <label class="form-label" for="patientid">Patient ID</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="form-outline">
                                    <input type="text" name="doctor" id="doctor" class="form-control form-control-lg" required>
                                    <label class="form-label" for="doctor">Given By</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <input type="text" name="details" id="details" class="form-control form-control-lg" required>
                                <label class="form-label" for="details">Enter medicines to be given</label>
                            </div>
                        </div>
                        <div class="mt-4 pt-2">
                            <input class="btn btn-primary btn-lg" type="submit" value="Prescribe">
                        </div>
                    </form>
                    </br>
                    <div class="row">
                    <table class="table table-striped">
                        <tr>
                            <th>Patient ID</th>
                            <th>Full Name</th>
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

                            $sql = "SELECT patient_id , full_name , address , phone_number , room_no , bed_no , dr_incharge , admitted_for FROM patient_data WHERE 1";
                            $result = $con -> query($sql);
                            $con -> close();
                        ?>
                        <?php foreach ($result as $row): ?>
                            <tr>
                                <td><?php echo $row['patient_id']; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
