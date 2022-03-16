<?php
/*
 * Created on Mon Jul 26 2021
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


/* Freelancers */
$query = "SELECT COUNT(*)  FROM users u 
INNER JOIN login l ON l.login_id = u.user_login_id
WHERE login_rank = 'Freelancer' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($Freelancers);
$stmt->fetch();
$stmt->close();


/* CLients */
$query = "SELECT COUNT(*)  FROM users u 
INNER JOIN login l ON l.login_id = u.user_login_id
WHERE login_rank = 'Client' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($Clients);
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
