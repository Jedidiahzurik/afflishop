<?php
$ref = "";
$Errorx = "";
$SESSION['Error'] = "";
$Subctt = 0;
function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  $data = addslashes($data);
	  return $data;
	}

    $from_name = "You";
    $chain_plan = "";
    $email = $_SESSION['customer']['cust_email'];
    $amount_paid = $int;
   // $required_amount = $_SESSION['t_f_check_out'];
    $senders_addr = $payfrom;
    $gfirstname = $_SESSION['customer']['cust_name'];
    $receiver_addr = "Afflishop.com";
function if_pay_r_den_mail($gfirstname,$from_name,$email,$chain_plan,$amount_paid,$required_amount,$senders_addr,$receiver_addr){
    
    // $from_name = "";
    // $email ="";
    // $chain_plan ="";
    // $amount_paid = "";
    // $required_amount = "";
    // $senders_addr ="";
    // $receiver_addr = "";
    if (true) {
    //mail to user
    $from = "Afflishop <no-reply@afflishop.com>" . "\r\n";
	$to = $email;
	$subject = "Payment received from ".$from_name." | afflishop";
		$message = '
<html>
<body style="background-color: #fff; margin: 0; padding: 0px; -webkit-text-size-adjust: none; text-size-adjust: none;">
<style>
		* {
			box-sizing: border-box;
		}

		th.column {
			padding: 0
		}

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: inherit !important;
		}

		#MessageViewBody a {
			color: inherit;
			text-decoration: none;
		}

		p {
			line-height: inherit
		}

		@media (max-width:520px) {
			.icons-inner {
				text-align: center;
			}

			.icons-inner td {
				margin: 0 auto;
			}

			.row-content {
				width: 100% !important;
			}

			.stack .column {
				width: 100%;
				display: block;
			}
		}
	</style>
<div style="background:black; padding:4px;">

<div style="background:grey; padding:2px;">
<div style="background:; padding:0px;">

<table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; background-color: black;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="500">
<tbody>
<tr>
<th class="column" style="mso-table-lspace: 0; mso-table-rspace: 0; font-weight: 400; text-align: left; vertical-align: top;" width="100%">
<table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tr>
<td style="width:100%;padding-right:0px;padding-left:0px;padding-top:5px;">
<div align="center" style="line-height:10px"><img src="https://afflishop.com/assets/images/logo/logo.png" style="border-radius:50%;display: block; height: 250px; border: 0; width: 300px; max-width: 100%;" width="100"/></div>
</td>
</tr>
</table>
<br>
<table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tr>
<td style="width:100%;text-align:center;">
<h1 style="margin: 0; color: white; font-size: 23px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: normal; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><strong>Afflishop</strong></h1>
</td>
</tr>
</table>
<br>
<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
<tr>
<td style="padding-top:10px;padding-right:10px;padding-bottom:15px;padding-left:10px;">
<div style="font-family: sans-serif">
<div style="font-size: 14px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
</div>
</div>
</td>
</tr>
</table>
<table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
<tr>
<td>
<div style="font-family: sans-serif">
<div style="font-size: 14px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<p style="color:white;margin: 0; font-size: 14px;">Hi <b>'.$gfirstname.'</b> <br>
<br>'.$from_name.' just paid in $'.$amount_paid.'. <br>
Here are the details:
<br>
<br>
<b>Required Amount / Item Worth : </b>$'.$required_amount.'<br> 
<b>Sender\'s USDT Wallet Address : </b>'.$senders_addr.'<br>
<b>Receiver\'s USDT Wallet Address : </b>'.$receiver_addr.'<br>
<b>Amount Paid : </b>$'.$amount_paid.'<br>
<br>
<br>Login now to see your Order!<br/>
</p>
</div>
</div>
</td>
</tr>
</table>
<table border="0" cellpadding="10" cellspacing="0" class="button_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tr>
<td>
<center>
<div align="center">
<a href="https://afflishop.com/login.php"><div style="color:white;text-decoration:none;display:inline-block;color:#ffffff; background-color: linear-gradient(to right, #0000ff 0%, #003300 100%);border-radius:4px;width:auto;border-top:1px solid #3AAEE0;border-right:1px solid #3AAEE0;border-bottom:1px solid #3AAEE0;border-left:1px solid #3AAEE0;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; line-height: 2; mso-line-height-alt: 32px;"><b>Login now</b></span></span></div></a>
<p>- Or copy -</p>
<p>https://afflishop.com/login.php</p>
</div>
<center>
</td>
</tr>
</table>
<table border="0" cellpadding="10" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tr>
<td>
<div align="center">
<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tr>
<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #BBBBBB;"><span></span></td>
</tr>
</table>
</div>
</td>
</tr>
</table>
<table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
<tr>
<td>
<div style="font-family: sans-serif">
<div style="font-size: 14px; color: white; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<p style="margin: 0; font-size: 14px;">Please ensure to always protect your details and reach support anytime you are stucked. For help, just reply to this email—we are always happy to help out.



