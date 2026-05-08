<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi de votre sante</title>
</head>
<body>
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