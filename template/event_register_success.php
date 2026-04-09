<?php

// Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';  // Ensure PHPMailer is loaded

function sendEventSuccessEmail($to, $data) {
    $subject = "The SharePage Event Registration Successful";

    // Construct the registration package table rows
    $htm = '';
    if ($data['formType'] == 'event') {
        if (isset($data['registration_type'])) {                   
            $package = json_decode($data['registration_type']);
            $package_rows = '';
            foreach ($package as $value) {
                $package_rows .= '
                    <tr>
                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>' . $value->reg_name . '</strong></td>
                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd">' . number_format($value->price, 2,'.', '') . ' X ' . $value->quantity . '</td>
                    </tr>';
            }
            $htm = $package_rows;
        }
    } else {
        if (isset($data['registration_type'])) {                   
            $package = json_decode($data['registration_type']);
            $htm = '
                <tr>    
                    <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd"><strong>' . $package->name . '</strong></td>
                    <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd">' . number_format($package->value, 2, '.', '') . '</td>
                </tr>';
        } 
    }

    // Construct the email message
    $message = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Event Confirmation</title>
    </head>
    <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f4f4; padding: 20px;">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" border="0" width="800px" align="center" style="background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <tr>
                            <td style="text-align: center; padding-bottom: 20px;">
                                <img src="' . $data['BaseUrl'] . '/image/logosharepage%201.png" alt="Logo" width="130" style="border: 0;">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 5px;padding-left: 10px; font-size: 18px; font-weight: bold; color: #333333;">
                                Event Details
                            </td>
                        </tr>                         
                        <tr>
                            <td style="padding-bottom: 20px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Name:</strong></td>
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;">' . $data['name'] . '</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Location:</strong></td>
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;">' . $data['location'] . '</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Date of Event:</strong></td>
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd; line-height:20px;">' . $data['dateOfEvent'] . '<br>Tuesday, 10am to 4pm EST</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;"><strong>Registration date:</strong></td>
                                        <td style="font-size: 14px; padding: 10px; border-bottom: 1px solid #dddddd;">' . $data['paydate'] . '<br>' . $data['time_of_registration'] . '</td>
                                    </tr>
                                </table>
                                <table width="300px" border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
                                    ' . $htm . '                                  
                                </table>
                            </td>
                        </tr>';

                        if ($data['ticket_price'] > 0) {
                            $message .= '<tr>
                                <td style="padding-bottom: 20px;padding-left: 10px; font-size: 16px;">                               
                                    <strong style="margin-right: 15px;line-height: 25px;">Sub Total : </strong>$' . number_format((($data['ticket_price'] + $data['discountAmt']) - $data['ticket_gst']), 2, '.', '') . '<br>
                                    <strong style="margin-right: 15px;line-height: 25px;">Discount : </strong>$' . number_format($data['discountAmt'], 2, '.', '') . '<br>
                                    <strong style="margin-right: 15px;line-height: 25px;">GST : </strong>$' . number_format($data['ticket_gst'], 2, '.', '') . '<br>                                  
                                    <hr style="background: #000;margin:7px 0;height: 1px;">                                  
                                    <strong style="margin-right: 15px;color: green;">Total Amount : </strong>$' . number_format($data['ticket_price'], 2, '.', '') . '<br>
                                </td>                            
                            </tr>';
                        }
                        
                        $message .= '<tr>
                            <td style="padding: 20px; text-align: center; background-color: #f4f4f4; font-size: 12px; color: #666666;">
                                &copy; 2024 <a href="https://www.thesharepage.com/">The SharePage</a>. All rights reserved.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';

    // Set up PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'mail.thesharepage.com';  // SMTP host
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contactus@thesharepage.com';  // SMTP username
        $mail->Password   = "?Jo6fa852$Py)bi89";  // SMTP password
        $mail->SMTPSecure = 'ssl';  // SSL encryption
        $mail->Port       = 465;  // SMTP port

        // Email recipients
        $mail->setFrom('contactus@thesharepage.com', 'SharePage');
        $mail->addAddress($to);  // Recipient email address

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);  // Fallback to plain text for non-HTML clients

        // Send email
        $mail->send();
        return "Email sent successfully!";
    } catch (Exception $e) {
        return "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}
