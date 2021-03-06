<?php
/*
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
require_once('../config/checklogin.php');
check_login();
/* Update Profile */
if (isset($_POST['Update_profile'])) {
    $user_id = $_SESSION['user_id'];
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_contact = $_POST['user_contact'];
    $user_location = $_POST['user_location'];
    $user_age = $_POST['user_age'];
    $user_gender = $_POST['user_gender'];

    /* Persist */
    $sql = "UPDATE users SET user_fname =?, user_lname =?, user_contact =?, user_location =?, user_age =?, user_gender =? WHERE user_id =?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'sssssss',
        $user_fname,
        $user_lname,
        $user_contact,
        $user_location,
        $user_age,
        $user_gender,
        $user_id
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Profile Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}
/* Update Login Info */
if (isset($_POST['Update_auth'])) {
    $login_id = $_SESSION['login_id'];
    $login_email = $_POST['login_email'];
    $login_question = $_POST['login_question'];
    $login_answer = $_POST['login_answer'];

    /* Persist */
    $sql = "UPDATE login SET login_email =?, login_question =?, login_answer =? WHERE login_id = ?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ssss',
        $login_email,
        $login_question,
        $login_answer,
        $login_id
    );
    $prepare->execute();
    if ($prepare) {
        $success  = "Login Details Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Update Password */
if (isset($_POST['Update_Password'])) {
    $old_password = sha1(md5($_POST['old_password']));
    $new_password = sha1(md5($_POST['new_password']));
    $confirm_password = sha1(md5($_POST['confirm_password']));
    $login_id = $_SESSION['login_id'];

    /* Check If Old Password  Match  */
    $sql = "SELECT * FROM login WHERE login_id = '$login_id'";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($old_password != $row['login_password']) {
            $err =  "Please Enter Correct Old Password";
        } elseif ($new_password != $confirm_password) {
            $err = "Confirmation Password Does Not Match";
        } else {
            $query = "UPDATE login SET  login_password =? WHERE login_id =?";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ss', $new_password, $login_id);
            $stmt->execute();
            if ($stmt) {
                $success = "Password Updated";
            } else {
                $err = "Please Try Again Or Try Later";
            }
        }
    }
}
require_once('../partials/head.php');
$user_id = $_SESSION['user_id'];
$ret = "SELECT * FROM users u
INNER JOIN login l ON l.login_id =  u.user_login_id
WHERE u.user_id = '$user_id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($users = $res->fetch_object()) {
?>

    <body>
        <!-- Preloader-->
        <!-- Preloader-->
        <div class="preloader d-flex align-items-center justify-content-center" id="preloader">
            <div class="spinner-grow text-primary" role="status">
                <div class="sr-only">Loading...</div>
            </div>
        </div>
        <!-- Internet Connection Status-->
        <div class="internet-connection-status" id="internetStatus"></div>
        <!-- Header Area-->
        <div class="header-area" id="headerArea">
            <div class="container">
                <!-- Header Content-->
                <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
                    <!-- Back Button-->
                    <div class="back-button">
                        <a href="freelancer_home">
                            <svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                            </svg>
                        </a>
                    </div>
                    <!-- Page Title-->
                    <div class="page-heading">
                        <h6 class="mb-0"><?php echo $users->user_fname . ' ' . $users->user_lname; ?> Profile</h6>
                    </div>
                    <!-- Navbar Toggler-->
                    <div class="navbar--toggler" id="affanNavbarToggler"><span class="d-block"></span><span class="d-block"></span><span class="d-block"></span></div>
                </div>
            </div>
        </div>
        <!-- Dark mode switching-->
        <div class="dark-mode-switching">
            <div class="d-flex w-100 h-100 align-items-center justify-content-center">
                <div class="dark-mode-text text-center"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.53 10.53a7 7 0 0 1-9.058-9.058A7.003 7.003 0 0 0 8 15a7.002 7.002 0 0 0 6.53-4.47z" />
                    </svg>
                    <p class="mb-0">Switching to dark mode</p>
                </div>
                <div class="light-mode-text text-center"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16">
                        <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                    </svg>
                    <p class="mb-0">Switching to light mode</p>
                </div>
            </div>
        </div>
        <!-- Sidenav Black Overlay-->
        <div class="sidenav-black-overlay"></div>
        <!-- Side Nav Wrapper-->
        <?php require_once('../partials/side_nav.php'); ?>
        <div class="page-content-wrapper py-3">
            <div class="container">
                <!-- User Information-->
                <div class="card user-info-card mb-3">
                    <div class="card-body d-flex align-items-center">
                        <div class="user-profile me-3">
                            <img src="../public/img/bg-img/profile.svg" alt="">
                        </div>
                        <div class="user-info">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-1"><?php echo $users->user_fname . ' ' . $users->user_lname; ?></h5>
                            </div>
                            <p class="mb-0"><?php echo $users->login_rank; ?></p>
                        </div>
                    </div>
                </div>
                <!-- User Meta Data-->
                <fieldset class="border border-primary p-2">
                    <legend class="w-auto text-primary pull-center">Personal Information</legend>
                    <div class="card user-data-card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group mb-3">
                                    <label class="form-label">First name</label>
                                    <input class="form-control" type="text" name="user_fname" value="<?php echo $users->user_fname; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Last name</label>
                                    <input class="form-control" type="text" name="user_lname" value="<?php echo $users->user_lname; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Contacts</label>
                                    <input class="form-control" type="text" name="user_contact" value="<?php echo $users->user_contact; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="address">Address</label>
                                    <input class="form-control" type="text" name="user_location" value="<?php echo $users->user_location; ?>">
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-6">
                                        <label class="form-label" for="address">Age</label>
                                        <input class="form-control" type="text" name="user_age" value="<?php echo $users->user_age; ?>">
                                    </div>
                                    <div class="form-group mb-3 col-6">
                                        <label class="form-label" for="address">Gender</label>
                                        <select class="form-control" type="text" name="user_gender" value="">
                                            <option><?php echo $users->user_gender; ?></option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-success w-100" type="submit" name="Update_profile">Update Now</button>
                            </form>
                        </div>
                    </div>
                </fieldset>
                <hr>
                <!-- Login Info -->
                <fieldset class="border border-primary p-2">
                    <legend class="w-auto text-primary pull-center">Authentication Information</legend>
                    <div class="card user-data-card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group mb-3">
                                    <label class="form-label">Email </label>
                                    <input class="form-control" type="text" name="login_email" value="<?php echo $users->login_email; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="bio">Login Security Question</label>
                                    <textarea class="form-control" name="login_question" cols="20" rows="2"><?php echo $users->login_question; ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="bio">Login Question Answer</label>
                                    <textarea class="form-control" name="login_answer" cols="20" rows="2"><?php echo $users->login_answer; ?></textarea>
                                </div>
                                <button class="btn btn-success w-100" type="submit" name="Update_auth">Update Authentication Information</button>
                            </form>
                        </div>
                    </div>
                </fieldset>
                <hr>
                <!-- Passwords -->
                <fieldset class="border border-primary p-2">
                    <legend class="w-auto text-primary pull-center">Passwords</legend>
                    <div class="card user-data-card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group mb-3">
                                    <label class="form-label">Old Password </label>
                                    <input class="form-control" type="password" name="old_password">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">New Password </label>
                                    <input class="form-control" type="password" name="new_password">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Confirm New Password </label>
                                    <input class="form-control" type="password" name="confirm_password">
                                </div>
                                <button class="btn btn-success w-100" type="submit" name="Update_Password">Update Passwords</button>
                            </form>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- Footer Nav-->
        <?php require_once('../partials/footer_nav.php'); ?>
        <?php require_once('../partials/scripts.php'); ?>
    </body>
<?php } ?>

</html>