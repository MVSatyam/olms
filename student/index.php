<?php

include '../dbconnect.php';
session_start();

if ($_SESSION['student'] != NULL) {
  $uesr_id = $_SESSION['student'];

  $sql = "SELECT * FROM users WHERE user_id='$uesr_id'";
  $query = mysqli_query($conn, $sql);

  $user_details = mysqli_fetch_array($query);
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Student Home</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../assets/css/mdb.min.css" rel="stylesheet">

    <link href="../assets/css/mdb_pro_min.css" rel="stylesheet">
    <!-- Jquery-confirm.min.css -->
    <link rel="stylesheet" href="../assets/css/jquery-confirm.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style type="text/css">
      html, body {
        font-weight: bold;
      }
      /*.dark-mode {
        filter: invert(1) hue-rotate(180deg);
      }
      img, picture, video {
  filter: invert(1) hue-rotate(180deg)
}*/
    </style>

  </head>

  <body class="skin-light">
    <header>
      <!--Navbar-->
      <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top scrolling-navbar z-depth-1">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="#"><b>RGUKT OLMS | Home</b></a>
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
            <li class="nav-item">
              <a class="nav-link text-success" href="outings.php"><i class="fas fa-list"></i> Outings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-success" href="leaves.php"><i class="fas fa-list"></i> Leaves</a>
            </li>
            <li class="nav-item dropdown" id='demo'>
              <a class="nav-link dropdown-toggle text-success" id="dropdownMenuNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-userid="<?php echo $uesr_id; ?>"><i class="fas fa-bell"></i> Notifications<span id="notification_count" class="badge badge-danger badge-pill"></span></a>
              <div class="dropdown-menu dropdown-menu-right z-depth-1" id="notification-dropdown" aria-labelledby="dropdownMenuNotification">
                <!-- <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <a class="dropdown-item" href="#">Something else here</a> -->
              </div>
            </li>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-success" id="navbarDropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $uesr_id; ?></a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuUser">
                <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a>
                <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Edit Profile</a>
                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> LogOut</a>
              </div>
            </li>
          </ul>
          <!-- Links -->
        </div>
        <!-- Collapsible content -->
      </nav>
    </header>
    <main>
      <div class="container" style="margin-top: 100px;">
        <div class="row d-flex justify-content-around">

          <div class="col-lg-4">
            <section class="mb-5">
              <div class="card testimonial-card border">

                <!--Background color-->
                <div class="card-up bg-primary lighten-2">
                </div>

                <!--Avatar-->
                <div class="avatar mx-auto white">
                  <a href="javascript:void(0)"><img src="../user_profiles/<?php echo $uesr_id . '.jpg' ?>" alt="avatar mx-auto white" class="rounded-circle img-fluid"></a>
                </div>

                <div class="card-body">
                  <!--Name-->
                  <h4 class="card-title mt-1"><?php echo $uesr_id; ?></h4>
                  <hr>
                  <!--Quotation-->
                  <p class="card-text">
                    <h6>Total Outings: <span class="text-success"><?php echo $user_details['total_outings']; ?></span>
                      <h6>
                  </p>
                  <p class="card-text">
                    <h6>Total Leaves: <span class="text-success"><?php echo $user_details['total_leaves']; ?></span>
                      <h6>
                  </p>
                  <hr>
                  <p class="card-text">
                    <h6>Outings Left: <span class="text-danger"><?php echo $user_details['rem_outings']; ?></span>
                      <h6>
                  </p>
                </div>

              </div>
            </section>
          </div>

          <div class="col-lg-6">
            <section class="mb-5">

              <div class="card p-3 border">
                <div class="jumbotron color-grey-light">
                  <div class="d-flex align-items-center h-25">
                    <div class="container text-center py-5">
                      <h3 class="mb-0">Apply Outing</h3>
                    </div>
                  </div>
                </div>
                <div class="md-form md-outline">
                  <textarea class="form-control border-success" name="outing_reason" id="outingReason" rows="3"></textarea>
                  <label for="outingReason" class="text-success">Type Reason</label>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="md-form">
                      <input placeholder="Start Time" type="text" id="input_starttime" class="form-control timepicker border-success" required>
                      <label for="input_starttime" class="text-success">Start Time</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form">
                      <input placeholder="End Time" type="text" id="input_endtime" class="form-control timepicker border-success" disabled>
                      <label for="input_endtime" class="text-success">End Time</label>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-center">
                  <button class="btn btn-success waves-effect submit_outing" data-userid="<?php echo $uesr_id; ?>" name="submit_outing">Submit</button>
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
    <!-- jquery-confirm.min.js -->
    <script type="text/javascript" src="../assets/js/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="../assets/js/notifications.js"></script>
    <!-- Your custom scripts (optional) -->
    <script type="text/javascript">
      // Time Picker Initialization
      $('#input_starttime').pickatime({
        twelvehour: true,
        min: "8:00AM",
        max: "9:00PM",
        default: "8:00AM"
      }).val('8:00AM');
      $('#input_endtime').pickatime({
        twelvehour: true,
        min: "8:00AM",
        max: "9:00PM",
      }).val('9:00PM');

      $(document).on('click', '.submit_outing', function() {
        var user_id = $(this).data('userid');
        var outingReason = $('#outingReason').val();
        var startTime = $('#input_starttime').val();
        var endTime = $('#input_endtime').val();

        if (user_id != '' && outingReason != '' && startTime != '' && endTime != '') {
          // console.log(user_id + '\n' + outingReason + '\n' + startTime + '\n' + endTime);
          $.alert({
            title: 'Hello ' + user_id,
            content: 'Are you sure to apply outing?',
            theme: 'modern',
            buttons: {
              Ok: {
                btnClass: 'btn-success',
                action: function() {
                  $.ajax({
                    url: 'apply_outing.php',
                    method: 'post',
                    data: 'user_id=' + user_id + '&outing_reason=' + outingReason + '&start_time=' + startTime + '&end_time=' + endTime,
                    success: function(result) {
                      $.alert({
                        title: 'Hello ' + user_id,
                        content: result,
                        theme: 'modern',
                        buttons: {
                          Ok: {
                            btnClass: 'btn-success'
                          }
                        }
                      });
                      $('#outingReason').val('')
                      $('#input_starttime').val('8:00AM')
                    }
                  })
                }
              },
              Cancel: {
                btnClass: 'btn-danger',
              }
            }
          })
        } else {
          $.dialog({
            title: 'Hello ' + user_id,
            content: 'Please Enter Details',
            theme: 'modern'
          });
        }
      })

      $(document).on('click', '#demo', function() {
        var uesr_id = $(this).data('userid');
        // $.ajax({
        //   url: 'clear_notification_count.php',
        //   type: 'post',
        //   data: 'user_id=' + user_id,
        //   success: function(result) {
        //     $('#notification_count').html(result)
        //   }
        // })
        console.log(user_id);
      })

      // $(document).ready(function(){
      //   document.documentElement.classList.add('dark-mode')
      // })
    </script>
  </body>

  </html>
<?php
} else {
  header('location: login.php');
}
?>