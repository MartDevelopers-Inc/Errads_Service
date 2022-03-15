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
                        <h4 class="mb-3 text-center">Join <b>Errands Service</b><br>
                        </h4>
                        <!-- Card 03 -->
                        <a href="sign_up_as?account=Client">
                            <div class="card border border-primary">
                                <div class="card-body d-flex align-items-center">
                                    <h5 class="text-center">I am a <b>Client</b>, hiring for an errand service </h5>
                                </div>
                            </div>
                        </a>
                        <br>
                        <a href="sign_up_as?account=Client">
                            <div class="card border border-primary">
                                <div class="card-body d-flex align-items-center">
                                    <h5 class="text-center">I am a <b>Freelancer</b>, offering errand services</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Login Meta-->
                    <div class="login-meta-data text-center">
                        <br><br><br>
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