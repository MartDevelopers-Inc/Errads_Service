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
/* Add Errand Bid */
if (isset($_POST['add_bid'])) {
    $bidding_id = $sys_gen_id;
    $bidding_errand_id = $_GET['view'];
    $bidding_user_id = $_SESSION['user_id'];
    $bidding_description = $_POST['bidding_description'];
    $bidding_amount = $_POST['bidding_amount'];

    /* Add Bidding */
    $sql = "INSERT INTO biddings (bidding_id, bidding_errand_id, bidding_user_id, bidding_description, bidding_amount) VALUES(?,?,?,?,?)";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'sssss',
        $bidding_id,
        $bidding_errand_id,
        $bidding_user_id,
        $bidding_description,
        $bidding_amount
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Bidding Posted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Update Errand */
if (isset($_POST['update_errand'])) {
    $errand_id = $_GET['view'];
    $errand_name = $_POST['errand_name'];
    $errand_description = $_POST['errand_description'];
    $errand_amount = $_POST['errand_amount'];
    $errand_due_date  = $_POST['errand_due_date'];
    /* Update */
    $sql = "UPDATE errands SET errand_name =?, errand_description =?, errand_amount =?, errand_due_date =? WHERE errand_id =?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'sssss',
        $errand_name,
        $errand_description,
        $errand_amount,
        $errand_due_date,
        $errand_id
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Errand Record Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Delete Errand */
if (isset($_POST['delete'])) {
    $errand_id = $_POST['errand_id'];
    /* Delete */
    $sql = "DELETE FROM errands WHERE errand_id = ?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param('s', $errand_id);
    $prepare->execute();
    if ($prepare) {
        $_SESSION['success'] = 'Errand Deleted';
        header("location:errands");
        exit;
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Accept Bidding */
if (isset($_POST['accept_bid'])) {
    $accepted_bid_id = $sys_gen_id;
    $accepted_bid_bidding_id = $_POST['accepted_bid_bidding_id'];
    $accepted_bid_date = date('d M Y');

    /* Persist */
    $sql = "INSERT INTO accepted_bids(accepted_bid_id, accepted_bid_bidding_id, accepted_bid_date) VALUES(?,?,?)";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'sss',
        $accepted_bid_id,
        $accepted_bid_bidding_id,
        $accepted_bid_date
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Bid Accepted";
    } else {
        $err  = "Failed!, Please Try Again";
    }
}

/* Delete Bidding */
if (isset($_POST['delete_bidding'])) {
    $bidding_id = $_POST['bidding_id'];

    /* Delete */
    $sql = "DELETE FROM biddings WHERE bidding_id = '$bidding_id'";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    if ($prepare) {
        $success = "Bid Deleted";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Update Delete */
if (isset($_POST['update_bid'])) {
    $bidding_id = $_POST['bidding_id'];
    $bidding_description = $_POST['bidding_description'];
    $bidding_amount = $_POST['bidding_amount'];

    /* Update */
    $sql = "UPDATE biddings SET bidding_description =?,  bidding_amount =? WHERE bidding_id = ?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'sss',
        $bidding_description,
        $bidding_amount,
        $bidding_id
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Bid Updated";
    } else {
        $err = "Failed!, Please Try Again";
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
    <!-- Header Area-->
    <div class="header-area" id="headerArea">
        <div class="container">
            <!-- Header Content-->
            <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
                <!-- Back Button-->
                <div class="back-button">
                    <a href="errands">
                        <svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </a>
                </div>
                <!-- Page Title-->
                <div class="page-heading">
                    <h6 class="mb-0">Bids And Errand Details</h6>
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
    <!-- Side Nav Wrapper-->
    <?php require_once('../partials/side_nav.php'); ?>
    <br>
    <br>
    <div class="py-3">
        <div class="container">
            <?php
            $user_id = $_SESSION['user_id'];
            $ret = "SELECT * FROM biddings b 
            INNER JOIN users u ON b.bidding_user_id = u.user_id 
            INNER JOIN errands e ON e.errand_id = b.bidding_errand_id
            WHERE u.user_id = '$user_id'  ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($biddings = $res->fetch_object()) {
            ?>
                <ul class="ps-0 chat-user-list">
                    <li class="p-3 chat-unread">
                        <div class="text-content">
                            <h5 class="text-center">Bid Details</h5>
                            <p class="">
                                <?php echo $biddings->bidding_description; ?><br>
                                <span class="text-success">
                                    Bidding Amount: Ksh <?php echo number_format($biddings->bidding_amount); ?><br>
                                </span>
                            </p>
                            <br>
                            <figcaption class="blockquote-footer">
                                Bid By <cite title="Source Title"><?php echo $biddings->user_fname . ' ' . $biddings->user_lname; ?></cite>
                            </figcaption>
                            <hr>
                            <h5 class="text-center">Errand Details</h5>
                            <h5><?php echo $biddings->errand_name; ?> </h5>
                            <p><?php echo $biddings->errand_description; ?></p><br>
                            <figcaption class="blockquote-footer">
                                Posted By <cite title="Source Title"><?php echo $biddings->user_fname . ' ' . $biddings->user_lname; ?></cite>
                            </figcaption>
                            <p>
                                <span class="text-success">
                                    Amount: Ksh <?php echo number_format($biddings->errand_amount); ?><br>
                                    Due Date: <?php echo date('d M Y', strtotime($biddings->errand_due_date)); ?><br>
                                </span>
                            </p>
                            <div class="text-center">
                                <?php
                                /* You can delete and update your own bids */
                                if ($_SESSION['user_id'] == ($biddings->bidding_user_id)) { ?>
                                    <button class="btn btn-round btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#update_bid_<?php echo $biddings->bidding_id; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                        Edit Bid
                                    </button>
                                    <button class="btn btn-round btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete_bid_<?php echo $biddings->bidding_id; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                        Delete Bid
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                </ul>
                <br>
                <!-- Update Bidding Details Modal -->
                <div class="modal fade" id="update_bid_<?php echo $biddings->bidding_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel">Update Bidding</h6>
                                <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" role="form">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Amount (Ksh)</label>
                                            <input type="hidden" value="<?php echo $biddings->bidding_id; ?>" required name="bidding_id" class="form-control">
                                            <input type="number" value="<?php echo $biddings->bidding_amount; ?>" required name="bidding_amount" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Bidding Description</label>
                                            <textarea type="text" required name="bidding_description" class="form-control"><?php echo $biddings->bidding_description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" name="update_bid" class="btn btn-warning">Update Bid</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <!-- Delete Bidding -->
                <div class="modal fade" id="delete_bid_<?php echo $biddings->bidding_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body text-center text-danger">
                                    <h4>Delete This Bidding?</h4>
                                    <br>
                                    <!-- Hide This -->
                                    <input type="hidden" name="bidding_id" value="<?php echo $biddings->bidding_id; ?>">
                                    <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                                    <input type="submit" name="delete_bidding" value="Delete" class="text-center btn btn-danger">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Delete -->
            <?php
            } ?>
            <br><br><br>
        </div>
    </div>
    <!-- Footer Nav-->
    <?php require_once('../partials/footer_nav.php'); ?>
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>