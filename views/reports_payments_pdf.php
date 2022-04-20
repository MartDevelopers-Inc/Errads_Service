<?php
session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
check_login();
require_once('../vendor/autoload.php');
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = '<div style="margin:1px; page-break-after: always;">
            <style type="text/css">
                @media print {
                    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
                }
                

                #b_border {
                    border-bottom: dashed thin;
                }


                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                    font-size: 60%;
                }


                .pagenum:before {
                    content: counter(page);
                }

                /* Thick Green border */
                hr {
                    border: 1px solid green dashed;
                }
                
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }

                /* Patient */
                .patient_details{
                    float: left;
                    text-align:left;
                    width:33.33333%;
                }

                /* Doctor */
                .doctor_details{
                    float: right;
                    text-align:right;
                    width:33.33333%;
                }

                /* Appointment Details */
                .appointment_details{
                    float: left;
                    text-align:center;
                    width:33.33333%;
                }

                /* Letter Head */
                .letter_head{
                    color: green; 
                }

                .pagenum:before {
                    content: counter(page);
                }
                .invoice-box {
                    margin: auto;
                    padding: 30px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                    font-size: 16px;
                    line-height: 24px;
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                    color: #000;
                }
                .invoice-box table {
                    width: 100%;
                    line-height: inherit;
                }
                .invoice-box table td {
                    padding: 5px;
                    vertical-align: top;
                }
                
                .invoice-box table tr.top table td {
                    padding-bottom: 20px;
                }
                .invoice-box table tr.top table td.title {
                    font-size: 45px;
                    line-height: 45px;
                    color: #000;
                }
                .invoice-box table tr.information table td {
                    padding-bottom: 40px;
                }
                .invoice-box table tr.heading td {
                    border-bottom: 1px solid #ddd;
                    font-weight: bold;
                }
                .invoice-box table tr.details td {
                    padding-bottom: 20px;
                }
                .invoice-box table tr.item td {
                    border-bottom: 1px solid #000;
                }
                .invoice-box table tr.item.last td {
                    border-bottom: none;
                }
                .invoice-box table tr.total td:nth-child(2) {
                    border-top: 2px;
                    font-weight: bold;
                }
                @media only screen and (max-width: 600px) {
                    .invoice-box table tr.top table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }
                    .invoice-box table tr.information table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }
                }
                /** RTL **/
                .invoice-box.rtl {
                    direction: rtl;
                    font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
                .invoice-box.rtl table {
                    text-align: right;
                }
                .invoice-box.rtl table tr td:nth-child(2) {
                    text-align: left;
                }
                .center {
                    text-align: center;
                }
            </style>
            <div class="pagebreak">
            <div class="footer letter_head list_header">
                <hr>
                <b>iErrands, Payments Reports</b>
            </div>
            <body>
                <h3 class="list_header" align="center">
                    iErrands <br>
                    Posted Errands Reports <br>
                </h3>
                <hr>
                <br>
                <div class="invoice-box">
                    <table border="1" cellspacing="0" width="100%" style="font-size:9pt">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Errand Client</th>
                                <th>Errand Details</th>
                                <th>Bid Details</th>
                                <th>Payment Details</th>
                            </tr>
                        </thead>
                        ';
                        $ret = "SELECT * FROM payments p 
                        INNER JOIN accepted_bids ab ON ab.accepted_bid_id = p.payment_accepted_bid_id 
                        INNER JOIN biddings b ON b.bidding_id = ab.accepted_bid_bidding_id 
                        INNER JOIN errands e ON e.errand_id = b.bidding_errand_id
                        INNER JOIN users u ON u.user_id = e.errand_user_id 
                        INNER JOIN login l ON l.login_id = u.user_login_id ";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        $cnt = 1;
                        while ($users = $res->fetch_object()) {
                            $html .=
                        '
                            <tr>
                                <td width="3%">' . $cnt . '</td>
                                <td width="100%">
                                    <b>Names:</b> ' . $users->user_fname . ' ' . $users->user_fname . ' <br>
                                    <b>Contacts: </b>' . $users->user_contact  . ' <br>
                                    <b>Email:</b> ' . $users->login_email  . '
                                </td>
                                <td width="100%">
                                    <b>Name:</b> ' . $users->errand_name . ' <br>
                                    <b>Details:</b> ' . $users->errand_description  . ' <br>
                                    <b>Budget:</b> Ksh ' . number_format($users->errand_amount)  . ' <br>
                                    <b>Due:</b> ' . date('d M Y', strtotime($users->errand_due_date))  . ' <br>
                                </td> 
                                <td width="100%">
                                    <b>Amount: </b> Ksh ' . number_format($users->bidding_amount) . ' <br>
                                    <b>Bid Date:</b> ' . date('d M Y', strtotime($users->accepted_bid_date))  . ' <br>
                                </td> 
                                <td width="100%">
                                    <b>Payment REF#: </b>' . $users->payment_ref . ' <br>
                                    <b>Amount: </b> Ksh ' . number_format($users->payment_amount) . ' <br>
                                    <b>Payment Date: </b>' . $users->payment_date . ' <br>
                                    <b>Payment Mode:: </b>' . $users->payment_mode . ' <br>
                                </td>
                            </tr>
                        ';
                            $cnt = $cnt + 1;
                        }
                        $html .= '
                    </table>
                </div>
            </body>
        </div>
    </div>';
$dompdf->load_html($html);
$canvas = $dompdf->getCanvas();
$w = $canvas->get_width();
$h = $canvas->get_height();
$imageURL = '../public/img/bg-img/debit-card.png';
$imgWidth = 500;
$imgHeight = 500;
$canvas->set_opacity(.3);
$x = (($w - $imgWidth) / 2);
$y = (($h - $imgHeight) / 2);
$canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight);
$dompdf->render();
$dompdf->stream('Payments', array("Attachment" => 1));
$options = $dompdf->getOptions();
$dompdf->set_paper('A4');
$dompdf->set_option('isHtml5ParserEnabled', true);
$options->setDefaultFont('');
$dompdf->setOptions($options);
