<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes traitements</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg: #f6f4f8;
            --card: #ffffff;
            --muted: #6b6d8f;
            --text: #2a0f35;
            --accent: #6c3568;
            --accent-2: #a6a800;
            --accent-3: #9ba07a;
            --accent-4: #6a6ea6;
            --glass: rgba(108, 53, 104, 0.06);
            --radius: 20px;
            --shadow: 0 10px 30px rgba(42, 15, 53, 0.08);
        }
        *{box-sizing:border-box}
        body{
            font-family:'Poppins',system-ui,sans-serif;
            background:linear-gradient(180deg,var(--bg),#ffffff 60%);
            color:var(--text);
            margin:0;
            -webkit-font-smoothing:antialiased;
        }
        header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:16px 40px;
            background:linear-gradient(90deg,#ffffff,rgba(108,53,104,0.05));
            position:sticky;
            top:0;
            z-index:10;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }
        .brand{display:flex;gap:12px;align-items:center}
        .logo{width:50px;height:50px;border-radius:12px;background:linear-gradient(135deg,var(--accent),var(--accent-4));display:flex;align-items:center;justify-content:center;font-weight:900;color:white;font-size:1.5rem}
        .site-title{font-weight:900;font-size:1.3rem;color:var(--accent);text-transform:uppercase;letter-spacing:1px}
        nav{display:flex;gap:15px;align-items:center}
        .nav-link{padding:10px 18px;border-radius:25px;text-decoration:none;color:var(--text);font-weight:600;transition:all .2s; border: 2px solid transparent;}
        .nav-link:hover{background:var(--glass);color:var(--accent);}
        .nav-link.primary{background:var(--accent);color:white;border-radius:25px;box-shadow:0 4px 10px rgba(108, 53, 104, 0.25);}
        .nav-link.primary:hover{background:#5a2d57;color:white;transform:scale(1.05);}

        main{
            max-width:1440px;
            margin:20px auto 40px;
            padding:0 16px;
            display:flex;
            flex-direction:column;
            gap:18px;
        }
        .muted{color:var(--muted)}
        .page-hero{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:16px;
            flex-wrap:wrap;
        }
        .page-hero h1{margin:0;font-size:2rem;color:var(--accent);font-weight:900}
        .page-hero p{margin:6px 0 0;color:var(--muted);font-size:1rem}

        .day-card{
            background:var(--card);
            border-radius:var(--radius);
            padding:24px;
            border:1px solid rgba(155, 160, 122, 0.25);
            box-shadow:var(--shadow);
        }
        .day-header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:16px;
            gap:12px;
            flex-wrap:wrap;
        }
        .day-title{
            font-weight:900;
            color:var(--accent);
            font-size:1.15rem;
            text-transform:uppercase;
            letter-spacing:0.5px;
        }
        .day-count{
            padding:6px 12px;
            border-radius:999px;
            background:rgba(108, 53, 104, 0.12);
            color:var(--accent);
            font-weight:800;
            font-size:0.9rem;
        }
        .regime-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
            gap:16px;
        }
        .regime-card{
            background:linear-gradient(180deg,#ffffff,rgba(108,53,104,0.05));
            border:1px solid rgba(155, 160, 122, 0.2);
            border-radius:18px;
            padding:18px;
            box-shadow:0 8px 20px rgba(42, 15, 53, 0.08);
            display:flex;
            flex-direction:column;
            gap:12px;
        }
        .regime-top{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:12px;
        }
        .regime-title{
            font-size:1.1rem;
            font-weight:900;
            color:var(--text);
            margin:0;
        }
        .regime-desc{margin:0;color:var(--muted);font-size:0.95rem;line-height:1.5}
        .chip{
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:6px 10px;
            border-radius:999px;
            background:rgba(155, 160, 122, 0.2);
            color:var(--text);
            font-weight:800;
            font-size:0.85rem;
        }
        .chip-row{display:flex;gap:8px;flex-wrap:wrap}

        .bar-list{display:flex;flex-direction:column;gap:8px}
        .bar-row{
            display:grid;
            grid-template-columns:70px 1fr 44px;
            gap:10px;
            align-items:center;
            font-size:0.9rem;
            color:var(--muted);
        }
        .bar{height:8px;border-radius:999px;background:#ecebf0;overflow:hidden}
        .bar span{display:block;height:100%;border-radius:999px}
        .bar.viande span{background:var(--accent)}
        .bar.volaille span{background:var(--accent-4)}
        .bar.poisson span{background:var(--accent-3)}

        .stat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:10px}
        .stat{
            background:rgba(155, 160, 122, 0.18);
            border-radius:12px;
            padding:10px 12px;
        }
        .stat span{display:block;color:var(--muted);font-size:0.85rem}
        .stat strong{display:block;color:var(--text);font-size:1rem}

        .empty-card{
            background:var(--card);
            border-radius:var(--radius);
            padding:30px;
            border:1px solid rgba(155, 160, 122, 0.25);
            box-shadow:var(--shadow);
            text-align:center;
        }
        .cta-link{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:12px 20px;
            border-radius:999px;
            border:3px solid var(--accent);
            background:linear-gradient(180deg,#ffffff,rgba(108,53,104,0.06));
            color:var(--accent);
            font-weight:900;
            text-decoration:none;
            text-transform:uppercase;
            transition:all 0.25s ease;
            margin-top:14px;
        }
        .cta-link:hover{background:var(--accent-2);color:#1d1b1b;border-color:var(--accent-2);transform:translateY(-2px);box-shadow:0 12px 24px rgba(106, 110, 166, 0.28)}

        @media (max-width:900px){
            header{padding:14px 20px;flex-wrap:wrap;gap:12px}
            nav{flex-wrap:wrap;justify-content:center}
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <div class="logo">R</div>
            <div>
                <div class="site-title">Regime & Sante</div>
                <div class="muted" style="font-size:12px">Programmes nutritifs & activites personnalisees</div>
            </div>
        </div>
        <nav>
            <a class="nav-link" href="<?= site_url('porte-monnaie') ?>">Mon porte-monnaie</a>
            <a class="nav-link" href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a class="nav-link" href="<?= site_url('statistiques') ?>">Statistiques</a>
            <a class="nav-link primary" href="<?= site_url('traitements') ?>">Mes traitements</a>
            <a class="nav-link" href="<?= site_url('logout') ?>">Deconnexion</a>
        </nav>
    </header>

    <main>
        <section class="page-hero">
            <div>
                <h1>Mes traitements</h1>
                <p>Historique des regimes achetes, groupe par jour.</p>
            </div>
        </section>

        <?php if (empty($listRegimesByDate)): ?>
            <section class="empty-card">
                <h2 style="margin:0 0 10px">Aucun traitement</h2>
                <p class="muted" style="margin:0">Vous n'avez pas encore achete de regimes.</p>
                <a class="cta-link" href="<?= site_url('dashboard') ?>">Explorer les regimes</a>
            </section>
        <?php else: ?>
            <?php foreach ($listRegimesByDate as $date => $regimes): ?>
                <?php
                    $totalCards = 0;
                    $groupedRegimes = [];
                    foreach ($regimes as $regime) {
                        $quantite = max(0, (int) $regime['quantite']);
                        $totalCards += $quantite;
                        $groupKey = $regime['id'] ?? ($regime['regime_id'] ?? $regime['nom']);
                        if (!isset($groupedRegimes[$groupKey])) {
                            $groupedRegimes[$groupKey] = [
                                'regime' => $regime,
                                'remaining' => 0,
                            ];
                        }
                        $groupedRegimes[$groupKey]['remaining'] += $quantite;
                    }

                    $interleavedRegimes = [];
                    $hasRemaining = true;
                    while ($hasRemaining) {
                        $hasRemaining = false;
                        foreach ($groupedRegimes as &$bucket) {
                            if ($bucket['remaining'] > 0) {
                                $interleavedRegimes[] = $bucket['regime'];
                                $bucket['remaining']--;
                                $hasRemaining = true;
                            }
                        }
                        unset($bucket);
                    }

                    $startDate = new DateTime($date);
                    $dayCount = max(1, (int) $totalCards);
                    $endDate = (clone $startDate)->modify('+' . ($dayCount - 1) . ' days');
                ?>
                <section class="day-card">
                    <div class="day-header">
                        <div class="day-title">Du <?= esc($startDate->format('d/m/Y')) ?> au <?= esc($endDate->format('d/m/Y')) ?></div>
                        <div class="day-count"><?= esc($totalCards) ?> regime(s)</div>
                    </div>
                    <div class="regime-grid">
                        <?php foreach ($interleavedRegimes as $regime): ?>
                            <?php
                                $viande = min(100, max(0, (float) $regime['pourcentageViande']));
                                $volaille = min(100, max(0, (float) $regime['pourcentageVolaille']));
                                $poisson = min(100, max(0, (float) $regime['pourcentagePoisson']));
                            ?>
                            <article class="regime-card">
                                <div class="regime-top">
                                    <h3 class="regime-title"><?= esc($regime['nom']) ?></h3>
                                </div>
                                <p class="regime-desc"><?= esc($regime['description']) ?></p>
                                <div class="chip-row">
                                    <span class="chip"><?= esc($regime['pourcentageViande']) ?>% viande</span>
                                    <span class="chip"><?= esc($regime['pourcentageVolaille']) ?>% volaille</span>
                                    <span class="chip"><?= esc($regime['pourcentagePoisson']) ?>% poisson</span>
                                </div>
                                <div class="bar-list">
                                    <div class="bar-row">
                                        <span>Viande</span>
                                        <div class="bar viande"><span style="width:<?= esc($viande) ?>%"></span></div>
                                        <strong><?= esc($regime['pourcentageViande']) ?>%</strong>
                                    </div>
                                    <div class="bar-row">
                                        <span>Volaille</span>
                                        <div class="bar volaille"><span style="width:<?= esc($volaille) ?>%"></span></div>
                                        <strong><?= esc($regime['pourcentageVolaille']) ?>%</strong>
                                    </div>
                                    <div class="bar-row">
                                        <span>Poisson</span>
                                        <div class="bar poisson"><span style="width:<?= esc($poisson) ?>%"></span></div>
                                        <strong><?= esc($regime['pourcentagePoisson']) ?>%</strong>
                                    </div>
                                </div>
                                <div class="stat-grid">
                                    <div class="stat">
                                        <span>Variation de poids</span>
                                        <strong><?= esc($regime['variationPoids']) ?> kg</strong>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</body>
</html>