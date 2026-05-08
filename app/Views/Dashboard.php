<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi de votre sante</title>
</head>
<body>
<<<<<<< HEAD
    <head>
        <a href="/porte-monnaie">Mon porte-monnaie</a>
    </head>
=======
    <div class="nav">
        <button><a href="<?= site_url('dashboard') ?>">Dashboard</a></button>
        <button><a href="<?= site_url('porte-monnaie') ?>">Porte-monnaie</a></button>
        <button><a href="<?= site_url('statistiques') ?>">Statistiques</a></button>
        <button><a href="<?= site_url('logout') ?>">Déconnexion</a></button>
    </div>
>>>>>>> Elie
    <fieldset>
        <legend>Votre Indice de Masse Corporelle (IMC)</legend>
        <h1><?= esc($imc) ?></h1>
        <h2><?= esc($titre) ?></h2>
        <p><?= esc($description) ?></p>
    </fieldset>
    <fieldset>
        <legend>Actions</legend>
        <?php foreach ($categorieObjectif as $categorie){ ?>
            <form action="<?= site_url('objectif/' . $categorie['id']) ?>" method="post">
                <button type="submit"><?= esc($categorie['label']) ?></button>
            </form>
        <?php } ?>
        
    </fieldset>
</body>
</html>