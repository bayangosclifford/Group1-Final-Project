<?php
// Retrieve the SendGrid API key from the environment variable
$sendgridApiKey = getenv('SENDGRID_API_KEY'); // Recommended for environment variables

// Function to send email using SendGrid
function sendEmail($to, $subject, $content) {
    global $sendgridApiKey; // Use the API key from the environment

    // Create the email structure
    $email = [
        'personalizations' => [[ 'to' => [['email' => $to]] ]],
        'from' => [ 'email' => 'cliffordbayangos@gmail.com' ], // Replace with your verified sender email
        'subject' => $subject,
        'content' => [[
            'type' => 'text/html',
            'value' => $content
        ]]
    ];

    // Initialize cURL to SendGrid API endpoint
    $ch = curl_init('https://api.sendgrid.com/v3/mail/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $sendgridApiKey,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($email));

    // Send the request and get response
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Check for success
    if ($httpCode != 202) {
        error_log("Error sending email: $response");
        return false;
    }

    return true;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $clientEmail = $_POST['email'];
    $clientName = $_POST['name'];
    $phoneNumber = $_POST['phone'];
    $inquiryType = $_POST['inquiryType'];
    $message = $_POST['message'];

    // Prepare confirmation email content for the client
    $clientSubject = "Thank you for your inquiry!";
    $clientContent = "
        <p>Hello $clientName,</p>
        <p>Thank you for reaching out. We have received your inquiry and will get back to you shortly.</p>
        <p>Best regards,<br>ITECH Solutions</p>
    ";

    // Prepare internal notification email content for the team
    $internalSubject = "New Client Inquiry Received";
    $internalContent = "
        <p>You have received a new inquiry from <strong>$clientName</strong>.</p>
        <p>Email: $clientEmail</p>
        <p>Phone number: $phoneNumber</p>
        <p>Inquiry Type: $inquiryType</p>
        <p>Message: $message</p>
    ";

    // Send confirmation email to the client
    $clientEmailSent = sendEmail($clientEmail, $clientSubject, $clientContent);

    // Send notification email to the team
    $internalEmailSent = sendEmail('cliffordbayangos@gmail.com', $internalSubject, $internalContent); // Replace with your internal email

    // Check if both emails were sent
    if ($clientEmailSent && $internalEmailSent) {
        $alert= 'Email Sent Successfully!';
    } else {
        $alert = 'Failed to Sent Successfully';
    }
} else {
    $alert = 'Invalid request method.';
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Form Submission</title>

<head></head>
<style>
    body {
        text-align: center;
        background-color: #fcb773;
    }

    body div {
        margin-top: 70px;
    }

    body button {
        margin-top: 500px;
    }

    a {
        font-size: 15px;
        text-decoration: none;
        color: white;
    }

    a:hover {
        color: black;
    }

    button {
        background-color: #e65a4d;
        border: none;
        width: 120px;
        height: 50px;
        border-radius: 20px;
    }
    h2 {
        font-size: 30px;
        top: 0;
        margin: 0;
        font-family: 'Arial', 'sans-serif';
    }

    div {
        margin: 0;
    }
</style>

<body>
    <div>
        <h2><?php printf($alert)?></h2>

    </div>
    <button><a href="../../INTPROG/index3.html">Back to Home</a></button>
</body>

</html>