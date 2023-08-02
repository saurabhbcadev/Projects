<?php

date_default_timezone_set("Asia/Kolkata");

require_once('../includes/connect.php');
$sql = "select * from appointment where appno = '$_GET[appno]'";
$appdata = mysqli_query($conn, $sql);
$appdata = mysqli_fetch_assoc($appdata);
$sql = "select name,email,mobile from user where userid = '$appdata[userid]'";
$temp = mysqli_query($conn, $sql);

if (mysqli_num_rows($temp)) {
    $temp = mysqli_fetch_assoc($temp);
    $appdata['name'] = $temp['name'];
    $appdata['mobile'] = $temp['mobile'];
    $appdata['email'] = $temp['email'];
} else {
    $appdata['name'] = '';
    $appdata['mobile'] = '';
    $appdata['email'] = '';
}

mysqli_close($conn);
$ser = explode(", ", $appdata['services']);
$amt = explode(", ", $appdata['amounts']);
$count = count($amt);
$st = $appdata['total_amount'];
$tax = round(($appdata['total_amount'] * 18) / 100);
$gt = round($st + $tax);
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        body {
            position: relative;
            width: 20.7cm;
            height: 31cm;
            margin: 0 auto;
            font-family: century;
            border: 0.05cm solid black;
            padding: 0.25cm 0.5cm;
        }

        header {
            margin-bottom: 0.5cm;
            padding-bottom: 0.1cm;
            border-bottom: 0.05cm solid;
        }

        #logo {
            float: left;
        }

        #logo img {
            height: 3.5cm;
        }

        #company {
            float: right;
            text-align: right;
        }

        #details {
            margin-bottom: 0.1cm;
        }

        #client {
            padding-left: 0.15cm;
            border-left: 0.15cm solid #0087C3;
            float: left;
        }

        h1.name {
            font-size: 1.25cm;
            font-weight: bold;
            margin: 0;
        }

        #invoice {
            float: right;
            padding-right: 0.15cm;
            border-right: 0.15cm solid #0087C3;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            text-align: center;
        }

        table thead {
            border-bottom: 0.075cm solid black;
            border-top: 0.075cm solid black;
        }

        table td,
        th {
            font-size: 0.6cm;
        }

        td,
        th {
            padding: 0.1cm 0;
        }

        table tfoot td {
            font-size: 0.6cm;
            font-weight: 600;
            border-top: 0.075cm solid black;
        }

        #thanks {
            font-size: 0.75cm;
            margin: 1cm 0 2cm 0;
            text-align: center;
            color: #f35a31;
            text-transform: capitalize;
            font-weight: 600;
            text-decoration: underline;
        }

        #notices {
            padding-left: 0.15cm;
            border-left: 0.15cm solid #0087C3;
            font-size: 0.6cm;
        }

        footer {
            font-size: 0.5cm;
            color: red;
            position: absolute;
            bottom: 0;
            border-top: 0.05cm solid red;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div id="invoice-container">
        <header class="clearfix">
            <div id="logo">
                <img src="../image/logo.webp">
            </div>
            <div id="company">
                <h1 class="name" style="color:blue">New Look Beauty Parlour</h1>
                <h1 style='margin: 0.05cm 0;color:crimson'>Kumar Chowk, Dumra, Sitamarhi</h1>
                <div style="display: flex;">
                    <div style="padding: 0.2cm 1.5cm 0.2cm 2cm;color:purple">Mob: 8825288200</div>
                    <div style="padding: 0.2cm 0cm 0.15cm 2cm;color:purple">Email: newlookstm@gmail.com</div>
                </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                    <div class="to">INVOICE TO:</div>
                    <h2 style="margin: 0.1cm 0; color: orangered"><?php echo $appdata['name'] ?></h2>
                    <p style="margin:0.1cm 0">Email:- <?php echo $appdata['email'] ?></p>
                    <p style="margin:0.1cm 0">Mobile:- <?php echo $appdata['mobile'] ?></p>
                </div>
                <div id="invoice">
                    <div class="to">INVOICE DETAILS:</div>
                    <h2 style="margin: 0.1cm 0; color: deeppink">Invoice No. - <?php echo $appdata['id'] ?></h2>
                    <p style="margin:0.1cm 0">Date of Invoice: <?php echo date('d/m/Y') ?></p>
                    <p style="margin:0.1cm 0">Time of Invoice: <?php echo date('h:i:s A') ?></p>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between; color:brown;">
                <p>Appointment No:- <?php echo $appdata['appno'] ?></p>
                <p>Appointment Date: <?php echo date('d/m/Y', strtotime($appdata['date'])) ?></p>
                <p>Appointment Time: <?php echo date('h:i A', strtotime($appdata['time'])) ?></p>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>S. No</th>
                        <th>Services</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($i < $count) { ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td><?php echo $ser[$i]; ?></td>
                            <td>&#8377; <?php echo $amt[$i]; ?></td>
                        </tr>
                    <?php $i = $i + 1;
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>Subtotal</td>
                        <td>&#8377; <?php echo $st ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Tax 18%</td>
                        <td>&#8377; <?php echo $tax ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style='font-size:0.75cm;color:green;'>Grand Total</td>
                        <td style='font-size:0.75cm;color:green;'>&#8377; <?php echo $gt ?></td>
                    </tr>
                </tfoot>
            </table>
            <div id="thanks">Thank you for visiting! We hope to see you again soon. </div>
            <div id="notices">Authorized Signature:-</div>
        </main>
        <footer>NOTE: Invoice was created on a computer and is only valid with the Authorized Signature.</footer>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.onafterprint = function() {
                history.back();
            };
            window.print();
        });
    </script>
</body>

</html>