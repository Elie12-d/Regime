<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - Régime</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg: #f6f4f8;
            --surface: #ffffff;
            --surface-soft: #f8f5ef;
            --muted: #6b6d8f;
            --text: #2a0f35;
            --accent: #6c3568;
            --accent-strong: #6a6ea6;
            --accent-warm: #a6a800;
            --accent-soft: #9ba07a;
            --border: rgba(155, 160, 122, 0.25);
            --shadow: 0 10px 30px rgba(42, 15, 53, 0.08);
            --radius: 20px;
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
        .hero-bottom,
        .hero-figure{
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
            background:linear-gradient(135deg, var(--accent), var(--accent-strong));
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
        .hero-figure{display:none}
        .hero-bottom{margin-top:auto}
        .login-panel{
            background:linear-gradient(180deg, var(--surface) 0%, #fcfbf8 100%);
            padding:40px 42px;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .login-card{
            width:min(100%, 480px);
        }
        .page-title{font-size:2.5rem;font-weight:900;color:#1b3458;margin:0;text-align:center}
        .page-title{color:var(--accent)}
        .page-subtitle{color:var(--muted);margin:8px 0 0;text-align:center;font-weight:600}
        .card{background:var(--surface);border-radius:24px;padding:30px 30px 26px;border:1px solid var(--border);box-shadow:var(--shadow)}
        .form{display:flex;flex-direction:column;gap:22px}
        .field{display:flex;flex-direction:column;gap:8px}
        label{font-weight:700;color:var(--text)}
        input[type="email"],
        input[type="password"]{
            padding:14px 16px;
            border-radius:12px;
            border:1.8px solid rgba(31, 47, 36, 0.22);
            font-size:1rem;
            outline:none;
            font-family:inherit;
            background:#fff;
            transition:all 0.25s ease;
        }
        input[type="email"]:focus,
        input[type="password"]:focus{
            border-color:var(--accent);
            box-shadow:0 0 0 4px rgba(108, 53, 104, 0.15);
        }
        .actions-row{display:flex;align-items:center;justify-content:space-between;gap:12px;font-size:.92rem;color:var(--muted)}
        .remember{display:flex;align-items:center;gap:8px}
        .remember input{accent-color:var(--accent)}
        .forgot-link{color:var(--accent-strong);text-decoration:none;font-weight:600}
        .forgot-link:hover{text-decoration:underline}
        .btn-primary,
        .btn-secondary{
            display:flex;
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
        .divider{display:flex;align-items:center;gap:12px;color:#b4b1ab;font-size:.9rem;margin:4px 0}
        .divider::before,
        .divider::after{content:"";height:1px;flex:1;background:#e0ddd6}
        .footer-line{margin-top:24px;padding-top:18px;border-top:1px solid rgba(31,47,36,0.1);display:flex;align-items:center;justify-content:space-between;gap:16px;color:var(--muted)}
        .footer-line a{color:var(--accent-strong);font-weight:700;text-decoration:none}
        .footer-line a:hover{text-decoration:underline}
        .alert{position:relative;margin:0 0 18px;padding:12px 14px 12px 42px;border-radius:12px;font-size:.93rem;font-weight:600;line-height:1.45}
        .alert::before{content:"!";position:absolute;left:14px;top:50%;transform:translateY(-50%);width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:900}
        .alert-error{background:linear-gradient(180deg,#fff4f3,#ffe6e3);color:#7a1f2a;border:1px solid #f0b1b5;box-shadow:0 8px 18px rgba(122,31,42,.08)}
        .alert-error::before{background:#c93b4e;color:#fff}

        @media (max-width: 980px){
            body{padding:16px}
            main{grid-template-columns:1fr;min-height:auto}
            .hero-panel{min-height:640px}
            .login-panel{padding:34px 18px 44px}
        }

        @media (max-width:720px){
            body{padding:0}
            main{width:100%;border-radius:0;box-shadow:none}
            .hero-panel{padding:36px 22px 28px;min-height:560px}
            .login-panel{padding:22px 14px 28px}
            .card{padding:24px 20px}
            .page-title{font-size:2rem}
            .page-subtitle{font-size:.95rem}
            .hero-copy{font-size:.96rem}
            .actions-row,.footer-line{flex-direction:column;align-items:flex-start}
            .hero-panel{min-height:420px}
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
                <h1 class="hero-title">Suivez votre régime et <span>restez motivé</span></h1>
                <p class="hero-copy">
                    Une interface claire pour accéder à votre espace personnel, consulter vos objectifs et suivre vos progrès
                    au quotidien avec la même identité visuelle que le tableau de bord.
                </p>
            </div>

        </section>

        <section class="login-panel">
            <div class="login-card">
                <div style="text-align:center;margin-bottom:26px">
                    <h2 class="page-title">Connexion</h2>
                    <p class="page-subtitle">Connectez-vous à votre compte</p>
                </div>

                <div class="card">
                    <?php if (session()->getFlashdata('error')) { ?>
                        <div class="alert alert-error"><?= esc((string) session()->getFlashdata('error')) ?></div>
                    <?php } ?>

                    <form class="form" action="<?= site_url('login') ?>" method="post">
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="votre@gmail.com" required>
                        </div>

                        <div class="field">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                        </div>

                        <button class="btn-primary" type="submit">Se connecter</button>

                        <div class="divider">ou</div>

                        <a class="btn-secondary" href="<?= site_url('inscription') ?>">S'inscrire</a>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>