<?php
/*
 * Created on Sat Jul 03 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
session_start();
require_once('../config/config.php');
require_once('../config/codeGen.php');
/* Handle Sign Up */
if (isset($_POST['sign_up'])) {
    /* Check If Passwords Match */
    if ($_POST['login_password'] != $_POST['confirm_password']) {
        $err = "Passwords Does Not Match";
    } else {
        $login_id = $sys_gen_id;
        $user_id = $sys_gen_id_alt_1;
        $login_email = $_POST['login_email'];
        $login_rank = $_GET['account'];
        $login_password = sha1(md5($_POST['confirm_password']));
        $user_fname = $_POST['user_fname'];
        $user_lname  = $_POST['user_lname'];
        $user_contact  = $_POST['user_contact'];
        $user_location = $_POST['user_location'];
        $user_gender = $_POST['user_gender'];
        $user_age = $_POST['user_age'];
        $user_login_id = $login_id;

        /* Persist */
        $login_sql = "INSERT INTO login(login_id, login_email, login_password, login_rank) VALUES(?,?,?,?)";
        $sign_sql = "INSERT INTO users(user_id, user_fname, user_lname, user_contact, user_location, user_gender, user_age, user_login_id)
        VALUES(?,?,?,?,?,?,?,?)";

        $login_prepare = $mysqli->prepare($login_sql);
        $sign_prepare = $mysqli->prepare($sign_sql);

        $login_bind = $login_prepare->bind_param(
            'ssss',
            $login_id,
            $login_email,
            $login_password,
            $login_rank
        );
        $sign_bind = $sign_bind->bind_param(
            'ssssssss',
            $user_id,
            $user_fname,
            $user_lname,
            $user_contact,
            $user_location,
            $user_gender,
            $user_age,
            $user_login_id
        );

        $login_prepare->execute();
        $sign_prepare->execute();

        if ($login_prepare && $sign_prepare) {
            /* Pass This Alert Via Session */
            $_SESSION['success'] = "Your $login_rank  Has Been Created, Proceed To Login";
            header('Location: login');
            exit;
        }
    }
}
require_once('../partials/head.php');
?>

<body>
    <!-- Preloader-->
    <div class="preloader d-flex align-items-center justify-content-center" id="preloader">
        <div class="spinner-grow text-primary" role="status">
            <div class="sr-only">Loading...</div>
        </div>
    </div>
    <!-- Internet Connection Status-->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center" style="background-color: #e3f2fd">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
                    <div class="text-center px-4"><img class="login-intro-img" src="../public/img/bg-img/29.png" alt=""></div>
                    <div class="register-form mt-4 px-4">
                        <h4 class="mb-3 text-center">Join <b>Errands Service</b> As <?php echo $_GET['account']; ?><br></h4>
                        <form method="POST">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label class="form-label">First Name</label>
                                    <input class="form-control" required name="user_fname" type="text">
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-label">Last Name</label>
                                    <input class="form-control" required name="user_lname" type="text">
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-label">Gender</label>
                                    <select class="form-select" name="user_gender">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-label">Age</label>
                                    <input class="form-control" required name="user_age" type="text">
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-label">Phone Number</label>
                                    <input class="form-control" required name="user_contact" type="text">
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-label">Email Address</label>
                                    <input class="form-control" required name="login_email" type="text">
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-label">Password</label>
                                    <input class="form-control" required name="login_password" type="text">
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input class="form-control" type="password" name="confirm_password">
                                </div>
                            </div>


                            <button class="btn btn-primary w-100" name="sign_up" type="submit">Sign Up</button>
                        </form>
                    </div>
                    <!-- Login Meta-->
                    <div class="login-meta-data text-center">
                        <br><br>
                        <hr>
                        <br>
                        <p class="mb-0">Already have an account? <br> <a class="stretched-link" href="login">Log In </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All JavaScript Files-->
    <?php require_once('../partials/scripts.php'); ?>
</body>


</html>