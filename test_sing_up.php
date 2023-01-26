<?php
  // Lấy thông tin người nhận và mã kích hoạt từ form
  $to = 'dvthang2906@gmail.com';
  $subject = 'Account activation';
  $message = 'Your activation code is: ' . $_POST['activation_code'];
  $headers = 'From: no-reply@example.com' . "\r\n" .
             'Reply-To: no-reply@example.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

  // Gửi email
  if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully';
  } else {
    echo 'Error sending email';
  }
?>