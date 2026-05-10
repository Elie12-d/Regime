<?php
$title = 'Liste des regimes';
$activePage = '';
?>

<?= $this->extend('layout') ?>

<?= $this->section('head') ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800;900&family=Unbounded:wght@500;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
        :root {
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
            --accent-soft: rgba(108, 53, 104, 0.12);
        }

        * {
            box-sizing: border-box
        }

        body {
            font-family: 'Poppins', system-ui, sans-serif;
            background: linear-gradient(180deg, var(--bg), #ffffff 60%);
            color: var(--text);
            margin: 0;
            -webkit-font-smoothing: antialiased
        }
        body::before,
        body::after{
            content:"";
            position:fixed;
            width:320px;
            height:320px;
            border-radius:50%;
            filter:blur(0px);
            opacity:0.28;
            z-index:-1;
        }
        body::before{
            top:-120px;
            left:-80px;
            background:radial-gradient(circle at 30% 30%, rgba(166, 168, 0, 0.35), transparent 60%);
        }
        body::after{
            bottom:-140px;
            right:-60px;
            background:radial-gradient(circle at 70% 70%, rgba(108, 53, 104, 0.25), transparent 60%);
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 40px;
            background: linear-gradient(90deg, #ffffff, rgba(108, 53, 104, 0.05));
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05)
        }

        .brand {
            display: flex;
            gap: 12px;
            align-items: center
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--accent-4));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: white;
            font-size: 1.5rem
        }

        .site-title {
            font-weight: 900;
            font-size: 1.3rem;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px
        }

        nav {
            display: flex;
            gap: 15px;
            align-items: center
        }

        .nav-link {
            padding: 10px 18px;
            border-radius: 25px;
            text-decoration: none;
            color: var(--text);
            font-weight: 600;
            transition: all .2s;
            border: 2px solid transparent;
        }

        .nav-link:hover {
            background: var(--glass);
            color: var(--accent);
        }

        .nav-link.primary {
            background: var(--accent);
            color: white;
            border-radius: 25px;
            box-shadow: 0 4px 10px rgba(108, 53, 104, 0.25);
        }

        .nav-link.primary:hover {
            background: #5a2d57;
            color: white;
            transform: scale(1.05);
        }

        main {
            max-width: 1440px;
            margin: 18px auto 24px;
            padding: 0 16px;
            display: flex;
            flex-direction: column;
            gap: 14px
        }

        .page-title {
            font-family:'Unbounded', 'Poppins', system-ui, sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--accent);
            margin: 0
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 0.95rem;
            margin: 0
        }


            .page-hero{
                display:flex;
                align-items:flex-end;
                justify-content:space-between;
                gap:16px;
                flex-wrap:wrap;
            }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 14px
        }

        .card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 18px;
            border: 1px solid rgba(155, 160, 122, 0.25);
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 12px;
            position:relative;
            overflow:hidden;
            transition:transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
            animation:rise 0.6s ease both;
        }
        .card::after{
            content:"";
            position:absolute;
            inset:0;
            border-radius:var(--radius);
            border:1px solid transparent;
            background:linear-gradient(120deg, rgba(108,53,104,0.3), rgba(166,168,0,0.35)) border-box;
            -webkit-mask:linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite:xor;
            mask-composite:exclude;
            opacity:0.35;
            pointer-events:none;
        }
        .card:hover{
            transform:translateY(-6px);
            box-shadow:0 18px 36px rgba(42, 15, 53, 0.14);
            border-color:rgba(108,53,104,0.3);
        }
        .grid > .card:nth-child(1){animation-delay:0.05s}
        .grid > .card:nth-child(2){animation-delay:0.1s}
        .grid > .card:nth-child(3){animation-delay:0.15s}
        .grid > .card:nth-child(4){animation-delay:0.2s}
        .grid > .card:nth-child(5){animation-delay:0.25s}
        .grid > .card:nth-child(6){animation-delay:0.3s}

        .card h3 {
            margin: 0;
            font-size: 1.05rem;
            color: var(--text)
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 4px
        }

        .chip {
            padding: 5px 8px;
            border-radius: 999px;
            background: rgba(108, 53, 104, 0.08);
            color: var(--accent);
            font-weight: 700;
            font-size: 0.75rem
        }

        .bars {
            display: flex;
            flex-direction: column;
            gap: 8px
        }

        .bar-row {
            display: flex;
            align-items: center;
            gap: 8px
        }

        .bar-label {
            min-width: 70px;
            font-size: 0.75rem;
            color: var(--muted);
            font-weight: 700
        }

        .bar {
            flex: 1;
            height: 7px;
            background: rgba(155, 160, 122, 0.2);
            border-radius: 999px;
            overflow: hidden
        }

        .bar-fill {
            height: 100%;
            border-radius: 999px
        }

        .bar-fill.meat {
            background: var(--accent)
        }

        .bar-fill.volaille {
            background: var(--accent-4)
        }

        .bar-fill.poisson {
            background: var(--accent-3)
        }

        .bar-value {
            min-width: 44px;
            text-align: right;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text)
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
            margin-top: 6px
        }

        .stat {
            background: rgba(155, 160, 122, 0.12);
            border-radius: 12px;
                        padding: 6px
        }

        .stat .label {
            color: var(--muted);
            font-size: 0.72rem
        }

        .stat .value {
            font-weight: 800;
            font-size: 0.9rem;
            color: var(--text)
        }

        .desc {
            color: var(--text);
            line-height: 1.6;
            font-size: 0.95rem;
            margin-top: 4px
        }

        .cta {
            margin-top: 8px
        }
        .select{
            display:inline-flex;
            align-items:center;
            gap:10px;
            font-weight:800;
            color:var(--text);
            font-size:0.9rem;
        }
        .card-checkbox{
            appearance:none;
            width:20px;
            height:20px;
            border-radius:6px;
            border:2px solid rgba(108,53,104,0.4);
            display:grid;
            place-items:center;
            background:#fff;
            cursor:pointer;
            transition:all 0.2s ease;
        }
        .card-checkbox::after{
            content:"";
            width:10px;
            height:10px;
            border-radius:3px;
            background:var(--accent);
            transform:scale(0);
            transition:transform 0.2s ease;
        }
        .card-checkbox:checked{
            border-color:var(--accent-2);
            box-shadow:0 0 0 4px rgba(166,168,0,0.2);
        }
        .card-checkbox:checked::after{
            background:var(--accent-2);
            transform:scale(1);
        }

        .command-bar{
            position:sticky;
            bottom:16px;
            align-self:flex-end;
            background:rgba(255,255,255,0.9);
            border:1px solid rgba(155, 160, 122, 0.25);
            box-shadow:var(--shadow);
            border-radius:999px;
            padding:6px 8px;
            display:flex;
            gap:10px;
            align-items:center;
            backdrop-filter:blur(6px);
        }
        .command-bar a{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:6px 12px;
            border-radius:999px;
            background:var(--accent-2);
            color:#1d1b1b;
            text-decoration:none;
            font-weight:800;
            text-transform:uppercase;
            font-size:0.85rem;
        }
        .command-bar a:hover{background:#939700}

        @keyframes rise{
            from{opacity:0;transform:translateY(12px)}
            to{opacity:1;transform:translateY(0)}
        }

        @media (max-width:720px) {
            header {
                padding: 14px 18px
            }

            nav {
                flex-wrap: wrap;
                gap: 8px
            }

            .page-title {
                font-size: 1.7rem
            }
        }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main>
        <div class="page-hero">
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
                            <div class="value"><?= $regime['prixParJour'] ?> Ar</div>
                        </div>
                        <div class="stat">
                            <div class="label">Variation de poids</div>
                            <div class="value"><?= $regime['variationPoids'] ?> kg</div>
                        </div>
                    </div>
                    <div class="desc"><?= $regime['description'] ?></div>
                    <div class="cta">
                        <label class="select">
                            <input type="checkbox" class="card-checkbox" value="<?= $regime['id'] ?>">
                            Selectionner
                        </label>
                    </div>
                </article>
            <?php } ?>
        </div>
        <div class="command-bar">
            <a href="#" onclick="commanderRegime(<?= $idCategorieObjectif ?>)">Commander</a>
        </div>
