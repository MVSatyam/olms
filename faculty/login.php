<?php
session_start();

if (isset($_SESSION['faculty'])) {
    header('location: index.php');
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Faculty Login</title>
        <!-- Font Awesome -->
        <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->
        <!-- Google Fonts Roboto -->
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"> -->
        <!-- Bootstrap core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="../assets/css/mdb.min.css" rel="stylesheet">

        <link href="../assets/css/mdb_pro_min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

    </head>

    <body class="skin-light bg-white">
        <!-- Start your project here-->
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top">

                <a href="#" class="navbar-brand"><b>RGUKT OLMS | Faculty Login</b></a>

            </nav>

            <div class="jumbotron color-grey-light mt-70">
                <div class="d-flex align-items-center h-100">
                    <div class="container text-center py-5">
                        <h3 class="mb-0">Faculty Login</h3>
                    </div>
                </div>
            </div>

        </header>

        <main>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <section class="mb-5">
                            <form action="login.php" method="post">
                                
                                <div class="md-form md-outline">
                                    <input type="text" id="userId" class="form-control" name="user_id" autocomplete="off" required>
                                    <label for="userId">User id</label>
                                </div>

                                <div class="md-form md-outline">
                                    <input type="password" id="userPassword" class="form-control" name="user_password" required>
                                    <label for="userPassword">Password</label>
                                </div>

                                <div class="text-center pb-2">
                                    <button type="submit" class="btn btn-primary mb-4 login" name="user_login">Login</button>
                                </div>

                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </main>
        <!-- End your project here-->

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
        <!-- Your custom scripts (optional) -->
        <script type="text/javascript">

        </script>
    </body>

    </html>
<?php
}

?>