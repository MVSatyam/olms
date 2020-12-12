<?php

include '../dbconnect.php';
session_start();

if ($_SESSION['security'] != NULL) {
    $security_id = $_SESSION['security'];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Secuty Home</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="../assets/css/mdb.min.css" rel="stylesheet">

        <link href="../assets/css/mdb_pro_min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link rel="stylesheet" href="../assets/css/style.css">

    </head>

    <body class="skin-light">
        <header>
            <!--Navbar-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top scrolling-navbar">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="#"><b>RGUKT OLMS | Security Home</b></a>
                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="basicExampleNav">
                    <!-- Links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link text-success" href="#"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="outingsDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-list"></i> Outings</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="outingsDrop">
                                <a class="dropdown-item" href="outgoing_outings.php">Outgoing Outings</a>
                                <a class="dropdown-item" href="incoming_outings.php">Incoming Outings</a>
                                
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="leavesDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-list"></i> Leaves</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="leavesDrop">
                                <a class="dropdown-item" href="#">Outgoing Leaves</a>
                                <a class="dropdown-item" href="#">Incoming Leaves</a>
                                
                            </div>
                        </li>
                        
                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $security_id; ?></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> SignOut</a>
                            </div>
                        </li>
                    </ul>
                    <!-- Links -->
                </div>
                <!-- Collapsible content -->
            </nav>
            <div class="jumbotron color-grey-light mt-70">
                <div class="d-flex align-items-center h-100">
                    <div class="container text-center py-5">
                        <h3 class="mb-0">
                            Ragiv Gandhi Universities of Knowledge Technologies, Nuzvid
                        </h3>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="container mt-70">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <section class="mb-5">
                            <div class="card text-center outings_card">
                                <div class="d-flex align-items-center h-100">
                                    <div class="container text-center py-5">
                                        <a href="outgoing_outings.php">
                                            <h3 class="mb-0">Outgoing Outings</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-4">
                        <section class="mb-5">
                            <div class="card text-center leaves_card">
                                <div class="d-flex align-items-center h-100">
                                    <div class="container text-center py-5">
                                        <a href="outgoing_leaves.php">
                                            <h3 class="mb-0">Outgoing Leaves</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>

        <!-- jquery.min.3.3.1.js -->
        <!-- <script type="text/javascript" src="assets/js/jquery.3.1.1.min.js"></script> -->
        <!-- jQuery -->
        <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../assets/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
        <script type="text/javascript" src="../assets/js/picker-time.js"></script>
        <!-- Your custom scripts (optional) -->
        <script type="text/javascript">

        </script>
    </body>

    </html>
<?php
} else {
    header('location: login.php');
}
?>