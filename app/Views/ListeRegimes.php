<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des régimes</title>
</head>

<body>
    <?php foreach ($regimes as $regime) { ?>
        <fieldset>
            <legend><?= $regime['nom'] ?></legend>
            <p><?= $regime['pourcentageViande'] ?>% viande</p>
            <p><?= $regime['pourcentageVolaille'] ?>% volaille</p>
            <p><?= $regime['pourcentagePoisson'] ?>% poisson</p>
            <p>Prix par jour: <?= $regime['prixParJour'] ?>€</p>
            <p>Variation de poids: <?= $regime['variationPoids'] ?>kg</p>
            <p><?= $regime['description'] ?></p>
            <button><a href="<?= site_url('/commander') ?>/<?= $regime['id'] ?>">Commander</a></button>
        </fieldset>
    <?php } ?>
</body>

</html>