<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
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
        main{max-width:600px;margin:40px auto;padding:0 16px;display:grid;gap:18px;justify-items:center}
        .page-title{font-size:2rem;font-weight:900;color:var(--accent);margin:0}
        .page-subtitle{color:var(--muted);margin:0}
        .card{background:var(--card);border-radius:var(--radius);padding:40px;border:1px solid rgba(155, 160, 122, 0.25);box-shadow:var(--shadow);min-height:440px}
        .logo-badge{width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,var(--accent),var(--accent-4));display:flex;align-items:center;justify-content:center;font-weight:900;color:white;font-size:2rem;box-shadow:0 8px 20px rgba(42, 15, 53, 0.12)}
        .signup-card{width:100%;max-width:440px}
        .form{display:flex;flex-direction:column;gap:20px}
        .field{display:flex;flex-direction:column;gap:6px}
        label{font-weight:700;color:var(--text)}
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"]{padding:12px 14px;border-radius:12px;border:2px solid rgba(155, 160, 122, 0.35);font-size:1rem;outline:none}
        .password-field{position:relative;display:flex;align-items:center}
        .password-field input{width:100%;padding-right:72px}
        .toggle-password{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:transparent;border:none;color:var(--accent);font-weight:800;cursor:pointer}
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="number"]:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(108,53,104,0.15)}
        .step{display:none}
        .step.active{display:block}
        .step-title{font-size:1.2rem;font-weight:900;color:var(--accent);margin:0 0 10px}
        .step-title.personal{margin-bottom:14px}
        .step-2 input[type="number"]{padding:16px 16px;font-size:1.05rem}
        .form-actions{display:flex;gap:12px}
        .form-actions button{flex:1}
        .btn-secondary{background:rgba(108,53,104,0.12);color:var(--accent);border:2px solid var(--accent)}
        .btn-secondary:hover{background:rgba(108,53,104,0.2)}
        button{padding:12px 16px;border:none;border-radius:999px;background:var(--accent-2);color:#1d1b1b;font-weight:900;cursor:pointer}
        button:hover{background:#939700}

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
            <h1 class="page-title">Inscription</h1>
            <p class="page-subtitle">Creez votre compte pour demarrer votre suivi.</p>
        </div>
        <section class="card signup-card">
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
                        <button type="button" id="next-step">Suivant</button>
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
                        <button type="submit">S'inscrire</button>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <script>
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const show = passwordInput.type === 'password';
            passwordInput.type = show ? 'text' : 'password';
            togglePassword.textContent = show ? 'Cacher' : 'Voir';
            togglePassword.setAttribute('aria-pressed', String(show));
        });

        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        const nextStep = document.getElementById('next-step');
        const prevStep = document.getElementById('prev-step');

        nextStep.addEventListener('click', () => {
            step1.classList.remove('active');
            step2.classList.add('active');
        });

        prevStep.addEventListener('click', () => {
            step2.classList.remove('active');
            step1.classList.add('active');
        });
    </script>
</body>
</html>