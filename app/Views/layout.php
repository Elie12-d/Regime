<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Regime & Sante') ?></title>
    <style>
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .page-content {
            flex: 1;
        }
        /* Header & site styles (aligned with Dashboard view) */
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

        header{
            display:flex;align-items:center;justify-content:space-between;padding:14px 28px;background:linear-gradient(90deg,#ffffff,rgba(108,53,104,0.04));position:sticky;top:0;z-index:20;box-shadow:0 2px 10px rgba(0,0,0,0.04)
        }
        .brand{display:flex;gap:12px;align-items:center}
        .logo{width:46px;height:46px;border-radius:12px;background:linear-gradient(135deg,var(--accent),var(--accent-4));display:flex;align-items:center;justify-content:center;font-weight:900;color:white;font-size:1.4rem}
        .site-title{font-weight:900;font-size:1.05rem;color:var(--accent);text-transform:uppercase;letter-spacing:0.8px}
        nav{display:flex;gap:12px;align-items:center}
        .nav-link{padding:8px 14px;border-radius:22px;text-decoration:none;color:var(--text);font-weight:700;transition:all .18s;border:2px solid transparent}
        .nav-link:hover{background:var(--glass);color:var(--accent)}
        .nav-link.primary{background:var(--accent);color:white;box-shadow:0 4px 10px rgba(108,53,104,0.18)}

        .site-footer {
            margin-top: auto;
            padding: 12px 20px;
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
            font-weight: 600;
            border-top: 1px solid rgba(155, 160, 122, 0.18);
            background: linear-gradient(180deg, #ffffff, rgba(108, 53, 104, 0.03));
            box-shadow: 0 -6px 18px rgba(42, 15, 53, 0.04);
        }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body>
    <?php $activePage = $activePage ?? ''; ?>
    <?php $customHeader = $this->renderSection('header'); ?>
    <?php if (trim((string) $customHeader) !== ''): ?>
        <?= $customHeader ?>
    <?php else: ?>
        <header>
            <div class="brand">
                <div class="logo">R</div>
                <div>
                    <div class="site-title">Regime & Sante</div>
                    <div class="muted page-subtitle subtle" style="font-size:12px">Programmes nutritifs & activites personnalisees</div>
                </div>
            </div>
            <nav>
                <a class="nav-link<?= $activePage === 'wallet' ? ' primary' : '' ?>" href="<?= site_url('porte-monnaie') ?>">Mon porte-monnaie</a>
                <a class="nav-link<?= $activePage === 'dashboard' ? ' primary' : '' ?>" href="<?= site_url('dashboard') ?>">Dashboard</a>
                <a class="nav-link<?= $activePage === 'statistiques' ? ' primary' : '' ?>" href="<?= site_url('statistiques') ?>">Statistiques</a>
                <a class="nav-link<?= $activePage === 'traitements' ? ' primary' : '' ?>" href="<?= site_url('traitements') ?>">Mes traitements</a>
                <a class="nav-link<?= $activePage === 'logout' ? ' primary' : '' ?>" href="<?= site_url('logout') ?>">Deconnexion</a>
            </nav>
        </header>
    <?php endif; ?>

    <div class="page-content">
        <?= $this->renderSection('content') ?>
    </div>

    <footer class="site-footer">
        <div class="footer-inner">
            Regime & Sante (c) <?= date('Y') ?>. Tous droits reserves.
        </div>
    </footer>

    <?= $this->renderSection('scripts') ?>
</body>
</html>