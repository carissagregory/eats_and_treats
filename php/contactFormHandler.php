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
    <!--external js files-->
    <script defer src="js/eatsAndTreatsJS.js"></script>
    <!--headings font-->
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    <!--regular text font-->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <!--css-->
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <!--logo-->
    <link rel="icon" href="images/eatsAndTreatsLogo.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="descripton" content="Contact Form Confirmation ">    
    <title>Contact Confirmation</title>
</head>
<body class="container">
    <div class="navigationBar">
        <img src="../images/eatsAndTreatsLogo.png" alt="eats and treats logo">
    </div><!--navigationBar--> 
    <main class="confirmationContainer">
        <div id="submitContactConfirmation">
            <h1>Thank you for contacting the Eats and Treats Team!</h1>
            <p>
                Please check you email for a confirmation of the contact form you submitted. Once our team recieves your email they will get back to you shortly. 
            </p>
            <a href="../index.html"><button><h4>Home Page</h4></button></a>
        </div>
    </main>
    <footer>
        <p>Eats and Treats Copyright &copy <?php echo date("Y");?> </p>        
    </footer>
</body>
</html>