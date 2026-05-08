<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regime - Mon porte-monnaie</title>
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

        main{max-width:1100px;margin:24px auto;padding:0 16px;display:flex;flex-direction:column;gap:18px}
        .page-title{font-size:2rem;font-weight:900;color:var(--accent);margin:0}
        .page-subtitle{color:var(--muted);margin:0}
        .card{background:var(--card);border-radius:var(--radius);padding:28px;border:1px solid rgba(155, 160, 122, 0.25);box-shadow:var(--shadow);display:flex;flex-direction:column;gap:16px}
        .card.recharge{max-width:560px;width:100%;min-height:520px;margin:0 auto;}
        .balance{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap}
        .balance .amount{font-size:2.2rem;font-weight:900;color:var(--accent)}
        .pill{padding:6px 12px;border-radius:999px;background:rgba(108,53,104,0.08);color:var(--accent);font-weight:800;font-size:0.85rem}
        .alert{padding:12px 14px;border-radius:12px;font-weight:700}
        .alert.error{background:rgba(166, 0, 0, 0.1);color:#7a0d0d;border:1px solid rgba(166, 0, 0, 0.25)}
        .alert.success{background:rgba(0, 140, 80, 0.12);color:#0b5c3a;border:1px solid rgba(0, 140, 80, 0.25)}
        .form{display:flex;flex-direction:column;gap:22px}
        .form button{margin-top:8px}
        .field{display:flex;flex-direction:column;gap:6px}
        label{font-weight:700;color:var(--text)}
        input[type="number"]{padding:12px 14px;border-radius:12px;border:2px solid rgba(155, 160, 122, 0.35);font-size:1rem;outline:none}
        input[type="number"]:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(108,53,104,0.15)}
        button{padding:12px 16px;border:none;border-radius:999px;background:var(--accent-2);color:#1d1b1b;font-weight:900;cursor:pointer}
        button:hover{background:#939700}

        @media (max-width:720px){
            header{padding:14px 18px}
            nav{flex-wrap:wrap;gap:8px}
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
            <a class="nav-link primary" href="<?= site_url('porte-monnaie') ?>">Mon porte-monnaie</a>
            <a class="nav-link" href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a class="nav-link" href="<?= site_url('statistiques') ?>">Statistiques</a>
            <a class="nav-link" href="<?= site_url('traitements') ?>">Mes traitements</a>
            <a class="nav-link" href="<?= site_url('logout') ?>">Deconnexion</a>
        </nav>
    </header>

    <main>
        <div>
            <h1 class="page-title">Votre porte-monnaie</h1>
            <p class="page-subtitle">Consultez votre solde et rechargez votre compte en toute securite.</p>
        </div>

        <section class="card recharge">
            <?php if (isset($porteMonnaie['solde'])): ?>
                <div class="balance">
                    <div>
                        <div class="pill">Solde actuel</div>
                        <div class="amount"><?= esc($porteMonnaie['solde']) ?> Ar</div>
                    </div>
                    <div class="page-subtitle">Gardez un solde positif pour profiter des programmes.</div>
                </div>
            <?php else: ?>
                <div class="alert error">Porte-monnaie non trouve</div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert error"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <form class="form" action="/porte-monnaie/recharger" method="post">
                <div class="field">
                    <label for="code">Entrer le code pour recharger</label>
                    <input type="number" id="code" name="code" required>
                </div>
                <button type="submit">Recharger</button>
            </form>
        </section>
    </main>
</body>
</html>