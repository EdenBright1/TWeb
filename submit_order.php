<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Metoda nu este permisa.']);
    exit;
}

$raw  = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Date invalide.']);
    exit;
}

$nume   = trim($data['nume']      ?? '');
$email  = trim($data['email']     ?? '');
$tel    = trim($data['tel']       ?? '');
$adresa = trim($data['adresa']    ?? '');
$cat    = trim($data['categorie'] ?? '');
$nivel  = trim($data['nivel']     ?? '');
$plata  = trim($data['plata']     ?? '');

$errors = [];
if (count(explode(' ', $nume)) < 2 || strlen($nume) < 4) $errors[] = 'Nume complet invalid.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))           $errors[] = 'Email invalid.';
if (strlen(preg_replace('/\D/', '', $tel)) < 7)           $errors[] = 'Telefon invalid.';
if (strlen($adresa) < 6)                                  $errors[] = 'Adresa prea scurta.';
if (!in_array($cat, ['gaming','beauty','gadget','snack','sport'])) $errors[] = 'Categorie invalida.';
if (!in_array($nivel, ['basic','standard','premium']))    $errors[] = 'Nivel invalid.';
if (!in_array($plata, ['card','ramburs']))                $errors[] = 'Plata invalida.';

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

$pretMap = [
    'gaming' => ['basic'=>'358 MDL','standard'=>'748 MDL','premium'=>'1248 MDL'],
    'beauty' => ['basic'=>'358 MDL','standard'=>'748 MDL','premium'=>'1248 MDL'],
    'gadget' => ['basic'=>'358 MDL','standard'=>'748 MDL','premium'=>'1248 MDL'],
    'snack'  => ['basic'=>'268 MDL','standard'=>'623 MDL','premium'=>'998 MDL'],
    'sport'  => ['basic'=>'358 MDL','standard'=>'823 MDL','premium'=>'1373 MDL'],
];

$catEmoji = ['gaming'=>'🎮','beauty'=>'💄','gadget'=>'📱','snack'=>'🍫','sport'=>'🏋️'];
$catNume  = ['gaming'=>'Gaming','beauty'=>'Beauty','gadget'=>'Gadget','snack'=>'Snack','sport'=>'Sport & Fitness'];

$comanda = [
    'id'        => 'MB-' . strtoupper(substr(md5(uniqid()), 0, 8)),
    'data'      => date('Y-m-d H:i:s'),
    'nume'      => htmlspecialchars($nume),
    'email'     => htmlspecialchars($email),
    'telefon'   => htmlspecialchars($tel),
    'adresa'    => htmlspecialchars($adresa),
    'categorie' => $cat,
    'nivel'     => $nivel,
    'pret'      => $pretMap[$cat][$nivel] ?? '— MDL',
    'plata'     => $plata,
    'status'    => 'nou',
];

