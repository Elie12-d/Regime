<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
</head>
<body>
    <fieldset>
        <legend>Liste regimes selectionnees</legend>
        <?php foreach($listeRegimes as $regime){ ?>
            <p>Nom : <?= esc($regime['nom']) ?> et quantite : <b><?= esc($regime['quantite']) ?></b></p>
            <p>PU = <?= esc($regime['prix']) ?></p>
        <?php } ?>
    </fieldset>
    <fieldset>
        <legend>Paiement des regimes selectionnees</legend>
        <h1>Prix total a payer : <?= esc($prixTotal) ?> Ar</h1>
        <p>Votre solde : <?= esc($solde) ?></p>
        <button>Payer</button>
    </fieldset>
</body>
</html>