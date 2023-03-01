<?php
require_once 'connect.php';
require_once 'header.php';

echo '<div class="text-center bg-white">
<h1 class="mb-2">Sign In</h1>
</div>';

if (isset($_POST['log'])) {
    $username = mysqli_real_escape_string($dbcon, $_POST['username']);
    $password = mysqli_real_escape_string($dbcon, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username = '$username'";

    $result = mysqli_query($dbcon, $sql);
    $row = mysqli_fetch_assoc($result);
    $row_count = mysqli_num_rows($result);


    if ($row_count == 1 && ($password == $row['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $row['email'];
        $_SESSION['profile_pic'] = $row['profile_pic'];
        header("location: admin.php");
    } else {
        echo "<div class='w3-panel w3-pale-red w3-display-container'>Incorrect username or password.</div>";
    }
}
?>


<form action="" method="POST" class="w3-container w3-padding">
    <section style="margin-top: 0%;">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="./assets//draw2.webp" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post" name="login">
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

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input name="username" value="<?php if (isset($_POST['username'])) {
                                                                echo strip_tags($_POST['username']);
                                                            } ?>" type="text" id="form3Example3" class="form-control form-control-lg" placeholder="User Name (Eg: newadmin)" />
                         </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="Password (Eg: 123)" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" name="log" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="registration.php" class="link-danger">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</form>
<?php
include("footer.php");
