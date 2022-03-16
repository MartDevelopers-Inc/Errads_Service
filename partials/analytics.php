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

/* Sessions */
$login_id = $_SESSION['login_id'];
$user_access_level = $_SESSION['login_rank'];

if ($user_access_level == 'Administrator') {
    /* Load Admin Analytics */

    /* Freelancers */
    $query = "SELECT COUNT(*)  FROM users u 
    INNER JOIN login l ON l.login_id = u.user_login_id
    WHERE login_rank = 'Freelancer' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($freelancers);
    $stmt->fetch();
    $stmt->close();


    /* CLients */
    $query = "SELECT COUNT(*)  FROM users u 
    INNER JOIN login l ON l.login_id = u.user_login_id
    WHERE login_rank = 'Client' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($clients);
    $stmt->fetch();
    $stmt->close();

    /* Posted Errands */
    $query = "SELECT COUNT(*)  FROM errands";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($errands);
    $stmt->fetch();
    $stmt->close();

    /* Biddings */
    $query = "SELECT COUNT(*)  FROM biddings";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($biddings);
    $stmt->fetch();
    $stmt->close();

    /* Total Amount Spent */
    $query = "SELECT SUM(payment_amount)  FROM payments";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($payments);
    $stmt->fetch();
    $stmt->close();
} else if ($user_access_level == 'Client') {
    /* Client  Analytics */
    $ret = "SELECT * FROM users WHERE user_login_id = '$login_id'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($client = $res->fetch_object()) {
        $client_id = $client_user_id;
        /* Freelancers */
        $query = "SELECT COUNT(*)  FROM users u 
        INNER JOIN login l ON l.login_id = u.user_login_id
        WHERE login_rank = 'Freelancer' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($freelancers);
        $stmt->fetch();
        $stmt->close();

        /* Posted Errands */
        $query = "SELECT COUNT(*)  FROM errands WHERE errand_user_id = '$client_id' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($errands);
        $stmt->fetch();
        $stmt->close();


        /* My Expenditure  */
        $query = "SELECT SUM(payment_amount)  FROM payments p
        INNER JOIN accepted_bids ab ON ab.accepted_bid_id = p.payment_accepted_bid_id
        INNER JOIN biddings b ON b.bidding_id = ab.accepted_bid_bidding_id 
        WHERE b.bidding_errand_id = '$client_id' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($payments);
        $stmt->fetch();
        $stmt->close();
    }
} else {
    /* Freelancer Analytics */
    $ret = "SELECT * FROM users WHERE user_login_id = '$login_id'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($freelancer = $res->fetch_object()) {
        $freelancer_id = $freelancer->user_id;
        /* Client Analytics */
        $query = "SELECT COUNT(*)  FROM users u 
        INNER JOIN login l ON l.login_id = u.user_login_id
        WHERE login_rank = 'Client' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($clients);
        $stmt->fetch();
        $stmt->close();

        /* Posted Errands */
        $query = "SELECT COUNT(*)  FROM errands";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($errands);
        $stmt->fetch();
        $stmt->close();


        /* My Biddings */
        $query = "SELECT COUNT(*)  FROM biddings WHERE bidding_user_id = '$freelancer_id'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($biddings);
        $stmt->fetch();
        $stmt->close();

        /* My Accepted Biddings */
        $query = "SELECT COUNT(*)  FROM accepted_bids ab 
        INNER JOIN biddings b ON b.bidding_id = ab.accepted_bid_id
        WHERE b.bidding_user_id = '$freelancer_id'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($accepted_biddings);
        $stmt->fetch();
        $stmt->close();

        /* Payments */
        $query = "SELECT SUM(payment_amount)  FROM payments p
        INNER JOIN accepted_bids ab ON ab.accepted_bid_id = p.payment_accepted_bid_id
        INNER JOIN biddings b ON b.bidding_id = ab.accepted_bid_bidding_id 
        WHERE b.bidding_user_id = '$client_id' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($payments);
        $stmt->fetch();
        $stmt->close();
    }
}