</main>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
        async function commanderRegime(idCategorieObjectif) {
            // recuperation
            let checkboxes = document.querySelectorAll('.card-checkbox:checked');
            let idsSelectionnes = Array.from(checkboxes).map(cb => cb.value);

            // validation au moins 1
            if (idsSelectionnes.length === 0) {
                Swal.fire({
                    title: 'Aucune selection',
                    text: 'Veuillez selectionner au moins un regime',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Definir le message du prompt selon l'objectif
            let message = "";
            let inputLabel = "";
            let inputStep = "0.1";
            let inputMin = "0.1";
            if (idCategorieObjectif == 1) {
                message = "Entrez le kg a perdre";
                inputLabel = "Kg a perdre";
            } else if (idCategorieObjectif == 2) {
                message = "Entrez le nombre de jours";
                inputLabel = "Nombre de jours";
                inputStep = "1";
                inputMin = "1";
            } else if (idCategorieObjectif == 3) {
                message = "Entrez le kg a atteindre";
                inputLabel = "Kg a atteindre";
            }

            const result = await Swal.fire({
                title: message,
                input: 'number',
                inputLabel: inputLabel,
                inputAttributes: {
                    min: inputMin,
                    step: inputStep,
                },
                inputPlaceholder: inputLabel,
                showCancelButton: true,
                confirmButtonText: 'Valider',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#6c3568',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Veuillez entrer une valeur';
                    }
                    if (Number.isNaN(parseFloat(value)) || parseFloat(value) <= 0) {
                        return 'Valeur invalide';
                    }
                    return undefined;
                }
            });

            if (!result.isConfirmed) {
                return;
            }

            const kgOuNbJour = parseFloat(result.value);

            // Envoyer les données
            fetch("<?= site_url('paiement/sauvegarderSession') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        ids_regimes: idsSelectionnes,
                        valeur: parseFloat(kgOuNbJour)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "<?= site_url('paiement/traitement') ?>";
                    } else {
                        alert("Erreur: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert("Erreur lors de la sauvegarde");
                });
        }
</script>
<?= $this->endSection() ?>