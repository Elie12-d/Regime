<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            max-width:1200px;
            margin:24px auto 40px;
            padding:0 16px;
            display:grid;
            grid-template-columns:1.2fr 0.8fr;
            gap:18px;
            align-items:start;
        }
        .card{background:var(--card);border-radius:var(--radius);padding:28px;border:1px solid rgba(155, 160, 122, 0.25);box-shadow:var(--shadow)}
        .card h2{margin:0 0 14px;font-size:1.5rem;color:var(--accent);font-weight:900}
        .subtle{color:var(--muted);font-size:0.95rem;margin:0 0 16px}

        .regime-list{display:flex;flex-direction:column;gap:12px}
        .regime-item{
            padding:14px 16px;
            border-radius:14px;
            border:1px solid rgba(155, 160, 122, 0.2);
            background:linear-gradient(180deg,#ffffff,rgba(108,53,104,0.04));
            display:grid;
            grid-template-columns:1fr auto;
            gap:10px;
            align-items:center;
        }
        .regime-name{font-weight:800;color:var(--text)}
        .regime-qty{font-weight:700;color:var(--accent-4)}
        .regime-meta{color:var(--muted);font-size:0.95rem}
        .regime-total{font-weight:900;color:var(--accent)}

        .summary-box{display:flex;flex-direction:column;gap:14px}
        .summary-row{display:flex;align-items:center;justify-content:space-between;font-weight:700}
        .summary-row strong{color:var(--accent)}
        .summary-total{
            padding:16px;
            border-radius:16px;
            background:rgba(166, 168, 0, 0.12);
            border:2px solid var(--accent-2);
            font-size:1.2rem;
            font-weight:900;
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .cta{
            margin-top:6px;
            padding:14px 20px;
            border-radius:999px;
            border:3px solid var(--accent);
            background:linear-gradient(180deg,#ffffff,rgba(108,53,104,0.06));
            color:var(--accent);
            font-weight:900;
            text-transform:uppercase;
            cursor:pointer;
            transition:all 0.25s ease;
            text-align:center;
        }
        .cta:hover{background:var(--accent-2);color:#1d1b1b;border-color:var(--accent-2);transform:translateY(-2px);box-shadow:0 12px 24px rgba(106, 110, 166, 0.28)}
        .hint{margin:0;color:var(--muted);font-size:0.95rem}

        @media (max-width:900px){
            header{padding:14px 20px;flex-wrap:wrap;gap:12px}
            nav{flex-wrap:wrap;justify-content:center}
            main{grid-template-columns:1fr}
        }
    </style>
</head>

<body>
    <header>
        <div class="brand">
            <div class="logo">R</div>
            <div>
                <div class="site-title">Regime & Sante</div>
                <div class="subtle">Programmes nutritifs & activites personnalisees</div>
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
        <section class="card">
            <h2>Liste des regimes selectionnes</h2>
            <p class="subtle">Retrouvez le detail de vos regimes avant le paiement.</p>
            <div class="regime-list">
                <?php foreach ($listeRegimes as $regime) { ?>
                    <div class="regime-item">
                        <div>
                            <div class="regime-name"><?= esc($regime['nom']) ?></div>
                            <div class="regime-meta">PU: <?= esc($regime['prix']) ?> Ar</div>
                        </div>
                        <div style="text-align:right">
                            <div class="regime-qty">Quantite: <?= esc($regime['quantite']) ?></div>
                            <div class="regime-total">Sous-total: <?= esc($regime['sous_total']) ?> Ar</div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <section class="card">
            <h2>Paiement des regimes</h2>
            <p class="subtle">Verifiez votre solde avant de confirmer.</p>
            <div class="summary-box">
                <div class="summary-row">
                    <span>Solde disponible</span>
                    <strong><?= esc($solde) ?> Ar</strong>
                </div>
                <div class="summary-total">
                    <span>Total a payer</span>
                    <span><?= esc($prixTotal) ?> Ar</span>
                </div>
                <button class="cta" type="button" onclick="payer(listeRegimes, prixTotal, solde)">Payer</button>
                <p class="hint">Le paiement sera effectue apres validation de votre solde.</p>
            </div>
        </section>
    </main>
    <script>
        const listeRegimes = <?= json_encode($listeRegimes, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        const prixTotal = <?= json_encode($prixTotal, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        const solde = <?= json_encode($solde, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

        function payer(listeRegime, prixTotal, soldeUtilisateur) {
            if (!Array.isArray(listeRegime) || listeRegime.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Aucun regime selectionne',
                    text: 'Veuillez choisir au moins un regime avant le paiement.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#6c3568'
                });
                return;
            }

            if (parseFloat(soldeUtilisateur) < parseFloat(prixTotal)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Solde insuffisant',
                    text: 'Veuillez recharger votre porte-monnaie avant de payer.',
                    confirmButtonText: 'Recharger',
                    confirmButtonColor: '#6c3568'
                });
                return;
            }

            const payload = {
                regimes: listeRegime.map(item => ({
                    regime_id: item.id,
                    quantite: item.quantite,
                    prixPaye: item.prix * item.quantite
                })),
                prixTotal: prixTotal
            };

            fetch('<?= site_url('/achat-regime/payer') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Paiement reussi',
                        text: data.message || 'Votre paiement a ete valide.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#6c3568'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Paiement echoue',
                        text: data.message || 'Le paiement a echoue. Veuillez reessayer.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#6c3568'
                    });
                }
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur reseau',
                    text: 'Erreur reseau lors du paiement. Veuillez reessayer.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#6c3568'
                });
            });
        }
    </script>
</body>

</html>