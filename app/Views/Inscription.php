<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - Régime</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg: #f6f4f8;
            --surface: #ffffff;
            --muted: #6b6d8f;
            --text: #2a0f35;
            --accent: #6c3568;
            --accent-2: #a6a800;
            --accent-3: #9ba07a;
            --accent-4: #6a6ea6;
            --glass: rgba(108, 53, 104, 0.06);
            --border: rgba(155, 160, 122, 0.25);
            --radius: 20px;
            --shadow: 0 10px 30px rgba(42, 15, 53, 0.08);
        }
        *{box-sizing:border-box}
        body{
            font-family:'Poppins',system-ui,sans-serif;
            margin:0;
            color:var(--text);
            -webkit-font-smoothing:antialiased;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:28px;
            background:
                radial-gradient(circle at top left, rgba(108, 53, 104, 0.08), transparent 34%),
                radial-gradient(circle at bottom right, rgba(166, 168, 0, 0.10), transparent 28%),
                linear-gradient(180deg, #f6f4f8 0%, #ffffff 60%);
        }
        main{
            width:min(1180px, 100%);
            min-height:min(760px, calc(100vh - 56px));
            display:grid;
            grid-template-columns:minmax(320px, 1.05fr) minmax(420px, 0.95fr);
            overflow:hidden;
            border-radius:24px;
            box-shadow:0 24px 70px rgba(42, 15, 53, 0.12);
        }
        .hero-panel{
            position:relative;
            padding:44px 42px 36px;
            color:#f7f7f3;
            background:
                radial-gradient(circle at 22% 28%, rgba(255,255,255,0.14), transparent 12%),
                radial-gradient(circle at 72% 38%, rgba(255,255,255,0.08), transparent 10%),
                linear-gradient(180deg, #2a0f35 0%, #6c3568 100%);
            display:flex;
            flex-direction:column;
            justify-content:space-between;
        }
        .hero-panel::before,
        .hero-panel::after{
            content:"";
            position:absolute;
            border-radius:50%;
            pointer-events:none;
        }
        .hero-panel::before{
            width:260px;
            height:260px;
            right:-90px;
            top:58px;
            background:rgba(166, 168, 0, 0.12);
            filter:blur(8px);
        }
        .hero-panel::after{
            width:180px;
            height:180px;
            left:-50px;
            bottom:88px;
            background:rgba(155, 160, 122, 0.14);
            filter:blur(6px);
        }
        .hero-top,
        .hero-bottom{
            position:relative;
            z-index:1;
        }
        .hero-top{
            display:flex;
            flex-direction:column;
            align-items:center;
            text-align:center;
        }
        .brand-line{display:flex;align-items:center;gap:14px;margin-bottom:36px}
        .brand-mark{
            width:58px;
            height:58px;
            border-radius:18px;
            background:linear-gradient(135deg, var(--accent), var(--accent-4));
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:900;
            font-size:1.7rem;
            color:#fffdf8;
            box-shadow:0 16px 28px rgba(0,0,0,0.22);
        }
        .brand-name{font-size:1.1rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#d8dfc4}
        .hero-title{font-size:clamp(2.3rem, 4vw, 4.6rem);line-height:1.06;margin:0;font-weight:900;max-width:520px}
        .hero-title span{color:#f0c45f}
        .hero-copy{margin:18px 0 0;max-width:500px;color:rgba(247,247,243,0.82);font-size:1.04rem;line-height:1.8}
        .hero-note{
            margin-top:28px;
            padding:18px 20px;
            border-radius:16px;
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.12);
            color:rgba(247,247,243,0.88);
            line-height:1.75;
            text-align:left;
            max-width:500px;
        }
        .hero-bottom{margin-top:auto}
        .hero-bottom .footer-line{margin-top:0;padding-top:0;border-top:none;display:flex;align-items:center;justify-content:center;gap:12px;color:rgba(247,247,243,0.84);text-align:center}
        .hero-bottom .footer-line a{color:#f0c45f;font-weight:800;text-decoration:none}
        .hero-bottom .footer-line a:hover{text-decoration:underline}

        .signup-panel{
            background:linear-gradient(180deg, var(--surface) 0%, #fcfbf8 100%);
            padding:40px 42px;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .signup-card{
            width:min(100%, 520px);
        }
        .page-title{font-size:2.5rem;font-weight:900;color:var(--accent);margin:0;text-align:center}
        .page-subtitle{color:var(--muted);margin:8px 0 0;text-align:center;font-weight:600}
        .card{background:var(--surface);border-radius:24px;padding:30px 30px 26px;border:1px solid var(--border);box-shadow:var(--shadow)}
        .form{display:flex;flex-direction:column;gap:22px}
        .field{display:flex;flex-direction:column;gap:8px}
        label{font-weight:700;color:var(--text)}
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"]{
            padding:14px 16px;
            border-radius:12px;
            border:1.8px solid rgba(31, 47, 36, 0.22);
            font-size:1rem;
            outline:none;
            font-family:inherit;
            background:#fff;
            transition:all 0.25s ease;
        }
        .password-field{position:relative;display:flex;align-items:center}
        .password-field input{width:100%;padding-right:72px}
        .toggle-password{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:transparent;border:none;color:var(--accent);font-weight:800;cursor:pointer}
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="number"]:focus{
            border-color:var(--accent);
            box-shadow:0 0 0 4px rgba(108,53,104,0.15);
        }
        .step{display:none}
        .step.active{display:block}
        .step-title{font-size:1.2rem;font-weight:900;color:var(--accent);margin:0 0 10px}
        .step-title.personal{margin-bottom:14px}
        .step-2 input[type="number"]{padding:16px 16px;font-size:1.05rem}
        .form-actions{display:flex;gap:14px;margin-top:14px}
        .form-actions button,
        .form-actions a{flex:1}
        .btn-primary,
        .btn-secondary{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            width:100%;
            padding:15px 18px;
            border-radius:999px;
            font-weight:900;
            font-size:1.02rem;
            text-decoration:none;
            cursor:pointer;
            transition:all 0.25s ease;
        }
        .btn-primary{border:none;background:var(--accent);color:#fff;box-shadow:0 4px 10px rgba(108, 53, 104, 0.25)}
        .btn-primary:hover{background:#5a2d57;color:#fff;transform:translateY(-1px);box-shadow:0 12px 24px rgba(108, 53, 104, 0.20)}
        .btn-secondary{border:2px solid var(--accent);background:#fff;color:var(--accent)}
        .btn-secondary:hover{background:rgba(108, 53, 104, 0.08);transform:translateY(-1px)}
        .step-indicator{display:flex;gap:10px;justify-content:center;margin:0 0 22px}
        .step-pill{padding:8px 14px;border-radius:999px;background:rgba(108,53,104,0.08);color:var(--accent);font-weight:800;font-size:.9rem}
        .step-pill.active{background:var(--accent);color:#fff}
        .alert{position:relative;margin:0 0 18px;padding:12px 14px 12px 42px;border-radius:12px;font-size:.93rem;font-weight:600;line-height:1.45}
        .alert::before{content:"!";position:absolute;left:14px;top:50%;transform:translateY(-50%);width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:900}
        .alert-error{background:linear-gradient(180deg,#fff4f3,#ffe6e3);color:#7a1f2a;border:1px solid #f0b1b5;box-shadow:0 8px 18px rgba(122,31,42,.08)}
        .alert-error::before{background:#c93b4e;color:#fff}

        @media (max-width: 980px){
            body{padding:16px}
            main{grid-template-columns:1fr;min-height:auto}
            .hero-panel{min-height:520px}
            .signup-panel{padding:34px 18px 44px}
        }

        @media (max-width:720px){
            body{padding:0}
            main{width:100%;border-radius:0;box-shadow:none}
            .hero-panel{padding:36px 22px 28px;min-height:420px}
            .signup-panel{padding:22px 14px 28px}
            .card{padding:24px 20px}
            .page-title{font-size:2rem}
            .page-subtitle{font-size:.95rem}
            .hero-copy{font-size:.96rem}
            .form-actions{flex-direction:column;align-items:flex-start}
            .hero-bottom .footer-line{flex-direction:column;align-items:center}
        }
    </style>
</head>
<body>
    <main>
        <section class="hero-panel">
            <div class="hero-top">
                <div class="brand-line">
                    <div class="brand-mark">R</div>
                    <div class="brand-name">Régime</div>
                </div>
                <h1 class="hero-title">Créez votre compte et <span>commencez votre suivi</span></h1>
                <p class="hero-copy">
                    Une inscription en deux étapes pour créer votre profil et renseigner vos informations de santé,
                    avec la même identité visuelle que le reste du projet.
                </p>
                <div class="hero-note">
                    Commencez par vos informations personnelles, puis complétez vos données de santé après avoir cliqué sur
                    <strong>Suivant</strong>. Cela permet de garder le formulaire clair, simple et rapide à remplir.
                </div>
            </div>

            <div class="hero-bottom">
                <div class="footer-line">
                    <span>Vous avez déjà un compte ?</span>
                    <a href="<?= site_url('/') ?>">Se connecter</a>
                </div>
            </div>
        </section>

        <section class="signup-panel">
            <div class="signup-card">
                <div style="text-align:center;margin-bottom:26px">
                    <h2 class="page-title">Inscription</h2>
                    <p class="page-subtitle">Créez votre compte pour démarrer votre suivi</p>
                </div>

                <div class="card">

                <?php if (session()->getFlashdata('error')) { ?>
                    <div class="alert alert-error"><?= esc((string) session()->getFlashdata('error')) ?></div>
                <?php } ?>
                <div class="step-indicator" aria-hidden="true">
                    <div class="step-pill active" id="pill-1">1. Personnel</div>
                    <div class="step-pill" id="pill-2">2. Santé</div>
                </div>
            <form class="form" action="/inscription/ajout" method="post">
                <div class="step active" id="step-1">
                    <div class="step-title personal">Information personnelle</div>
                    <div class="field">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" id="pseudo" name="pseudo" placeholder="ex: Rakoto">
                    </div>
                    <div class="field">
                        <label for="genre">Genre</label>
                        <input type="text" id="genre" name="genre" placeholder="ex: Homme ou Femme">
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="ex: email@domaine.com">
                    </div>
                    <div class="field">
                        <label for="password">Mot de passe</label>
                        <div class="password-field">
                            <input type="password" id="password" name="password" placeholder="Votre mot de passe">
                            <button class="toggle-password" type="button" id="toggle-password" aria-pressed="false">Voir</button>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button class="btn-primary" type="button" id="next-step">Suivant</button>
                        <button type="reset" class="btn-secondary">Annuler</button>
                    </div>
                </div>

                <div class="step step-2" id="step-2">
                    <div class="step-title">Information de sante</div>
                    <div class="field">
                        <label for="taille">Taille (cm)</label>
                        <input type="number" id="taille" name="taille" placeholder="ex: 170">
                    </div>
                    <div class="field">
                        <label for="poids">Poids (kg)</label>
                        <input type="number" id="poids" name="poids" placeholder="ex: 65">
                    </div>
                    <div class="form-actions">
                        <button type="button" id="prev-step" class="btn-secondary">Retour</button>
                        <button class="btn-primary" type="submit">S'inscrire</button>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </section>
    </main>
    <script>
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        const nextStep = document.getElementById('next-step');
        const prevStep = document.getElementById('prev-step');
        const pill1 = document.getElementById('pill-1');
        const pill2 = document.getElementById('pill-2');

        togglePassword.addEventListener('click', () => {
            const show = passwordInput.type === 'password';
            passwordInput.type = show ? 'text' : 'password';
            togglePassword.textContent = show ? 'Cacher' : 'Voir';
            togglePassword.setAttribute('aria-pressed', String(show));
        });

        nextStep.addEventListener('click', () => {
            step1.classList.remove('active');
            step2.classList.add('active');
            pill1.classList.remove('active');
            pill2.classList.add('active');
        });

        prevStep.addEventListener('click', () => {
            step2.classList.remove('active');
            step1.classList.add('active');
            pill2.classList.remove('active');
            pill1.classList.add('active');
        });
    </script>
</body>
</html>