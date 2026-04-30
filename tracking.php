<?php
// tracking.php — Mystery Box

// Raspunde JSON doar daca fetch() trimite ?ajax=1
if (isset($_GET['ajax']) && $_GET['ajax'] === '1' && isset($_GET['id'])) {
    header('Content-Type: application/json; charset=utf-8');

    $cautId  = strtoupper(trim($_GET['id']));
    $jsonFile = __DIR__ . '/comenzi.json';

    if (!file_exists($jsonFile)) {
        echo json_encode(['found' => false, 'error' => 'Nicio comandă în sistem.']);
        exit;
    }

    $comenzi = json_decode(file_get_contents($jsonFile), true) ?? [];
    $gasit   = null;

    foreach ($comenzi as $c) {
        if (strtoupper($c['id']) === $cautId) {
            $gasit = $c;
            break;
        }
    }

    if ($gasit) {
        echo json_encode(['found' => true, 'comanda' => $gasit]);
    } else {
        echo json_encode(['found' => false, 'error' => 'Nicio comandă cu acest ID.']);
    }
    exit;
}

// Altfel — afiseaza pagina HTML normala
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
  <title>Tracking Comandă — Mystery Box</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .tracking-wrap {
      max-width: 640px;
      margin: 0 auto;
      padding: clamp(40px,7vw,80px) clamp(20px,4vw,40px);
    }

    /* Search box */
    .search-card {
      background: var(--ink2);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 32px 28px;
      margin-bottom: 32px;
    }
    .search-row {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }
    .search-input {
      flex: 1;
      background: rgba(255,255,255,.04);
      border: 1px solid var(--border);
      border-radius: 4px;
      padding: 12px 16px;
      color: var(--cream);
      font-family: 'Epilogue', sans-serif;
      font-size: .9rem;
      letter-spacing: .08em;
      text-transform: uppercase;
      outline: none;
      transition: border-color .2s;
    }
    .search-input::placeholder {
      color: var(--muted);
      text-transform: none;
      letter-spacing: 0;
    }
    .search-input:focus {
      border-color: var(--ember);
    }

    /* Result card */
    .result-card {
      background: var(--ink2);
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
      display: none;
      animation: slideIn .35s var(--ease);
    }
    .result-card.show { display: block; }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Result header */
    .result-head {
      background: rgba(255,92,26,.08);
      border-bottom: 1px solid rgba(255,92,26,.15);
      padding: 20px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
    }
    .result-id {
      font-size: .68rem;
      font-weight: 700;
      letter-spacing: .22em;
      color: var(--ember);
    }
    .result-status {
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .18em;
      text-transform: uppercase;
      padding: 5px 14px;
      border-radius: 999px;
      background: rgba(255,92,26,.15);
      color: var(--ember);
      border: 1px solid rgba(255,92,26,.3);
    }

    /* Result body */
    .result-body { padding: 24px; }
    .result-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 18px 24px;
      margin-bottom: 24px;
    }
    .r-field {}
    .r-label {
      font-size: .56rem;
      font-weight: 600;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 4px;
    }
    .r-val {
      font-size: .88rem;
      color: var(--cream);
    }
    .r-val.price {
      color: var(--ember);
      font-weight: 600;
      font-size: 1rem;
    }

    /* Progress bar */
    .progress-wrap {
      border-top: 1px solid var(--border);
      padding-top: 22px;
      margin-top: 4px;
    }
    .progress-label {
      font-size: .6rem;
      font-weight: 600;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 14px;
    }
    .steps-track {
      display: flex;
      align-items: center;
      gap: 0;
    }
    .step-dot {
      display: flex;
      flex-direction: column;
      align-items: center;
      flex: 1;
      position: relative;
    }
    .step-dot:not(:last-child)::after {
      content: '';
      position: absolute;
      top: 13px;
      left: 50%;
      width: 100%;
      height: 2px;
      background: var(--border);
      z-index: 0;
    }
    .step-dot.done:not(:last-child)::after {
      background: var(--ember);
    }
    .dot-circle {
      width: 26px;
      height: 26px;
      border-radius: 50%;
      border: 2px solid var(--border);
      background: var(--ink2);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .65rem;
      color: var(--muted);
      position: relative;
      z-index: 1;
      transition: all .3s;
    }
    .step-dot.done .dot-circle {
      border-color: var(--ember);
      background: rgba(255,92,26,.15);
      color: var(--ember);
    }
    .step-dot.active .dot-circle {
      border-color: var(--ember);
      background: var(--ember);
      color: #fff;
      box-shadow: 0 0 16px rgba(255,92,26,.4);
    }
    .dot-label {
      font-size: .58rem;
      font-weight: 500;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--muted);
      margin-top: 8px;
      text-align: center;
    }
    .step-dot.done .dot-label,
    .step-dot.active .dot-label { color: var(--ember); }

    /* Error state */
    .error-box {
      background: rgba(220,38,38,.08);
      border: 1px solid rgba(220,38,38,.2);
      border-radius: 8px;
      padding: 16px 20px;
      font-size: .84rem;
      color: #f87171;
      display: none;
      margin-top: 16px;
    }
    .error-box.show { display: block; }

    /* Loading */
    .btn-main.loading {
      opacity: .7;
      pointer-events: none;
    }
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

