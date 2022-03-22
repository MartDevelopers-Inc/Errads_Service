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
                        <a class="btn btn-creative btn-warning" href="" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $clients; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('../public/img/bg-img/errands.jpg')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">Posted Errands</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Openings for errands services that are both readily accessible and readily available.</p>
                        <a class="btn btn-creative btn-warning" href="freelancer_errands" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $errands; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('../public/img/bg-img/biddings.jpg')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">My Biddings</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">Freelancers are eager to help with the tasks that have been placed.</p>
                        <a class="btn btn-creative btn-warning" href="freelancer_biddings" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms"><?php echo $biddings; ?></a>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide-->
            <div class="single-hero-slide bg-overlay" style="background-image: url('../public/img/bg-img/payments.webp')">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">My Payments</h4>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">On this platform, freelancers make a lot of money, and clients spend a lot of money as well.</p>
                        <a class="btn btn-creative btn-warning" href="freelancer_payments" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms">Ksh <?php echo number_format($payments, 2); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2>Recent Posted Errands Services</h2>
                    <hr>
                    <div class="testimonial-slide owl-carousel testimonial-style3">
                        <?php
                        $ret = "SELECT * FROM errands e
                        INNER JOIN users u ON u.user_id = e.errand_user_id 
                        ORDER BY errand_due_date DESC LIMIT 10";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        while ($errands = $res->fetch_object()) {
                            /* Count Available bids to this errand */
                            $errand_id = $errands->errand_id;
                            $query = "SELECT COUNT(*)  FROM biddings WHERE bidding_errand_id  = '$errand_id'";
                            $stmt = $mysqli->prepare($query);
                            $stmt->execute();
                            $stmt->bind_result($biddings);
                            $stmt->fetch();
                            $stmt->close();
                        ?>
                            <div class="single-testimonial-slide">
                                <a href="freelancer_errand_detail?view=<?php echo $errand_id; ?>">
                                    <div class="text-content">
                                        <h6 class="mb-2"><?php echo $errands->errand_name; ?></h6>
                                        <p class="">
                                            <?php echo substr($errands->errand_description, 0, 100); ?>... <br>
                                            <span class="text-success">
                                                Amount: Ksh <?php echo number_format($errands->errand_amount); ?><br>
                                                Due Date: <?php echo date('d M Y', strtotime($errands->errand_due_date)); ?><br>
                                                Bids: <?php echo $biddings; ?>
                                            </span>
                                        </p>
                                        <figcaption class="blockquote-footer">
                                            Posted By <cite title="Source Title"><?php echo $errands->user_fname . ' ' . $errands->user_lname; ?></cite>
                                        </figcaption>
                                    </div>
                                </a>
                            </div>
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