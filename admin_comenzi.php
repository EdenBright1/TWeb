<?php
// admin_comenzi.php — Mystery Box
// Pagina simpla pentru vizualizarea comenzilor din comenzi.json

$jsonFile = __DIR__ . '/comenzi.json';
$comenzi  = [];

if (file_exists($jsonFile)) {
    $raw = file_get_contents($jsonFile);
    $comenzi = json_decode($raw, true) ?? [];
}

// Sorteaza: cele mai noi primele
$comenzi = array_reverse($comenzi);

$catEmoji = [
    'gaming' => '🎮', 'beauty' => '💄', 'gadget' => '📱',
    'snack'  => '🍫', 'sport'  => '🏋️',
];
?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — Comenzi Mystery Box</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .admin-wrap { max-width: 900px; margin: 0 auto; padding: clamp(30px,5vw,60px) clamp(20px,4vw,40px); }
    .admin-title { font-family:'Fraunces',serif; font-size:2rem; font-weight:300; color:var(--cream); margin-bottom:6px; }
    .admin-title em { color:var(--ember); font-style:italic; }
    .admin-sub { font-size:.8rem; color:var(--muted); margin-bottom:32px; }
    .admin-count { display:inline-block; background:var(--ember); color:#fff; font-size:.62rem; font-weight:700; letter-spacing:.18em; padding:4px 12px; border-radius:999px; margin-bottom:28px; }

    .order-card {
      background: var(--ink2); border: 1px solid var(--border);
      border-radius: 10px; padding: 20px 24px; margin-bottom: 16px;
      transition: border-color .2s;
    }
    .order-card:hover { border-color: var(--border-h); }
    .order-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; flex-wrap:wrap; gap:8px; }
    .order-id { font-size:.62rem; font-weight:700; letter-spacing:.2em; color:var(--ember); }
    .order-date { font-size:.72rem; color:var(--muted); }
    .order-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:10px 20px; }
    .order-field { }
    .order-label { font-size:.56rem; font-weight:600; letter-spacing:.2em; text-transform:uppercase; color:var(--muted); margin-bottom:3px; }
    .order-val { font-size:.84rem; color:var(--cream); }
    .badge-nivel { display:inline-block; font-size:.6rem; font-weight:600; letter-spacing:.15em; text-transform:uppercase; padding:3px 10px; border-radius:999px; }
    .badge-basic    { background:rgba(237,232,224,.08); color:var(--cream); border:1px solid rgba(237,232,224,.15); }
    .badge-standard { background:rgba(255,92,26,.12);  color:var(--ember); border:1px solid rgba(255,92,26,.25); }
    .badge-premium  { background:rgba(218,165,32,.12); color:#daa520;      border:1px solid rgba(218,165,32,.3); }
    .empty-state { text-align:center; padding:80px 20px; color:var(--muted); }
    .empty-state .big { font-size:4rem; margin-bottom:16px; }
    .btn-back { display:inline-flex; align-items:center; gap:8px; font-size:.64rem; font-weight:600; letter-spacing:.18em; text-transform:uppercase; color:var(--muted); transition:color .2s; margin-bottom:28px; }
    .btn-back:hover { color:var(--cream); }
  </style>
</head>
<body>

<header>
  <div class="brand">
    <span class="brand-name">Mystery Box</span>
    <div class="brand-dot"></div>
  </div>
  <nav>
    <a href="acasa.html">Acasă</a>
    <a href="cutii.html">Cutii</a>
    <a href="despre.html">Despre</a>
    <a href="intrebari.html">FAQ</a>
    <a href="tracking.php" class="nav-track">&#x1F4E6; Tracking</a>
  </nav>
</header>

<div class="admin-wrap">
  <a class="btn-back" href="cutii.html">← Înapoi la Cutii</a>
  <h1 class="admin-title">Comenzi <em>înregistrate</em></h1>
  <p class="admin-sub">Toate comenzile salvate în comenzi.json</p>
  <span class="admin-count"><?= count($comenzi) ?> COMENZI TOTALE</span>

  <?php if (empty($comenzi)): ?>
    <div class="empty-state">
      <div class="big">📭</div>
      <p>Nicio comandă încă. Trimite prima comandă din pagina Cutii!</p>
    </div>
  <?php else: ?>
    <?php foreach ($comenzi as $c): ?>
      <div class="order-card">
        <div class="order-top">
          <span class="order-id"><?= htmlspecialchars($c['id']) ?></span>
          <span class="order-date">📅 <?= htmlspecialchars($c['data']) ?></span>
        </div>
        <div class="order-grid">
          <div class="order-field">
            <div class="order-label">Client</div>
            <div class="order-val"><?= htmlspecialchars($c['nume']) ?></div>
          </div>
          <div class="order-field">
            <div class="order-label">Email</div>
            <div class="order-val"><?= htmlspecialchars($c['email']) ?></div>
          </div>
          <div class="order-field">
            <div class="order-label">Telefon</div>
            <div class="order-val"><?= htmlspecialchars($c['telefon']) ?></div>
          </div>
          <div class="order-field">
            <div class="order-label">Adresă</div>
            <div class="order-val"><?= htmlspecialchars($c['adresa']) ?></div>
          </div>
          <div class="order-field">
            <div class="order-label">Categorie</div>
            <div class="order-val"><?= ($catEmoji[$c['categorie']] ?? '📦') . ' ' . ucfirst(htmlspecialchars($c['categorie'])) ?></div>
          </div>
          <div class="order-field">
            <div class="order-label">Nivel</div>
            <div class="order-val">
              <span class="badge-nivel badge-<?= htmlspecialchars($c['nivel']) ?>">
                <?= ucfirst(htmlspecialchars($c['nivel'])) ?>
              </span>
            </div>
          </div>
          <div class="order-field">
            <div class="order-label">Preț</div>
            <div class="order-val" style="color:var(--ember);font-weight:600"><?= htmlspecialchars($c['pret']) ?></div>
          </div>
          <div class="order-field">
            <div class="order-label">Plată</div>
            <div class="order-val"><?= $c['plata'] === 'card' ? '💳 Card' : '💵 Ramburs' ?></div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>



</body>
</html>
