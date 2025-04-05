<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");
$result = 0;
if(isset($_POST['signup'])){
    if(isset($_GET['id'])){
        $password = $db_handle->checkValue($_POST['password']);
        $confirm_password = $db_handle->checkValue($_POST['confirm_password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if($password == $confirm_password){
            $update_password = $db_handle->insertQuery("UPDATE `login` SET `password`='$hashedPassword',`updated_at`='$inserted_at' WHERE `id` = {$_GET['id']}");
            if($update_password){
                $result = 1;
            } else {
                $result = 2;
            }
        }
    } else {
        $result = 3;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Ready | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- ================== BEGIN core-css ================== -->
    <link href="assets/css/vendor.min.css" rel="stylesheet" />
    <link href="assets/css/app.min.css" rel="stylesheet" />
    <!-- ================== END core-css ================== -->

</head>
<body >
<!-- BEGIN #loader -->
<div id="loader" class="app-loader">
    <div class="d-flex align-items-center">
        <div class="app-loader-circle"></div>
        <div class="app-loader-text">LOADING...</div>
    </div>
</div>
<!-- END #loader -->

<!-- BEGIN #app -->
<div id="app" class="app app-full-height app-without-header">
    <!-- BEGIN register -->
    <div class="register">
        <!-- BEGIN register-content -->
        <div class="register-content">
            <form action="#" method="post">
                <h1 class="text-center">Sign Up</h1>
                <p class="text-body text-opacity-50 text-center mb-4">One Admin ID is all you need to access all the Admin services.</p>
                <?php if ($result == 1) {
                    ?>
                    <div class="alert alert-success mt-3 mb-3">
                        <strong>Well done!</strong> Your password is not reset. Login and enjoy our exciting features!
                    </div>
                    <?php
                } if ($result == 2){
                    ?>
                    <div class="alert alert-danger mt-3 mb-3">
                        <strong>Sorry!</strong> Something went wrong. Please try again later.
                    </div>
                    <?php
                } if($result == 3){
                    ?>
                    <div class="alert alert-warning mt-3 mb-3">
                        <strong>Sorry!</strong> Something went wrong.
                    </div>
                    <?php
                }?>
                <div class="mb-4">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control form-control-lg fs-14px" id="password" name="password" autocomplete="off" required/>
                    <small id="passwordError" class="text-danger"></small>
                </div>
                <div class="mb-4">
                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control form-control-lg fs-14px" id="confirm_password" name="confirm_password" autocomplete="off" required/>
                    <small id="confirmPasswordError" class="text-danger"></small>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-theme btn-lg d-block w-100 mb-3" id="signupBtn" name="signup">SIGN UP</button>
                </div>
                <div class="text-body text-opacity-50 text-center">
                    Already have an Admin ID? <a href="Login">Sign In</a>
                </div>
            </form>
        </div>
        <!-- END register-content -->
    </div>
    <!-- END register -->

    <!-- BEGIN btn-scroll-top -->
    <a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade">
        <iconify-icon icon="material-symbols-light:keyboard-arrow-up"></iconify-icon>
    </a>
    <!-- END btn-scroll-top -->

    <!-- BEGIN theme-panel -->
    <?php include ('includes/themecolor.php');?>
    <!-- END theme-panel -->
</div>
<!-- END #app -->


<script>
    document.getElementById("signupBtn").addEventListener("click", function(event) {
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("confirm_password").value;
        let passwordError = document.getElementById("passwordError");
        let confirmPasswordError = document.getElementById("confirmPasswordError");

        // Regular expression to check password complexity
        let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Reset errors
        passwordError.textContent = "";
        confirmPasswordError.textContent = "";

        if (!passwordRegex.test(password)) {
            passwordError.textContent = "Password must be at least 8 characters, include an uppercase letter, lowercase letter, number, and special character.";
            event.preventDefault(); // Prevent form submission
            return;
        }

        if (password !== confirmPassword) {
            confirmPasswordError.textContent = "Passwords do not match.";
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

<!-- ================== BEGIN core-js ================== -->
<script src="code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js" type="8cb030c75ea61c7a95327872-text/javascript"></script>
<script src="assets/js/vendor.min.js" type="8cb030c75ea61c7a95327872-text/javascript"></script>
<script src="assets/js/app.min.js" type="8cb030c75ea61c7a95327872-text/javascript"></script>
<!-- ================== END core-js ================== -->


<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3Q0VGQKY3" type="8cb030c75ea61c7a95327872-text/javascript"></script>

<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="8cb030c75ea61c7a95327872-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"927e1ea2ec5fc86b","version":"2025.3.0","r":1,"serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"4db8c6ef997743fda032d4f73cfeff63","b":1}' crossorigin="anonymous"></script>
</body>

</html>
