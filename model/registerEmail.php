<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function send_verification_email($email, $token) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Thay thế với địa chỉ SMTP của bạn
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nguyenphuongnam.intern@gmail.com'; // Thay thế với địa chỉ email của bạn
        $mail->Password   = 'jnoz efff dzce nnrt'; // Thay thế với mật khẩu email của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Hoặc PHPMailer::ENCRYPTION_SMTPS nếu sử dụng SSL
        $mail->Port       = 465; // Hoặc 465 nếu sử dụng SSL

        // Recipients
        $mail->setFrom('nguyenphuongnam.intern@gmail.com', 'DND FOOD');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Verify your email address';
        $mail->Body    = 'Vui lòng nhấp vào liên kết sau để xác minh email của bạn: <a href="http://php.test/duan1/Nhom04_WebBanDoAnNhanh_DND/index.php?act=verify&token=' . $token . '">Verify Email</a>';

        $mail->send();
        // echo '<h3>Email xác minh đã được gửi.</h3>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}




