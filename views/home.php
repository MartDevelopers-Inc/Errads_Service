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
require_once('../partials/analytics.php');
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
    <!-- Header Area-->
    <div class="header-area" id="headerArea">
        <div class="container">
            <!-- Header Content-->
            <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
                <!-- Logo Wrapper-->
                <div class="logo-wrapper"><a href="home"><b>Errands Service<b></a></div>
                <!-- Navbar Toggler-->
                <div class="navbar--toggler" id="affanNavbarToggler"><span class="d-block"></span><span class="d-block"></span><span class="d-block"></span></div>
            </div>
            <!-- # Header Five Layout End-->
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
    <div class="page-content-wrapper">
        <!-- Hero Slides-->
        <div class="owl-carousel-one owl-carousel">
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/31.jpg')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="500ms">Clients</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Ready to hire and pay for errands services</p>
                        <a class="btn btn-creative btn-warning" href="clients" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $clients; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/32.jpg')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Freelancers</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Ready and available freelancers to run your errands</p>
                        <a class="btn btn-creative btn-warning" href="freelancers" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $freelancers; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/33.jpg')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Posted Errands</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Readly and available errands services openings.</p>
                        <a class="btn btn-creative btn-warning" href="errands" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $errands; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/1.jpg')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Biddings</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Freelancers are ready to offer services on posted errands.</p>
                        <a class="btn btn-creative btn-warning" href="errands" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $biddings; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('img/bg-img/1.jpg')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Payments</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Freelancers are earning quite alot on this platform, Clients are spending too.</p>
                        <a class="btn btn-creative btn-warning" href="payments" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms">Ksh <?php echo number_format($payments, 2); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-4">
            <div class="container direction-rtl">
                <div class="row g-3">
                    <div class="col-3">
                        <div class="feature-card text-center">
                            <div class="card shadow mx-auto"><img src="img/demo-img/bootstrap.png" alt=""></div>
                            <p class="mb-0">Bootstrap 5</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card shadow mx-auto"><img src="img/demo-img/pwa.png" alt=""></div>
                            <p class="mb-0">PWA ready</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card shadow mx-auto"><img src="img/demo-img/sass.png" alt=""></div>
                            <p class="mb-0">Sass </p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card shadow mx-auto"><img src="img/demo-img/pug.png" alt=""></div>
                            <p class="mb-0">Pug</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card shadow mx-auto"><img src="img/demo-img/npm.png" alt=""></div>
                            <p class="mb-0">npm</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card shadow mx-auto"><img src="img/demo-img/gulp.png" alt=""></div>
                            <p class="mb-0">gulp.js</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card shadow mx-auto"><i class="bi bi-box-arrow-left text-primary"></i></div>
                            <p class="mb-0">RTL ready</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="feature-card mx-auto text-center">
                            <div class="card shadow mx-auto"><i class="bi bi-moon text-dark"></i></div>
                            <p class="mb-0">Dark mode</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-danger mb-3 shadow-sm bg-gradient direction-rtl">
                        <div class="card-body">
                            <h2 class="text-white">Reusable elements</h2>
                            <p class="text-white mb-4">More than 220+ reusable modern design elements. Just copy the code and paste it on your desired page.</p><a class="btn btn-warning" href="elements.html">All elements</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card bg-primary mb-3 shadow-sm bg-gradient direction-rtl">
                        <div class="card-body">
                            <h2 class="text-white">Ready pages</h2>
                            <p class="text-white mb-4">Already designed more than 35+ pages for your needs. Such as - Authentication, Chats, eCommerce, Blog &amp; Miscellaneous pages.</p><a class="btn btn-info" href="pages.html">All pages</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2>Customer Review</h2>
                    <div class="testimonial-slide owl-carousel testimonial-style3">
                        <!-- Single Testimonial Slide-->
                        <div class="single-testimonial-slide">
                            <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
                                <h6 class="mb-2">The code looks clean, and the designs are excellent. I recommend.</h6><span class="d-block">Mrrickez, Themeforest</span>
                            </div>
                        </div>
                        <!-- Single Testimonial Slide-->
                        <div class="single-testimonial-slide">
                            <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
                                <h6 class="mb-2">All complete, <br> great craft.</h6><span class="d-block">Mazatlumm, Themeforest</span>
                            </div>
                        </div>
                        <!-- Single Testimonial Slide-->
                        <div class="single-testimonial-slide">
                            <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
                                <h6 class="mb-2">Awesome template! <br> Excellent support!</h6><span class="d-block">Vguntars, Themeforest</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-3"></div>
    </div>
    <!-- Footer Nav-->
    <?php require_once('../partials/footer_nav.php'); ?>
    <?php require_once('../partials/scripts.php'); ?>
</body>


</html>