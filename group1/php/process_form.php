<?php
$sendgridApiKey = getenv('SENDGRID_API_KEY');
function sendEmail($to, $subject, $content)
{
    global $sendgridApiKey;

    $email = [
        'personalizations' => [['to' => [['email' => $to]]]],
        'from' => ['email' => 'cliffordbayangos@gmail.com'],
        'subject' => $subject,
        'content' => [
            [
                'type' => 'text/html',
                'value' => $content
            ]
        ]
    ];

    $ch = curl_init(url: 'https://api.sendgrid.com/v3/mail/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $sendgridApiKey,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($email));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode != 202) {
        error_log("Error sending email: $response");
        return false;
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $clientEmail = $_POST['email'];
    $clientName = $_POST['name'];
    $phoneNumber = $_POST['phone'];
    $inquiryType = $_POST['inquiryType'];
    $message = $_POST['message'];

    $clientSubject = "Thank you for your inquiry!";
    $clientContent = "
        <p>Hello $clientName,</p>
        <p>Thank you for reaching out. We have received your inquiry and will get back to you shortly.</p>
        <p>Best regards,<br>ITech Solutions</p>
    ";

    $internalSubject = "New Client Inquiry Received";
    $internalContent = "
        <p>You have received a new inquiry from <strong>$clientName</strong>.</p>
        <p>Email: $clientEmail</p>
        <p>Phone number: $phoneNumber</p>
        <p>Inquiry Type: $inquiryType</p>
        <p>Message: $message</p>
    ";

    $clientEmailSent = sendEmail($clientEmail, $clientSubject, $clientContent);

    $internalEmailSent = sendEmail('cliffordbayangos@gmail.com', $internalSubject, $internalContent); // Replace with your internal email

    if ($clientEmailSent && $internalEmailSent) {
        $alert = 'Email Sent Successfully!';
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
        <h2><?php printf($alert) ?></h2>

    </div>
    <button><a href="../../INTPROG/index3.html">Back to Home</a></button>
</body>

</html>