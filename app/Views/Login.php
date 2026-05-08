<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
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
        main{max-width:560px;margin:40px auto;padding:0 16px;display:grid;gap:18px;justify-items:center}
        .page-title{font-size:2rem;font-weight:900;color:var(--accent);margin:0}
        .page-subtitle{color:var(--muted);margin:0}
        .card{background:var(--card);border-radius:var(--radius);padding:50px;border:1px solid rgba(155, 160, 122, 0.25);box-shadow:var(--shadow);min-height:420px}
        .logo-badge{width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,var(--accent),var(--accent-4));display:flex;align-items:center;justify-content:center;font-weight:900;color:white;font-size:2rem;box-shadow:0 8px 20px rgba(42, 15, 53, 0.12)}
        .login-card{width:100%;max-width:420px}
        .form{display:flex;flex-direction:column;gap:22px}
        .field{display:flex;flex-direction:column;gap:6px}
        label{font-weight:700;color:var(--text)}
        input[type="email"],
        input[type="password"]{padding:12px 14px;border-radius:12px;border:2px solid rgba(155, 160, 122, 0.35);font-size:1rem;outline:none}
        input[type="email"]:focus,
        input[type="password"]:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(108,53,104,0.15)}
        button{padding:12px 16px;border:none;border-radius:999px;background:var(--accent-2);color:#1d1b1b;font-weight:900;cursor:pointer}
        button:hover{background:#939700}
        .btn-secondary{display:inline-flex;align-items:center;justify-content:center;padding:12px 16px;border-radius:999px;border:2px solid var(--accent);color:var(--accent);font-weight:900;text-decoration:none}
        .btn-secondary:hover{background:rgba(108, 53, 104, 0.08)}

        @media (max-width:720px){
            main{margin:28px auto}
            .page-title{font-size:1.7rem}
        }
    </style>
</head>
<body>
    <main>
        <div class="logo-badge">R</div>
        <div style="text-align:center">
            <h1 class="page-title">Connexion</h1>
            <p class="page-subtitle">Accedez a votre espace pour suivre votre progression.</p>
        </div>
        <section class="card login-card">
            <form class="form" action="<?= site_url('dashboard') ?>" method="get">
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="ex: email@domaine.com" >
                </div>
                <div class="field">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" >
                </div>
                <button type="submit">Se connecter</button>
                <a class="btn-secondary" href="<?= site_url('inscription') ?>">S'inscrire</a>
            </form>
        </section>
    </main>
</body>
</html>