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
    <?php require_once('../partials/header.php'); ?>
    <!-- Sidenav Black Overlay-->
    <div class="sidenav-black-overlay"></div>
    <!-- Side Nav Wrapper-->
    <?php require_once('../partials/side_nav.php'); ?>
    <div class="page-content-wrapper">
        <!-- Hero Slides-->
        <div class="owl-carousel-one owl-carousel">
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('../public/img/bg-img/clients.webp')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="500ms">Clients</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Prepared to employ and pay for errand-running services.</p>
                        <a class="btn btn-creative btn-warning" href="clients" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $clients; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('../public/img/bg-img/freelancers.webp')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Freelancers</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Freelancers that are ready and waiting to conduct your errands.</p>
                        <a class="btn btn-creative btn-warning" href="freelancers" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $freelancers; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('../public/img/bg-img/errands.jpg')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Posted Errands</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Openings for errands services that are both readily accessible and readily available.</p>
                        <a class="btn btn-creative btn-warning" href="errands" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $errands; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('../public/img/bg-img/biddings.jpg')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Biddings</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Freelancers are eager to help with the tasks that have been placed.</p>
                        <a class="btn btn-creative btn-warning" href="errands" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $biddings; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('../public/img/bg-img/payments.webp')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Payments</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">On this platform, freelancers make a lot of money, and clients spend a lot of money as well.</p>
                        <a class="btn btn-creative btn-warning" href="payments" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms">Ksh <?php echo number_format($payments, 2); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2>Recent Posted Errands Services</h2>
                    <div class="testimonial-slide owl-carousel testimonial-style3">
                        <!-- Single Testimonial Slide-->
                        <div class="single-testimonial-slide">
                            <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
                                <h6 class="mb-2">The code looks clean, and the designs are excellent. I recommend.</h6><span class="d-block">Mrrickez, Themeforest</span>
                            </div>
                        </div>
                        <div class="single-testimonial-slide">
                            <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
                                <h6 class="mb-2">The code looks clean, and the designs are excellent. I recommend.</h6><span class="d-block">Mrrickez, Themeforest</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Recent Joined Clients</h4>
                    <div class="testimonial-slide owl-carousel testimonial-style3">
                        <?php
                        $ret = "SELECT * FROM users u
                        INNER JOIN login l ON l.login_id = u.user_login_id
                        WHERE l.login_rank = 'Client'
                        ORDER BY RAND() ASC LIMIT 10   ";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        while ($clients = $res->fetch_object()) {
                        ?>
                            <a href="clients?view=<?php echo $clients->user_id; ?>">
                                <div class="single-testimonial-slide">
                                    <div class="text-content">
                                        <div class="col-12">
                                            <div class="card team-member-card shadow">
                                                <div class="card-body">
                                                    <!-- Member Image-->
                                                    <div class="team-member-img shadow-sm"><img src="../public/img/bg-img/profile.svg" alt=""></div>
                                                    <!-- Team Info-->
                                                    <div class="team-info">
                                                        <h6 class="mb-0"><?php echo $clients->user_fname . ' ' . $clients->user_lname; ?></h6>
                                                        <p class="mb-0">Gender: <?php echo $clients->user_gender; ?></p>
                                                        <p class="mb-0">Contacts: <?php echo $clients->user_contact; ?></p>
                                                        <p class="mb-0">Email: <?php echo $clients->login_email; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-3"></div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Available Freelancers</h4>
                    <div class="testimonial-slide owl-carousel testimonial-style3">
                        <?php
                        $ret = "SELECT * FROM users u
                        INNER JOIN login l ON l.login_id = u.user_login_id
                        WHERE l.login_rank = 'Freelancer'
                        ORDER BY RAND() ASC LIMIT 10   ";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        while ($clients = $res->fetch_object()) {
                        ?>
                            <a href="freelancers?view=<?php echo $clients->user_id; ?>">
                                <div class="single-testimonial-slide">
                                    <div class="text-content">
                                        <div class="col-12">
                                            <div class="card team-member-card shadow">
                                                <div class="card-body">
                                                    <!-- Member Image-->
                                                    <div class="team-member-img shadow-sm"><img src="../public/img/bg-img/profile.svg" alt=""></div>
                                                    <!-- Team Info-->
                                                    <div class="team-info">
                                                        <h6 class="mb-0"><?php echo $clients->user_fname . ' ' . $clients->user_lname; ?></h6>
                                                        <p class="mb-0">Gender: <?php echo $clients->user_gender; ?></p>
                                                        <p class="mb-0">Contacts: <?php echo $clients->user_contact; ?></p>
                                                        <p class="mb-0">Email: <?php echo $clients->login_email; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
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