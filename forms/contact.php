<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form inputs and sanitize them
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address.';
        exit;
    }

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'openchat517@gmail.com'; // Your Gmail email
        $mail->Password = 'gspq gprg zxuh sbjx'; // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set the sender's email to the email entered by the client
        $mail->setFrom($email, $name); // Dynamic sender's email

        // Recipient email address
        $mail->addAddress('jimcarryomambak0@gmail.com', 'Jimcarry'); // The recipient's email

        // Reply-to address (so the recipient can reply to the client's email)
        $mail->addReplyTo($email, $name); 

        // Set email format to HTML
        $mail->isHTML(true);

        // Set the subject of the email
        $mail->Subject = 'Message from ' . $name . ': ' . $subject;

        // Build the email body with a professional design
        $bodyContent = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f7fc;
                }
                .email-container {
                    width: 100%;
                    background-color: #ffffff;
                    margin: 0 auto;
                    padding: 20px;
                    max-width: 600px;
                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                }
                .header {
                    background-color: #007bff;
                    padding: 20px;
                    color: #ffffff;
                    text-align: center;
                    border-radius: 5px 5px 0 0;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                }
                .content {
                    padding: 20px;
                    line-height: 1.6;
                    color: #333333;
                }
                .content p {
                    margin: 10px 0;
                }
                .footer {
                    background-color: #f4f7fc;
                    text-align: center;
                    padding: 10px;
                    border-radius: 0 0 5px 5px;
                    font-size: 12px;
                    color: #777777;
                }

                .footer p{
                  color: white;
                } 
                .btn {
                    background-color: #007bff;
                    color: white;
                    padding: 10px 20px;
                    border-radius: 5px;
                    text-decoration: none;
                    display: inline-block;
                    font-weight: bold;
                }
                .btn:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    <h1>New Message from ' . $name . '</h1>
                </div>
                <div class="content">
                    <p><strong>Subject:</strong> ' . $subject . '</p>
                    <p><strong>From:</strong> ' . $name . ' (' . $email . ')</p>
                    <p><strong>Message:</strong></p>
                    <p>' . nl2br($message) . '</p>
                </div>
                <div class="footer">
                    <p>This email was sent by your website contact form.</p>
                    <p><a href="mailto:' . $email . '" class="btn">Reply to Sender</a></p>
                </div>
            </div>
        </body>
        </html>';

        // Set the email body
        $mail->Body = $bodyContent;

        // Provide a plain text alternative
        $mail->AltBody = strip_tags($message);

        // Send the email
        $mail->send();
        echo 'Your message has been sent. Thank you!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Invalid request.';
}
?>
