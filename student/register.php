<?php

include '../dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Student SignUp</title>
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

            <a href="#" class="navbar-brand"><b>RGUKT OLMS | Student SignUp</b></a>

        </nav>

        <div class="jumbotron color-grey-light mt-70">
            <div class="d-flex align-items-center h-100">
                <div class="container text-center py-5">
                    <h3 class="mb-0">Student SignUp</h3>
                </div>
            </div>
        </div>

    </header>

    <main>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <section class="mb-5">
                        <form action="register.php" method="post">

                            <div class="md-form md-outline">
                                <input type="text" id="userId" class="form-control" name="user_id" autocomplete="off" required>
                                <label for="userId">User id</label>
                            </div>

                            <div class="md-form md-outline">
                                <input type="password" id="userPassword" class="form-control" name="user_password" required>
                                <label for="userPassword">Password</label>
                            </div>

                            <div class="text-center pb-2">
                                <button type="submit" class="btn btn-primary mb-4" name="user_signup">Sugn Up</button>
                            </div>

                            <div class="d-flex justify-content-center">
                                <p>Already have account? Please Click <a href="login.php">Sign In</a></p>
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

if (isset($_POST['user_signup'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $user_passwd = mysqli_real_escape_string($conn, $_POST['user_password']);

    $sql_id_existed = "SELECT * FROM users WHERE user_id='$user_id'";
    $query_id_existed = mysqli_query($conn, $sql_id_existed);

    $count = mysqli_num_rows($query_id_existed);

    if ($count == 0) {
        $sql = "INSERT INTO users(user_id, user_passwd) VALUES('$user_id','$user_passwd')";
        $query = mysqli_query($conn, $sql);

        header('location: login.php');
        
    } else{
        echo "<script>alert('User Id aleady existed!!!')</script>";
    }
}

?>