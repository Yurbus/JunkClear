<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'phpmailer/language/');
    $mail->IsHTML(true);

    // From
    $mail->setFrom('frankins636@gmail.com', 'Junk Clear');

    // To
    $mail->addAddress('frankins636@gmail.com');

    // Subject
    $mail->Subject = "Message from Junk Clear";

    // Body
    $body = '<h1>Message from PTG website</h1>';

    if (isset($_POST['productTitle']) && trim($_POST['productTitle']) !== '') {
        $body .= '<p><strong>Title product:</strong> ' . $_POST['productTitle'] . '</p>';
    }
    if (isset($_POST['name']) && trim($_POST['name']) !== '') {
        $body .= '<p><strong>Name:</strong> ' . $_POST['name'] . '</p>';
    }
    if (isset($_POST['name2']) && trim($_POST['name2']) !== '') {
        $body .= '<p><strong>Last name:</strong> ' . $_POST['name2'] . '</p>';
    }
    if (isset($_POST['phone']) && trim($_POST['phone']) !== '') {
        $body .= '<p><strong>Phone:</strong> ' . $_POST['phone'] . '</p>';
    }
    if (isset($_POST['email']) && trim($_POST['email']) !== '') {
        $body .= '<p><strong>Email:</strong> ' . $_POST['email'] . '</p>';
    }
    if (isset($_POST['message']) && trim($_POST['message']) !== '') {
        $body .= '<p><strong>Message:</strong> ' . $_POST['message'] . '</p>';
    }

    $mail->Body = $body;

    // Sending
    if (!$mail->send()) {
        $message = 'Error';
    } else {
        $message = 'Message sent';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
    
?>