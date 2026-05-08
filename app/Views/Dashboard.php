<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suivi de votre santé</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg: #f6f4f8; /* soft off-white */
            --card: #ffffff;
            --muted: #6b6d8f; /* slate from palette */
            --text: #2a0f35; /* deep plum */
            --accent: #6c3568; /* plum */
            --accent-2: #a6a800; /* olive */
            --accent-3: #9ba07a; /* sage */
            --accent-4: #6a6ea6; /* slate purple */
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

        main{
            max-width:1440px;
            margin:20px auto;
            padding:0 12px;
            display:grid;
            grid-template-columns:1.15fr 1fr;
            grid-template-areas:
                "imc levels"
                "actions actions";
            gap:18px;
            align-items:start;
        }
        .card{background:var(--card);border-radius:var(--radius);padding:30px;border:1px solid rgba(155, 160, 122, 0.25);box-shadow:var(--shadow)}
        .card.imc{padding:38px;}
        .imc{display:flex;flex-direction:column;gap:8px}
        .imc{grid-area:imc;}
        .imc-levels{grid-area:levels;}
        .actions-container{grid-area:actions;}
        .imc .value{font-size:4rem;font-weight:900;line-height:1;color:var(--accent)}
        .imc .title{font-size:1.2rem;color:var(--accent-4);margin-top:8px;font-weight:800;text-transform:uppercase}
        .imc p{color:var(--muted);margin:14px 0 0; font-size:1.05rem; line-height:1.5}
        .imc-description{
            margin-top:12px;
            padding:14px 16px;
            border-left:6px solid var(--accent-2);
            background:rgba(155, 160, 122, 0.18);
            color:var(--text);
            font-weight:700;
            font-size:1.05rem;
            line-height:1.7;
            border-radius:12px;
        }
        .imc-levels{
            display:flex;
            flex-direction:column;
            gap:14px;
        }
        .imc-levels-header{
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .imc-badge{
            padding:6px 12px;
            border-radius:999px;
            background:rgba(108, 53, 104, 0.12);
            color:var(--accent);
            font-weight:800;
            font-size:0.95rem;
        }
        .imc-table{
            display:flex;
            flex-direction:column;
            gap:10px;
        }
        .imc-row{
            display:grid;
            grid-template-columns:1fr auto;
            gap:16px;
            align-items:center;
            padding:12px 14px;
            border-radius:12px;
            background:#ffffff;
            border:1px solid rgba(155, 160, 122, 0.2);
        }
        .imc-row .label{
            font-weight:700;
            color:var(--text);
        }
        .imc-row .range{
            font-weight:800;
            color:var(--accent-4);
        }
        .imc-row.active{
            border:2px solid var(--accent-2);
            background:rgba(166, 168, 0, 0.12);
        }

        .actions-container{margin-top:0; text-align:center; padding: 28px; background:linear-gradient(180deg,#ffffff,rgba(155,160,122,0.08)); border-radius:var(--radius); border:1px solid rgba(155, 160, 122, 0.25); box-shadow:var(--shadow)}
        .actions-container h3 {font-size: 2rem; font-weight: 800; color: var(--accent); margin: 0 0 20px; font-family: 'Poppins', sans-serif;}
        .imc-actions{display:flex; gap:20px; justify-content:center; flex-wrap:wrap;}
        .cat-large{
            flex: 1; 
            min-width: 250px;
            padding: 24px 20px; 
            border-radius: 40px;
            background: linear-gradient(180deg,#ffffff,rgba(108,53,104,0.06)); 
            color: var(--accent); 
            border: 3px solid var(--accent);
            font-weight: 800; 
            text-align: center; 
            font-size: 1.3rem; 
            cursor: pointer; 
            transition: all 0.3s ease; 
            white-space: normal;
            box-shadow: 0 4px 15px rgba(114, 52, 103, 0.1);
            text-transform: uppercase;
        }
        .cat-large:hover{
            transform: translateY(-5px); 
            box-shadow: 0 12px 24px rgba(106, 110, 166, 0.35); 
            background: var(--accent-2);
            color: #1d1b1b;
            border-color: var(--accent-2);
        }
        @media (max-width:600px){.imc-actions{flex-direction:column}}

        .categories{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:10px;margin-top:14px}
        .cat-btn{display:inline-flex;align-items:center;justify-content:center;padding:12px;border-radius:10px;background:var(--bg);color:var(--text);border:2px solid var(--accent-3);text-decoration:none;font-weight:700;transition:all 0.2s}
        .cat-btn:hover{background:var(--accent-3); color:white;}

        .muted{color:var(--muted)}

        @media (max-width:1200px){
            main{
                grid-template-columns:1fr;
                grid-template-areas:
                    "imc"
                    "levels"
                    "actions";
            }
        }
        form{margin:0}
        form button{all:unset;cursor:pointer}
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <div class="logo">R</div>
            <div>
                <div class="site-title">Regime & Santé</div>
                <div class="muted" style="font-size:12px">Programmes nutritifs & activités personnalisées</div>
            </div>
        </div>
        <nav>
            <a class="nav-link" href="<?= site_url('porte-monnaie') ?>">Mon porte-monnaie</a>
            <a class="nav-link primary" href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a class="nav-link" href="<?= site_url('statistiques') ?>">Statistiques</a>
            <a class="nav-link" href="<?= site_url('logout') ?>">Déconnexion</a>
        </nav>
    </header>

    <main>
        <?php
            $imcValue = (float) str_replace(',', '.', (string) $imc);
        ?>
        <section class="card imc">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
                <div>
                    <div style="font-size:12px;color:var(--muted);font-weight:700">Votre Indice de Masse Corporelle (IMC)</div>
                    <div class="value"><?= esc($imc) ?></div>
                    <div class="title"><?= esc($titre) ?></div>
                </div>
                <div style="text-align:right;min-width:220px">
                    <div style="color:var(--muted);font-size:12px">Conseil rapide</div>
                    <div class="imc-description"><?= esc($description) ?></div>
                </div>
            </div>
        </section>

        <section class="card imc-levels">
            <div class="imc-levels-header">
                <div style="font-weight:800;font-size:1.2rem;color:var(--text)">Niveaux d'IMC</div>
                <div class="imc-badge">Votre IMC: <?= esc($imc) ?></div>
            </div>
            <div class="imc-table">
                <?php foreach ($imcs as $range) {
                    $min = $range['minImc'];
                    $max = $range['maxImc'];
                    $isActive = ($min === null ? $imcValue < $max : ($max === null ? $imcValue >= $min : ($imcValue >= $min && $imcValue < $max)));
                ?>
                    <div class="imc-row <?= $isActive ? 'active' : '' ?>">
                        <div class="label"><?= esc($range['label']) ?></div>
                        <div class="range"><?= esc($min) ?> - <?= esc($max) ?></div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- Container des objectifs façon "Comme J'aime" -->
        <div class="actions-container">
            <h3>Quel est votre objectif aujourd'hui ?</h3>
            <div class="imc-actions">
                <?php foreach ($categorieObjectif as $categorie){ ?>
                    <form action="<?= site_url('objectif/' . $categorie['id']) ?>" method="post">
                        <button class="cat-large" type="submit"><?= esc($categorie['label']) ?></button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </main>
</body>
</html>