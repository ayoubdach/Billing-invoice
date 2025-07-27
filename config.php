<?php
// === TELEGRAM BOT SETTINGS ===
define('TG_BOT_TOKEN', 'YOUR_BOT_TOKEN_HERE');
define('TG_CHAT_ID', 'YOUR_CHAT_ID_HERE');

function tg_send($msg) {
  $url = "https://api.telegram.org/bot" . TG_BOT_TOKEN . "/sendMessage";
  $data = [
    'chat_id' => TG_CHAT_ID,
    'text' => $msg,
    'parse_mode' => 'HTML'
  ];
  @file_get_contents($url . '?' . http_build_query($data));
}
?>
