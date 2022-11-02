<?php
// from email
$from = 'phanthebao888@gmail.com'; // change this mail người nhân
// to email
$to = 'dongnaigavip12@gmail.com'; // change this
// subject
$subject = 'Christmas Contest Announcement';

// html message
$htmlmsg = '<html>
    <head>
        <title>Christmas Contest Winners</title>
    </head>
    <body>
        <h1>Hi! We are glad to announce the Christmas contest winners...</h1>
        <table>
            <tr style="background-color: #EEE;">
                <th width="25%">#</th>
                <th width="35%">Ticket No.</th>
                <th>Name</th>
            </tr>
            <tr>
                <td>#1</td>
                <td>P646MLDO808K</td>
                <td>Sally</td>
            </tr>
            <tr style="background-color: #EEE;">
                <td>#2</td>
                <td>DFJ859LV9D5U</td>
                <td>Parker</td>
            </tr>
            <tr>
                <td>#3</td>
                <td>AU30HI8IHL96</td>
                <td>Justin</td>
            </tr>
        </table>
    </body>
</html>';

// set content type header for html email
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// set additional headers
$headers .= 'From: Christmas Contest <phanthebao888@gmail.com>' . "\r\n";
$headers .= 'Cc: contestadmin@gmail.com' . "\r\n";

// send email
if (mail($to, $subject, $htmlmsg, $headers))
    echo "Email sent successfully!";
else
    echo "Error sending email! Please try again later...";
?>