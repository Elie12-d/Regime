<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regime - Mon porte-monnaie</title>
</head>
<body>
    <h2>Votre porte-monnaie</h2>
    <?php if (isset($porteMonnaie['solde'])): ?>
        <p>Solde actuel : <?= esc($porteMonnaie['solde']) ?> Ar</p>
    <?php else: ?>
        <p>Vous n'avez pas encore de porte-monnaie. Veuillez contacter l'administrateur.</p>
    <?php endif; ?>
</body>
</html>