<!-- 
    contact form php

    Email will send date of contact
    Email will send conformation email


-->
<?php

    //Email to forwarding email
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $userEnteredEmail = $_POST["email"];
    $to = "contact@coconutlavender.com"; 
    $subject = $_POST["contactReason"];
    $message = 

        "Contact form was submitted on: " . date("m-d-Y") . "\n" . 
        "You are being contacted by: " . $firstName . " " . $lastName . "\n" . 
        "Email: " . $userEnteredEmail . "\n" . 
        "They are contacting you because: " . $subject . "\n\n" . 
        "They left the message:\n\n" . $_POST["message"]

    ;
    $headers = "From: contact@coconutlavender.com" . "\r\n" . 
                "Reply-To:" . $userEnteredEmail . "\r\n";

    mail($to, $subject, $message, $headers, '-f contact@coconutlavender.com');


    //Email to user    
    $userConfirmationMessage =

        "Hello " . $firstName . " " . $lastName . "," . "\n\n" . 
        "Thank you for contacting me! Once I recieve your email I will get back to you shortly." . "\n\n" . 
        "Below is the information you submitted through my contact form:" . "\n\n" . 
        "Date Submitted: " . date("m-d-Y") . "\n" . 
        "Reason for contact:" . $subject . "\n" . 
        "Message you left:\n\n" . $_POST["message"] . "\n" . 
        "Thank you,\n Carissa"
    ;
    $userHeaders = "From: contact@coconutlavender.com" . "\r\n" . 
                  "Reply-To: contact@coconutlavender.com";

    mail($userEnteredEmail, $subject, $userConfirmationMessage, $userHeaders, '-f contact@coconutlavender.com')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Handler</title>
    <style>
        body {
            background-color: #bbe4ff;
        }
        h2, p {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Thank you for contacting me!</h2>
    <p>
        Please check you email for a confirmation of the contact form you submitted. Once I recieve the email I will get back to you. 
    </p>
</body>
</html>