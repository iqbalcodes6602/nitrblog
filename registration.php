<?php
require_once 'functions.php';
require_once 'config.php';
require_once 'connect.php';
require_once 'header.php';

echo '<div class="text-center bg-white">
<h1 class="mb-2">Sign Up</h1>
</div>';

if (!empty(SITE_ROOT)) {
    $url_path = "/" . SITE_ROOT . "/";
} else {
    $url_path = "/";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($dbcon, $username);
        $sql = "select * from admin where (username='$username');";
        $res = mysqli_query($dbcon, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($username == isset($row['username'])) {
                echo "<div class='form'>
                <h3>username already taken.please choose someone else.</h3><br/>
                <p class='link'>Click here to <a href='registration.php'>Register Again</a></p>
                </div>";
            }
            return;
        }
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username) || $username == "") {
            echo "<div class='form'>
            <h3>Only letters and white space allowed and name cannot be empty.</h3><br/>
            <p class='link'>Click here to <a href='registration.php'>Register Again</a></p>
            </div>";
            return;
        }

        $fname = stripslashes($_REQUEST['fname']);
        $fname = mysqli_real_escape_string($dbcon, $fname);
        $sql = "select * from admin where (username='$fname');";
        $res = mysqli_query($dbcon, $sql);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname) || $fname == "") {
            echo "<div class='form'>
            <h3>Only letters and white space allowed and name cannot be empty.</h3><br/>
            <p class='link'>Click here to <a href='registration.php'>Register Again</a></p>
            </div>";
            return;
        }

        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($dbcon, $email);
        $sql = "select * from admin where (email='$email');";
        $res = mysqli_query($dbcon, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($email == isset($row['email'])) {
                echo "<div class='form'>
                <h3>Email Already Exists.</h3><br/>
                <p class='link'>Click here to <a href='registration.php'>Register Again</a></p>
                </div>";
            }
            return;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            echo "<div class='form'>
            <h3>Invalid Email.</h3><br/>
            <p class='link'>Click here to <a href='registration.php'>Register Again</a></p>
            </div>";
            return;
        }

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($dbcon, $password);

        $date = date("Y-m-d H:i:s");
        $query    = "INSERT into `admin` (username, fname, password, email, profile_pic, date)
                     VALUES ('$username','$fname', '$password', '$email', 'assets/profile_img/default_img.png', '$date')";
        $result   = mysqli_query($dbcon, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <form class="form" action="" method="post">
            <section>
                <div class="container-fluid h-custom">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-9 col-lg-6 col-xl-5">
                            <img src="./assets/draw2.webp" class="img-fluid" alt="Sample image">
                        </div>
                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                            <form action="" method="post">
                                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                    <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                                    <button type="button" class="btn btn-primary btn-floating mx-1">
                                        <i class="fa fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-primary btn-floating mx-1">
                                        <i class="fa fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-primary btn-floating mx-1">
                                        <i class="fa fa-linkedin"></i>
                                    </button>
                                </div>

                                <div class="divider d-flex align-items-center my-4">
                                    <p class="text-center fw-bold mx-3 mb-0">Or</p>
                                </div>
                                <!-- user Name input -->
                                <div class="form-outline mb-4">
                                    <input name="username" type="text" id="form3Example3" class="form-control form-control-lg" placeholder="Username (should be unique)" />

                                </div>

                                <!-- Full Name input -->
                                <div class="form-outline mb-4">
                                    <input name="fname" type="text" id="form3Example3" class="form-control form-control-lg" placeholder="Full Name" />

                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input name="email" type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" />

                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-3">
                                    <input name="password" type="text" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" />
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                        <label class="form-check-label" for="form2Example3">
                                            Remember me
                                        </label>
                                    </div>
                                </div>

                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login.php" class="link-danger">Login Here</a></p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    <?php
    }
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
<?php
include("footer.php");