<br><br>The Support Team,
<br>Afflishop.</p>
</div>
</div>
</td>
</tr>
</table>
<br><br>
<table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tr>
<td style="width:100%;padding-right:0px;padding-left:0px;"><center>
<div align="center" style="line-height:10px"><img src="https://afflishop.com/assets/images/logo/logo.png" style="display: block; height: auto; border: 0; width: 100px; max-width: 100%;" width="100"/></div>
</center>

</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
<tr>
<td style="padding-top:10px;padding-right:10px;padding-bottom:15px;padding-left:10px;">
<div style="font-family: sans-serif">
<div style="font-size: 14px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<p style="margin: 0; font-size: 14px; text-align: center;">afflishop.com</p>
</div>
</div>
</td>
</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
<tr>
<td style="padding-top:10px;padding-right:10px;padding-bottom:15px;padding-left:10px;">
<div style="font-family: sans-serif">
<div style="text-align:center;font-size: 14px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<center><p style="max-width:250px;margin: 0; font-size: 14px;text-align:center;">
You are receiving this email because your registered address under this email in the afflishop system received payment.
<br><br>
<p style="color:green;">
Copyright (c) 2022 afflishop.com 
</p>
</p></center>
</div>
</div>
</td>
</tr>
</table>
</th>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="500">
<tbody>
<tr>
<th class="column" style="mso-table-lspace: 0; mso-table-rspace: 0; font-weight: 400; text-align: left; vertical-align: top;" width="100%">
<table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tr>
<td style="color:#9d9d9d;font-family:inherit;font-size:15px;padding-bottom:10px;padding-top:10px;text-align:center;">
<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
<tr>
<td style="text-align:center;">

</td>
</tr>
</table>
</td>
</tr>
</table>
</th>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table><!-- End -->
</div>
</div>
</div>
</body>
</html>			
			';
			$message = wordwrap($message, 70, "\r\n");
			$headers = "From:" . $from;
			$headers .= "Return-Path: no-reply@afflishop.com" . "\r\n";
			$headers .= "BCC: system@afflishop.com" . "\r\n";
			$headers .= "Organization: afflishop" . "\r\n";
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
			$returnpath = '-f no-reply@afflishop.org';
		
			if(@mail($to, $subject, $message, $headers, $returnpath)){
			    
			}

   
            }
}
// function if_pay_w_den_mail($gfirstname,$from_name,$email,$chain_plan,$amount_paid,$required_amount,$senders_addr,$receiver_addr){
   
