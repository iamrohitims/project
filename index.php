<?php
session_start();

// checking if session exist then user cant be able to return to login page
if (isset($_SESSION['teacher_id'])) {
    header("Location: admin/index.php");
    exit();
}

//cheking for error if throwen then displaying above password field
$error = '';
if(isset($_GET['error'])) {
    $error = $_GET['error'];
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Teacher Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
      .error-message {
        color: red;
        font-size: 14px;
        margin-top: 10px;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100">
          <div class="login100-pic js-tilt" data-tilt>
            <img src="images/img-01.png" alt="IMG">
          </div>
          <form class="login100-form validate-form" method="post" action="php/login_action.php">
            <span class="login100-form-title"> Teacher Login </span>
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
              <input class="input100" type="text" name="username" placeholder="Email">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Password is required">
              <input class="input100" type="password" name="password" placeholder="Password">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div> <?php if (!empty($error)): ?> <div class="wrap-input100 validate-input error-message"> <?php echo $error; ?> </div> <?php endif; ?> <div class="container-login100-form-btn">
              <button class="login100-form-btn"> Login </button>
            </div>
            <div class="text-center p-t-12"></div>
            <div class="text-center p-t-136"></div>
          </form>
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
      $('.js-tilt').tilt({
        scale: 1.1
      })
    </script>
    <script src="js/main.js"></script>
  </body>
</html>