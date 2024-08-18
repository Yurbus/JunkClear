<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $project_name = trim($_POST["project_name"]);
    $admin_email = trim($_POST["admin_email"]);
    $form_subject = trim($_POST["form_subject"]);
    $name = trim($_POST["name"]);
    $second_name = isset($_POST["second_name"]) ? trim($_POST["second_name"]) : ''; // Для второй формы
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : ''; // Для второй формы
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);

    // Формируем сообщение в зависимости от наличия дополнительных полей
    $message_body = "
        <html>
        <head>
            <title>$form_subject</title>
        </head>
        <body>
            <h2>$form_subject</h2>
            <p><strong>Name:</strong> $name</p>";

    if ($second_name) {
        $message_body .= "<p><strong>Second Name:</strong> $second_name</p>";
    }

    if ($email) {
        $message_body .= "<p><strong>Email:</strong> $email</p>";
    }

    $message_body .= "
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong> $message</p>
        </body>
        </html>
    ";

    // Заголовки для правильной обработки email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $project_name <$admin_email>" . "\r\n";

    // Отправка email
    $send = mail($admin_email, $form_subject, $message_body, $headers);

    // Проверяем отправлено ли сообщение
    if ($send) {
        echo "Form submitted successfully!";
    } else {
        echo "An error occurred. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