<div class="tracking-wrap">

  <div class="section-head reveal">
    <span class="sec-label">Urmărire comandă</span>
    <h2 class="sec-title">Tracking <em>comandă</em></h2>
    <div class="sec-line"></div>
    <p style="color:var(--muted);font-size:.84rem;font-weight:300;margin-top:14px;line-height:1.8">
      Introdu ID-ul comenzii primit după plasare pentru a vedea statusul livrării.
    </p>
  </div>

  <div class="search-card reveal">
    <div class="overline">ID comandă</div>
    <div class="search-row">
      <input
        class="search-input"
        type="text"
        id="trackInput"
        placeholder="ex: MB-BAE3AD6B"
        maxlength="14"
        autocomplete="off"
        spellcheck="false"
      >
      <button class="btn-main" id="trackBtn" type="button">Caută →</button>
    </div>
    <div class="error-box" id="errorBox"></div>
  </div>

  <!-- Result card — hidden until search -->
  <div class="result-card" id="resultCard">
    <div class="result-head">
      <span class="result-id" id="rId">—</span>
      <span class="result-status" id="rStatus">—</span>
    </div>
    <div class="result-body">
      <div class="result-grid">
        <div class="r-field">
          <div class="r-label">Client</div>
          <div class="r-val" id="rNume">—</div>
        </div>
        <div class="r-field">
          <div class="r-label">Data comenzii</div>
          <div class="r-val" id="rData">—</div>
        </div>
        <div class="r-field">
          <div class="r-label">Categorie</div>
          <div class="r-val" id="rCat">—</div>
        </div>
        <div class="r-field">
          <div class="r-label">Nivel</div>
          <div class="r-val" id="rNivel">—</div>
        </div>
        <div class="r-field">
          <div class="r-label">Preț total</div>
          <div class="r-val price" id="rPret">—</div>
        </div>
        <div class="r-field">
          <div class="r-label">Plată</div>
          <div class="r-val" id="rPlata">—</div>
        </div>
        <div class="r-field" style="grid-column:1/-1">
          <div class="r-label">Adresă livrare</div>
          <div class="r-val" id="rAdresa">—</div>
        </div>
      </div>

      <!-- Delivery progress -->
      <div class="progress-wrap">
        <div class="progress-label">Stare livrare</div>
        <div class="steps-track" id="stepsTrack">
          <div class="step-dot done" data-status="nou">
            <div class="dot-circle">✓</div>
            <div class="dot-label">Înregistrată</div>
          </div>
          <div class="step-dot" data-status="confirmat">
            <div class="dot-circle">2</div>
            <div class="dot-label">Confirmată</div>
          </div>
          <div class="step-dot" data-status="expediat">
            <div class="dot-circle">3</div>
            <div class="dot-label">Expediată</div>
          </div>
          <div class="step-dot" data-status="livrat">
            <div class="dot-circle">4</div>
            <div class="dot-label">Livrată</div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



<script>
const catEmoji = {
  gaming: '🎮', beauty: '💄', gadget: '📱', snack: '🍫', sport: '🏋️'
};