//     // $gfirstname = "";
//     // $from_name = "";
//     // $email ="";
//     // $chain_plan ="";
//     // $amount_paid = "";
//     // $required_amount = "";
//     // $senders_addr ="";
//     // $receiver_addr = "";
//     if (true) {
//     //mail to user
//     $from = "InfluxChain <no-reply@afflishop.com>" . "\r\n";
// 	$to = $email;
// 	$subject = "Payment received from ".$from_name." | afflishop";
// 		$message = '
// <html>
// <body style="background-color: #fff; margin: 0; padding: 0px; -webkit-text-size-adjust: none; text-size-adjust: none;">
// <style>
// 		* {
// 			box-sizing: border-box;
// 		}

// 		th.column {
// 			padding: 0
// 		}

// 		a[x-apple-data-detectors] {
// 			color: inherit !important;
// 			text-decoration: inherit !important;
// 		}

// 		#MessageViewBody a {
// 			color: inherit;
// 			text-decoration: none;
// 		}

// 		p {
// 			line-height: inherit
// 		}

// 		@media (max-width:520px) {
// 			.icons-inner {
// 				text-align: center;
// 			}

// 			.icons-inner td {
// 				margin: 0 auto;
// 			}

// 			.row-content {
// 				width: 100% !important;
// 			}

// 			.stack .column {
// 				width: 100%;
// 				display: block;
// 			}
// 		}
// 	</style>
// <div style="background:black; padding:4px;">

// <div style="background:grey; padding:2px;">
// <div style="background:; padding:0px;">

// <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; background-color: black;" width="100%">
// <tbody>
// <tr>
// <td>
// <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tbody>
// <tr>
// <td>
// <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="500">
// <tbody>
// <tr>
// <th class="column" style="mso-table-lspace: 0; mso-table-rspace: 0; font-weight: 400; text-align: left; vertical-align: top;" width="100%">
// <table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tr>
// <td style="width:100%;padding-right:0px;padding-left:0px;padding-top:5px;">
// <div align="center" style="line-height:10px"><img src="https://influxchain.com/cpp.webp" style="border-radius:50%;display: block; height: 250px; border: 0; width: 300px; max-width: 100%;" width="100"/></div>
// </td>
// </tr>
// </table>
// <br>
// <table border="0" cellpadding="0" cellspacing="0" class="heading_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tr>
// <td style="width:100%;text-align:center;">
// <h1 style="margin: 0; color: white; font-size: 23px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: normal; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><strong>InfluxChain</strong></h1>
// </td>
// </tr>
// </table>
// <br>
// <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
// <tr>
// <td style="padding-top:10px;padding-right:10px;padding-bottom:15px;padding-left:10px;">
// <div style="font-family: sans-serif">
// <div style="font-size: 14px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
// </div>
// </div>
// </td>
// </tr>
// </table>
// <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
// <tr>
// <td>
// <div style="font-family: sans-serif">
// <div style="font-size: 14px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
// <p style="color:white;margin: 0; font-size: 14px;">Hi <b>'.$gfirstname.'</b> <br>
// <br>'.$from_name.' just paid in $'.$amount_paid.'. However they paid below the required plan worth of $'.$required_amount.'. <br>
// In the light of this, we hope you refund the money back as the system do not manage user funds in any way.
// Here are the details:
// <br>
// <br>
// <b>Required Amount / Item Worth : </b>$'.$required_amount.'<br> 
// <b>Sender\'s USDT Wallet Address : </b>'.$senders_addr.'<br>
// <b>Receiver\'s USDT Wallet Address : </b>'.$receiver_addr.'<br>
// <b>Amount Paid : </b>$'.$amount_paid.'<br>
// <br>
// <br>We look forward to your kind gesture!<br/>
// </p>
// </div>
// </div>
// </td>
// </tr>
// </table>
// <table border="0" cellpadding="10" cellspacing="0" class="button_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tr>
// <td>
// <center>
// <div align="center">
// <a href="https://influxchain.com/login"><div style="color:white;text-decoration:none;display:inline-block;color:#ffffff; background-color: linear-gradient(to right, #0000ff 0%, #003300 100%);border-radius:4px;width:auto;border-top:1px solid #3AAEE0;border-right:1px solid #3AAEE0;border-bottom:1px solid #3AAEE0;border-left:1px solid #3AAEE0;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; line-height: 2; mso-line-height-alt: 32px;"><b>Login now</b></span></span></div></a>
// <p>- Or copy -</p>
// <p>https://influxchain.com/login</p>
// </div>
// <center>
// </td>
// </tr>
// </table>
// <table border="0" cellpadding="10" cellspacing="0" class="divider_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tr>
// <td>
// <div align="center">
// <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tr>
// <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #BBBBBB;"><span></span></td>
// </tr>
// </table>
// </div>
// </td>
// </tr>
// </table>
// <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
// <tr>
// <td>
// <div style="font-family: sans-serif">
// <div style="font-size: 14px; color: white; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
// <p style="margin: 0; font-size: 14px;">Please ensure to always protect your details and reach support anytime you are stucked. For help, just reply to this email—we are always happy to help out.



