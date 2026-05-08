<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des regimes</title>
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
        body{font-family:'Poppins',system-ui,sans-serif; background:linear-gradient(180deg,var(--bg),#ffffff 60%); color:var(--text); margin:0; -webkit-font-smoothing:antialiased}
        header{display:flex;align-items:center;justify-content:space-between;padding:16px 40px;background:linear-gradient(90deg,#ffffff,rgba(108,53,104,0.05));position:sticky;top:0;z-index:10;box-shadow:0 2px 10px rgba(0,0,0,0.05)}
        .brand{display:flex;gap:12px;align-items:center}
        .logo{width:50px;height:50px;border-radius:12px;background:linear-gradient(135deg,var(--accent),var(--accent-4));display:flex;align-items:center;justify-content:center;font-weight:900;color:white;font-size:1.5rem}
        .site-title{font-weight:900;font-size:1.3rem;color:var(--accent);text-transform:uppercase;letter-spacing:1px}
        nav{display:flex;gap:15px;align-items:center}
        .nav-link{padding:10px 18px;border-radius:25px;text-decoration:none;color:var(--text);font-weight:600;transition:all .2s; border: 2px solid transparent;}
        .nav-link:hover{background:var(--glass);color:var(--accent);}
        .nav-link.primary{background:var(--accent);color:white;border-radius:25px;box-shadow:0 4px 10px rgba(108, 53, 104, 0.25);}
        .nav-link.primary:hover{background:#5a2d57;color:white;transform:scale(1.05);}

        main{max-width:1440px;margin:24px auto;padding:0 16px;display:flex;flex-direction:column;gap:18px}
        .page-title{font-size:2.1rem;font-weight:900;color:var(--accent);margin:0}
        .page-subtitle{color:var(--muted);margin:0}
        .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:18px}
        .card{background:var(--card);border-radius:var(--radius);padding:30px;border:1px solid rgba(155, 160, 122, 0.25);box-shadow:var(--shadow);display:flex;flex-direction:column;gap:20px}
        .card h3{margin:0;font-size:1.3rem;color:var(--text)}
        .chips{display:flex;flex-wrap:wrap;gap:10px;margin-top:6px}
        .chip{padding:6px 10px;border-radius:999px;background:rgba(108,53,104,0.08);color:var(--accent);font-weight:700;font-size:0.85rem}
        .bars{display:flex;flex-direction:column;gap:10px}
        .bar-row{display:flex;align-items:center;gap:10px}
        .bar-label{min-width:80px;font-size:0.85rem;color:var(--muted);font-weight:700}
        .bar{flex:1;height:10px;background:rgba(155,160,122,0.2);border-radius:999px;overflow:hidden}
        .bar-fill{height:100%;border-radius:999px}
        .bar-fill.meat{background:var(--accent)}
        .bar-fill.volaille{background:var(--accent-4)}
        .bar-fill.poisson{background:var(--accent-3)}
        .bar-value{min-width:44px;text-align:right;font-size:0.85rem;font-weight:700;color:var(--text)}
        .stats{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;margin-top:8px}
        .stat{background:rgba(155,160,122,0.12);border-radius:12px;padding:10px}
        .stat .label{color:var(--muted);font-size:0.8rem}
        .stat .value{font-weight:800;color:var(--text)}
        .desc{color:var(--text);line-height:1.7;margin-top:8px}
        .cta{margin-top:14px}
        .cta a{display:inline-flex;align-items:center;justify-content:center;padding:10px 16px;border-radius:999px;background:var(--accent-2);color:#1d1b1b;text-decoration:none;font-weight:800}
        .cta a:hover{background:#939700}

        @media (max-width:720px){
            header{padding:14px 18px}
            nav{flex-wrap:wrap;gap:8px}
            .page-title{font-size:1.7rem}
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <div class="logo">R</div>
            <div>
                <div class="site-title">Regime & Sante</div>
                <div class="page-subtitle" style="font-size:12px">Programmes nutritifs & activites personnalisees</div>
            </div>
        </div>
        <nav>
            <a class="nav-link" href="<?= site_url('porte-monnaie') ?>">Mon porte-monnaie</a>
            <a class="nav-link" href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a class="nav-link" href="<?= site_url('statistiques') ?>">Statistiques</a>
            <a class="nav-link" href="<?= site_url('traitements') ?>">Mes traitements</a>
            <a class="nav-link" href="<?= site_url('logout') ?>">Deconnexion</a>
        </nav>
    </header>

    <main>
        <div>
            <h1 class="page-title">Liste des regimes</h1>
            <p class="page-subtitle">Choisissez un programme adapte a vos preferences et objectifs.</p>
        </div>

        <div class="grid">
            <?php foreach ($regimes as $regime) { ?>
                <article class="card">
                    <h3><?= $regime['nom'] ?></h3>
                    <div class="chips">
                        <span class="chip"><?= $regime['pourcentageViande'] ?>% viande</span>
                        <span class="chip"><?= $regime['pourcentageVolaille'] ?>% volaille</span>
                        <span class="chip"><?= $regime['pourcentagePoisson'] ?>% poisson</span>
                    </div>
                    <div class="bars">
                        <div class="bar-row">
                            <div class="bar-label">Viande</div>
                            <div class="bar">
                                <div class="bar-fill meat" style="width: <?= esc($regime['pourcentageViande']) ?>%"></div>
                            </div>
                            <div class="bar-value"><?= esc($regime['pourcentageViande']) ?>%</div>
                        </div>
                        <div class="bar-row">
                            <div class="bar-label">Volaille</div>
                            <div class="bar">
                                <div class="bar-fill volaille" style="width: <?= esc($regime['pourcentageVolaille']) ?>%"></div>
                            </div>
                            <div class="bar-value"><?= esc($regime['pourcentageVolaille']) ?>%</div>
                        </div>
                        <div class="bar-row">
                            <div class="bar-label">Poisson</div>
                            <div class="bar">
                                <div class="bar-fill poisson" style="width: <?= esc($regime['pourcentagePoisson']) ?>%"></div>
                            </div>
                            <div class="bar-value"><?= esc($regime['pourcentagePoisson']) ?>%</div>
                        </div>
                    </div>
                    <div class="stats">
                        <div class="stat">
                            <div class="label">Prix par jour</div>
                            <div class="value"><?= $regime['prixParJour'] ?>€</div>
                        </div>
                        <div class="stat">
                            <div class="label">Variation de poids</div>
                            <div class="value"><?= $regime['variationPoids'] ?> kg</div>
                        </div>
                    </div>
                    <div class="desc"><?= $regime['description'] ?></div>
                    <div class="cta">
                        <a href="<?= site_url('/commander') ?>/<?= $regime['id'] ?>">Commander</a>
                    </div>
                </article>
            <?php } ?>
        </div>
    </main>
</body>
</html>