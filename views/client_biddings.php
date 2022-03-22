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
require_once('../config/codeGen.php');
check_login();
/* Add Payments */
if (isset($_POST['add_payment'])) {
    $payment_id = $sys_gen_id;
    $payment_amount = $_POST['payment_amount'];
    $payment_date = $_POST['payment_date'];
    $payment_ref = $sys_gen_paycode;
    $payment_mode = $_POST['payment_mode'];
    $payment_accepted_bid_id = $_POST['payment_accepted_bid_id'];

    /* Persist */
    $sql = "INSERT INTO payments (payment_id, payment_amount, payment_date, payment_ref, payment_mode, payment_accepted_bid_id)
    VALUES(?,?,?,?,?,?)";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ssssss',
        $payment_id,
        $payment_amount,
        $payment_date,
        $payment_ref,
        $payment_mode,
        $payment_accepted_bid_id
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Payment REF: $payment_ref, Posted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}
require_once('../partials/head.php');
?>

<body class="pe-0">
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
                    <a href="client_errands">
                        <svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </a>
                </div>
                <!-- Page Title-->
                <div class="page-heading">
                    <h6 class="mb-0">Accepted Errands Bids</h6>
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
    <br>
    <br>
    <div class="py-3">
        <!-- Add New Staff-->
        <div class="container">
            <!-- Element Heading-->
            <div class="element-heading">
            </div>
            <!-- Chat User List-->
            <?php
            $user_id = $_SESSION['user_id'];
            $ret = "SELECT * FROM accepted_bids ab
            INNER JOIN biddings b  ON ab.accepted_bid_bidding_id = b.bidding_id
            INNER JOIN users u ON b.bidding_user_id = u.user_id 
            INNER JOIN errands e ON e.errand_id = b.bidding_errand_id
            WHERE e.errand_user_id = '$user_id'";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($biddings = $res->fetch_object()) {
            ?>
                <ul class="ps-0 chat-user-list">
                    <li class="p-3 chat-unread">
                        <div class="text-content">
                            <h5><?php echo $biddings->errand_name; ?> </h5>
                            <p><?php echo $biddings->errand_description; ?></p><br>
                            <p>
                                <span class="text-success">
                                    Amount: Ksh <?php echo number_format($biddings->errand_amount); ?><br>
                                    Due Date: <?php echo date('d M Y', strtotime($biddings->errand_due_date)); ?><br>
                                </span>
                            </p>
                            <hr>
                            <h5>Accepted Bid Details </h5>
                            <p class="">
                                <?php echo $biddings->bidding_description; ?> <br>
                                <span class="text-success">
                                    Amount: Ksh <?php echo number_format($biddings->bidding_amount); ?><br>
                                    Bid Date: <?php echo date('d M Y', strtotime($biddings->accepted_bid_date)); ?><br>
                                </span>
                            </p>
                            <br>
                            <figcaption class="blockquote-footer">
                                Bid By <cite title="Source Title"><?php echo $biddings->user_fname . ' ' . $biddings->user_lname; ?></cite>
                            </figcaption>
                            <?php
                            $query = "SELECT COUNT(*)  FROM payments WHERE payment_accepted_bid_id = '$biddings->accepted_bid_id'";
                            $stmt = $mysqli->prepare($query);
                            $stmt->execute();
                            $stmt->bind_result($paid_bidding);
                            $stmt->fetch();
                            $stmt->close();
                            if ($paid_bidding > 0) {
                            ?>
                                <div class="text-center">
                                    <button class="btn btn-round btn-success" type="button">
                                        Already Paid
                                    </button>
                                </div>
                            <?php } else { ?>
                                <div class="text-center">
                                    <button class="btn btn-round btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#pay_<?php echo $biddings->accepted_bid_id; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                        Pay Bid
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
                <br><br>
                <!-- Add Payment -->
                <div class="modal fade" id="pay_<?php echo $biddings->accepted_bid_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel">Pay Errand: <?php echo $biddings->errand_name; ?></h6>
                                <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" role="form">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Payment Amount</label>
                                            <input type="text" readonly value="<?php echo $biddings->bidding_amount; ?>" required name="payment_amount" class="form-control">
                                            <input type="hidden" readonly value="<?php echo $biddings->accepted_bid_id; ?>" required name="payment_accepted_bid_id" class="form-control">
                                            <input type="hidden" readonly value="<?php echo date('d M Y'); ?>" required name="payment_date" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Payment Mode</label>
                                            <select class="form-control" type="text" name="payment_mode" value="">
                                                <option>MPESA</option>
                                                <option>Debit / Credit Card</option>
                                                <option>Cash</option>
                                                <option>Bank Deposit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" name="add_payment" class="btn btn-warning">Add Payment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
            <br><br>
        </div>
    </div>
    <!-- Footer Nav-->
    <?php require_once('../partials/footer_nav.php'); ?>
    <!-- All JavaScript Files-->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>