// <br><br>The Support Team,
// <br>Afflishop.</p>
// </div>
// </div>
// </td>
// </tr>
// </table>
// <br><br>
// <table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tr>
// <td style="width:100%;padding-right:0px;padding-left:0px;"><center>
// <div align="center" style="line-height:10px"><img src="https://influxchain.com/assets/img/logo.png" style="display: block; height: auto; border: 0; width: 100px; max-width: 100%;" width="100"/></div>
// </center>

// </td>
// </tr>
// </table>
// <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
// <tr>
// <td style="padding-top:10px;padding-right:10px;padding-bottom:15px;padding-left:10px;">
// <div style="font-family: sans-serif">
// <div style="font-size: 14px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
// <p style="margin: 0; font-size: 14px; text-align: center;">afflishop.com</p>
// </div>
// </div>
// </td>
// </tr>
// </table>

// <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
// <tr>
// <td style="padding-top:10px;padding-right:10px;padding-bottom:15px;padding-left:10px;">
// <div style="font-family: sans-serif">
// <div style="text-align:center;font-size: 14px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
// <center><p style="max-width:250px;margin: 0; font-size: 14px;text-align:center;">
// You are receiving this email because your registered address under this email in the afflishop system received payment.
// <br><br>
// <p style="color:green;">
// Copyright (c) 2022 afflishop.com
// </p>
// </p></center>
// </div>
// </div>
// </td>
// </tr>
// </table>
// </th>
// </tr>
// </tbody>
// </table>
// </td>
// </tr>
// </tbody>
// </table>
// <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tbody>
// <tr>
// <td>
// <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="500">
// <tbody>
// <tr>
// <th class="column" style="mso-table-lspace: 0; mso-table-rspace: 0; font-weight: 400; text-align: left; vertical-align: top;" width="100%">
// <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tr>
// <td style="color:#9d9d9d;font-family:inherit;font-size:15px;padding-bottom:10px;padding-top:10px;text-align:center;">
// <table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
// <tr>
// <td style="text-align:center;">

// </td>
// </tr>
// </table>
// </td>
// </tr>
// </table>
// </th>
// </tr>
// </tbody>
// </table>
// </td>
// </tr>
// </tbody>
// </table>
// </td>
// </tr>
// </tbody>
// </table><!-- End -->
// </div>
// </div>
// </div>
// </body>
// </html>			
// 			';
// 			$message = wordwrap($message, 70, "\r\n");
// 			$headers = "From:" . $from;
// 			$headers .= "Return-Path: no-reply@afflishop.com" . "\r\n";
// 			$headers .= "BCC: system@afflishop.com" . "\r\n";
// 			$headers .= "Organization: afflishop" . "\r\n";
// 			$headers .= "MIME-Version: 1.0" . "\r\n";
// 			$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
// 			$returnpath = '-f no-reply@afflishop.org';
		
// 			if(@mail($to, $subject, $message, $headers, $returnpath)){
			    
// 			}

   
//             }
// }


?>