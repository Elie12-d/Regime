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
        <?php foreach ($listeRegimes as $regime) { ?>
            <p>Nom : <?= esc($regime['nom']) ?> et quantite : <b><?= esc($regime['quantite']) ?></b></p>
            <p>PU = <?= esc($regime['prix']) ?> Ar | Sous-total = <?= esc($regime['sous_total']) ?> Ar</p>
        <?php } ?>
    </fieldset>
    <fieldset>
        <div>
            <legend>Paiement des regimes selectionnees</legend>
            <h1>Prix total a payer : <?= esc($prixTotal) ?> Ar</h1>
            <p>Votre solde : <?= esc($solde) ?> Ar</p>
            <button type="button" onclick="payer(listeRegimes, prixTotal, solde)">Payer</button>
        </div>
    </fieldset>
    <script>
        const listeRegimes = <?= json_encode($listeRegimes, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        const prixTotal = <?= json_encode($prixTotal, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        const solde = <?= json_encode($solde, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

        function payer(listeRegime, prixTotal, soldeUtilisateur) {
            if (!Array.isArray(listeRegime) || listeRegime.length === 0) {
                alert('Aucun régime sélectionné pour le paiement.');
                return;
            }

            if (parseFloat(soldeUtilisateur) < parseFloat(prixTotal)) {
                alert('Solde insuffisant. Veuillez recharger votre porte-monnaie.');
                return;
            }

            const payload = {
                regimes: listeRegime.map(item => ({
                    regime_id: item.id,
                    quantite: item.quantite,
                    prixPaye: item.prix * item.quantite
                })),
                prixTotal: prixTotal
            };

            fetch('<?= site_url('/achat-regime/payer') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Paiement réussi.');
                    window.location.reload();
                } else {
                    alert(data.message || 'Le paiement a échoué.');
                }
            })
            .catch(() => {
                alert('Erreur réseau lors du paiement.');
            });
        }
    </script>
</body>

</html>