$jsonFile = __DIR__ . '/comenzi.json';
$comenzi  = [];
if (file_exists($jsonFile)) {
    $comenzi = json_decode(file_get_contents($jsonFile), true) ?? [];
}
$comenzi[] = $comanda;
$result = file_put_contents($jsonFile, json_encode($comenzi, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);

if ($result === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Eroare la salvarea comenzii.']);
    exit;
}

// ── Pregatire date email
$primaLitera = ucfirst(strtolower(explode(' ', $nume)[0]));
$numeCat     = $catNume[$cat] ?? ucfirst($cat);
$emojiStr    = $catEmoji[$cat] ?? '📦';
$nivelStr    = ucfirst($nivel);
$plataTxt    = $plata === 'card' ? 'Card bancar' : 'Ramburs la livrare';
$trackingUrl = 'http://localhost/mysterybox/tracking.php?id=' . $comanda['id'];

$emailBody = "<!DOCTYPE html>
<html lang='ro'>
<head><meta charset='UTF-8'></head>
<body style='margin:0;padding:0;background:#f4f4f4;font-family:Georgia,serif;'>

<div style='max-width:580px;margin:40px auto;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);'>

  <!-- Header portocaliu -->
  <div style='background:#ff5c1a;padding:36px 40px;text-align:center;'>
    <div style='font-size:28px;font-weight:bold;color:#ffffff;letter-spacing:2px;'>MYSTERY BOX</div>
    <div style='font-size:13px;color:rgba(255,255,255,0.8);margin-top:6px;letter-spacing:3px;text-transform:uppercase;'>Confirmare Comanda</div>
  </div>

  <!-- Continut principal -->
  <div style='padding:40px;color:#333333;'>

    <p style='font-size:18px;margin:0 0 16px;color:#111;'>Buna ziua, <strong style='color:#ff5c1a;'>{$primaLitera}</strong>!</p>

    <p style='font-size:15px;line-height:1.8;margin:0 0 20px;color:#444;'>
      Iti multumim din suflet ca ai ales <strong>Mystery Box</strong>!<br>
      Comanda ta a fost inregistrata cu succes si este acum in procesare.
    </p>

    <!-- Cutia comandata -->
    <div style='background:#fff8f5;border:2px solid #ff5c1a;border-radius:10px;padding:20px 24px;margin:24px 0;text-align:center;'>
      <div style='font-size:40px;margin-bottom:8px;'>{$emojiStr}</div>
      <div style='font-size:20px;font-weight:bold;color:#ff5c1a;'>{$numeCat} Box</div>
      <div style='font-size:14px;color:#888;margin-top:4px;'>Nivel: {$nivelStr} &nbsp;|&nbsp; {$comanda['pret']}</div>
    </div>

    <!-- ID Comanda -->
    <p style='font-size:14px;color:#666;margin:0 0 6px;'>Numarul comenzii tale este:</p>
    <div style='background:#f9f9f9;border:1px dashed #ff5c1a;border-radius:8px;padding:14px 20px;margin-bottom:24px;text-align:center;'>
      <span style='font-size:22px;font-weight:bold;color:#ff5c1a;letter-spacing:3px;'>{$comanda['id']}</span>
    </div>

    <!-- Detalii livrare -->
    <p style='font-size:15px;line-height:1.8;margin:0 0 8px;color:#444;'>
      <strong>Comanda ta va fi transmisa la adresa:</strong><br>
      <span style='color:#333;'>{$adresa}</span>
    </p>

    <p style='font-size:15px;line-height:1.8;margin:0 0 24px;color:#444;'>
      Estimam ca pachetul va ajunge la dumneavoastra in termen de
      <strong style='color:#ff5c1a;'>3-5 zile lucratoare</strong>
      de la confirmarea comenzii.
    </p>

    <p style='font-size:15px;line-height:1.8;margin:0 0 8px;color:#444;'>
      Metoda de plata aleasa: <strong>{$plataTxt}</strong>
    </p>

    <!-- Tracking button -->
    <div style='text-align:center;margin:32px 0;'>
      <a href='{$trackingUrl}' style='background:#ff5c1a;color:#ffffff;text-decoration:none;padding:16px 36px;border-radius:6px;font-size:14px;font-weight:bold;letter-spacing:2px;text-transform:uppercase;display:inline-block;'>
        Urmareste comanda ta
      </a>
    </div>

    <hr style='border:none;border-top:1px solid #eeeeee;margin:28px 0;'>

    <!-- Mesaj cald -->
    <p style='font-size:15px;line-height:1.8;color:#555;margin:0 0 12px;'>
      Speram ca surpriza din cutie sa iti aduca bucurie si sa depaseasca asteptarile tale!
      Daca ai intrebari sau nelamuriri, nu ezita sa ne contactezi.
    </p>

    <p style='font-size:15px;line-height:1.8;color:#555;margin:0;'>
      Te asteptam inapoi cu mare drag! 🧡
    </p>

    <br>
    <p style='font-size:15px;color:#333;margin:0;'>
      Cu caldura,<br>
      <strong style='color:#ff5c1a;'>Echipa Mystery Box</strong>
    </p>

  </div>

  <!-- Footer -->
  <div style='background:#f9f9f9;border-top:1px solid #eeeeee;padding:20px 40px;text-align:center;'>
    <p style='font-size:12px;color:#aaa;margin:0;'>
      &copy; Mystery Box &mdash; Toate drepturile rezervate
    </p>
  </div>

</div>
</body>
</html>";

$mail = new PHPMailer(true);
$emailSent = false;
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'stasdioker23@gmail.com';
    $mail->Password   = 'vdum xkat wgmm xyyv';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
    $mail->setFrom('stasdioker23@gmail.com', 'Mystery Box');
    $mail->addAddress($email, $nume);
    $mail->isHTML(true);
    $mail->Subject = 'Multumim pentru comanda ta! — ' . $comanda['id'];
    $mail->Body    = $emailBody;
    $mail->AltBody = "Buna ziua, {$primaLitera}! Multumim ca ai ales Mystery Box! Comanda ta {$comanda['id']} a fost inregistrata. Ai comandat {$numeCat} Box nivel {$nivelStr} — {$comanda['pret']}. Comanda va fi transmisa la adresa ta in 3-5 zile lucratoare. Cu caldura, Echipa Mystery Box.";
    $mail->send();
    $emailSent = true;
} catch (Exception $e) {
    $emailSent = false;
}

echo json_encode([
    'success'     => true,
    'orderId'     => $comanda['id'],
    'mesaj'       => 'Comanda a fost inregistrata cu succes!',
    'pret'        => $comanda['pret'],
    'emailTrimis' => $emailSent,
]);
exit;