const STATUS_ORDER = ['nou', 'confirmat', 'expediat', 'livrat'];
const STATUS_LABEL = {
  nou:       'Înregistrată',
  confirmat: 'Confirmată',
  expediat:  'Expediată',
  livrat:    'Livrată'
};

function updateProgress(status) {
  const currentIdx = STATUS_ORDER.indexOf(status);
  document.querySelectorAll('.step-dot').forEach((dot, i) => {
    dot.classList.remove('done', 'active');
    if (i < currentIdx) dot.classList.add('done');
    else if (i === currentIdx) dot.classList.add('active');
  });
}

function showResult(c) {
  document.getElementById('rId').textContent     = c.id;
  document.getElementById('rStatus').textContent = STATUS_LABEL[c.status] || c.status;
  document.getElementById('rNume').textContent   = c.nume;
  document.getElementById('rData').textContent   = c.data;
  document.getElementById('rCat').textContent    = (catEmoji[c.categorie] || '📦') + ' ' + c.categorie.charAt(0).toUpperCase() + c.categorie.slice(1);
  document.getElementById('rNivel').textContent  = c.nivel.charAt(0).toUpperCase() + c.nivel.slice(1);
  document.getElementById('rPret').textContent   = c.pret;
  document.getElementById('rPlata').textContent  = c.plata === 'card' ? '💳 Card bancar' : '💵 Ramburs la livrare';
  document.getElementById('rAdresa').textContent = c.adresa;

  updateProgress(c.status);

  document.getElementById('resultCard').classList.add('show');
}

function doSearch() {
  const val = document.getElementById('trackInput').value.trim();
  const errBox = document.getElementById('errorBox');
  const btn    = document.getElementById('trackBtn');

  errBox.classList.remove('show');
  document.getElementById('resultCard').classList.remove('show');

  if (!val) {
    errBox.textContent = 'Introdu un ID de comandă.';
    errBox.classList.add('show');
    return;
  }

  // Format automat: daca nu are MB- il adauga
  const id = val.toUpperCase().startsWith('MB-') ? val.toUpperCase() : 'MB-' + val.toUpperCase();

  btn.textContent = 'Se caută…';
  btn.classList.add('loading');

  // AJAX fetch catre tracking.php?ajax=1&id=...
  fetch('tracking.php?ajax=1&id=' + encodeURIComponent(id))
    .then(r => r.json())
    .then(resp => {
      btn.textContent = 'Caută →';
      btn.classList.remove('loading');

      if (resp.found) {
        showResult(resp.comanda);
      } else {
        errBox.textContent = '❌ ' + (resp.error || 'ID-ul nu a fost găsit.');
        errBox.classList.add('show');
      }
    })
    .catch(() => {
      btn.textContent = 'Caută →';
      btn.classList.remove('loading');
      errBox.textContent = 'Eroare de conexiune. Verifică că XAMPP rulează.';
      errBox.classList.add('show');
    });
}

document.getElementById('trackBtn').addEventListener('click', doSearch);

// Enter key
document.getElementById('trackInput').addEventListener('keydown', e => {
  if (e.key === 'Enter') doSearch();
});

// Auto-format input: adauga MB- prefix vizual
document.getElementById('trackInput').addEventListener('input', function() {
  let v = this.value.toUpperCase().replace(/[^A-Z0-9-]/g, '');
  if (v.length > 0 && !v.startsWith('MB-')) {
    if (v.startsWith('MB')) v = 'MB-' + v.slice(2);
  }
  this.value = v;
});

// Reveal
const obs = new IntersectionObserver(
  e => e.forEach(x => { if (x.isIntersecting) x.target.classList.add('visible'); }),
  { threshold: .1 }
);
document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

// Daca URL contine ?id=... (venit din overlay cutii.html), pre-completeaza si cauta automat
const urlParams = new URLSearchParams(window.location.search);
const preId = urlParams.get('id');
if (preId) {
  document.getElementById('trackInput').value = preId.toUpperCase();
  // Mici delay ca pagina sa fie gata
  setTimeout(doSearch, 300);
}
</script>

</body>
</html>
