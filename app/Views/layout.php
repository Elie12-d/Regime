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
        .site-footer {
            margin-top: auto;
            padding: 16px 24px;
            text-align: center;
            color: #6b6d8f;
            font-size: 0.9rem;
            font-weight: 600;
            border-top: 1px solid rgba(155, 160, 122, 0.25);
            background: linear-gradient(180deg, #ffffff, rgba(108, 53, 104, 0.04));
            box-shadow: 0 -6px 18px rgba(42, 15, 53, 0.06);
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