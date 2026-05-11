<?php
$title = 'Statistiques';
$activePage = 'Statistiques';
?>

<?= $this->extend('layout') ?>

<?= $this->section('head') ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
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
            --success: #2e7d32;
            --warning: #f57c00;
            --danger: #d32f2f;
        }

        .stats-page,
        .stats-page *{box-sizing:border-box}
        .stats-page{
            font-family:'Poppins',system-ui,sans-serif;
            color:var(--text);
            -webkit-font-smoothing:antialiased;
            max-width:1200px;
            margin:40px auto;
            padding:0 16px;
            display:grid;
            gap:28px;
        }
        .page-title{font-size:2rem;font-weight:900;color:var(--accent);margin:0}
        .page-subtitle{color:var(--muted);margin:0;font-size:.95rem}
        
        /* Header Section */
        .header-section{display:grid;gap:24px;margin-bottom:24px}
        .header-content{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px}
        
        /* Stat Cards */
        .stat-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:16px;margin-bottom:24px}
        .stat-card{background:var(--card);border-radius:var(--radius);padding:24px;border:1px solid rgba(155,160,122,0.25);box-shadow:var(--shadow)}
        .stat-card.primary{background:linear-gradient(135deg,var(--accent),var(--accent-4));color:white;border:none}
        .stat-card.success{background:linear-gradient(135deg,var(--success),#4caf50);color:white;border:none}
        .stat-card.warning{background:linear-gradient(135deg,var(--warning),#ff9800);color:white;border:none}
        .stat-card-label{font-size:.85rem;font-weight:600;opacity:.9;text-transform:uppercase;letter-spacing:.5px}
        .stat-card-value{font-size:2.2rem;font-weight:900;margin:8px 0}
        .stat-card-subtitle{font-size:.8rem;opacity:.85}
        
        /* Progress Section */
        .progress-section{background:var(--card);border-radius:var(--radius);padding:28px;border:1px solid rgba(155,160,122,0.25);box-shadow:var(--shadow)}
        .progress-title{font-size:1.3rem;font-weight:900;color:var(--accent);margin:0 0 20px}
        .progress-container{display:grid;gap:20px}
        
        /* Progress Bar */
        .progress-bar{width:100%;height:28px;background:rgba(155,160,122,0.15);border-radius:14px;overflow:hidden;box-shadow:inset 0 2px 4px rgba(0,0,0,.05)}
        .progress-fill{height:100%;background:linear-gradient(90deg,var(--accent-2),var(--accent-3));transition:width .6s ease;display:flex;align-items:center;justify-content:flex-end;padding-right:12px;color:white;font-weight:700;font-size:.75rem}
        
        /* Stat Details */
        .progress-details{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:16px}
        .detail-item{background:rgba(108,53,104,.06);border-radius:12px;padding:16px;border-left:4px solid var(--accent)}
        .detail-label{font-size:.85rem;color:var(--muted);font-weight:600;text-transform:uppercase}
        .detail-value{font-size:1.5rem;font-weight:900;color:var(--accent);margin-top:4px}
        
        /* Charts Section */
        .charts-section{display:grid;grid-template-columns:repeat(auto-fit,minmax(500px,1fr));gap:24px}
        .chart-card{background:var(--card);border-radius:var(--radius);padding:24px;border:1px solid rgba(155,160,122,0.25);box-shadow:var(--shadow)}
        .chart-title{font-size:1.1rem;font-weight:900;color:var(--accent);margin:0 0 20px}
        .chart-container{position:relative;height:350px}
        
        /* Traitement List */
        .traitements-section{background:var(--card);border-radius:var(--radius);padding:28px;border:1px solid rgba(155,160,122,0.25);box-shadow:var(--shadow);margin-top:24px}
        .traitements-title{font-size:1.3rem;font-weight:900;color:var(--accent);margin:0 0 20px}
        .traitement-list{display:grid;gap:12px;max-height:400px;overflow-y:auto}
        .traitement-item{display:grid;grid-template-columns:auto 1fr auto auto;gap:16px;align-items:center;padding:14px;background:rgba(108,53,104,.04);border-radius:10px;border-left:4px solid var(--accent-2)}
        .traitement-item.negative{border-left-color:var(--danger)}
        .traitement-item.positive{border-left-color:var(--success)}
        .traitement-date{font-size:.85rem;color:var(--muted);font-weight:600}
        .traitement-regime{font-weight:700;color:var(--text)}
        .traitement-variation{font-size:1rem;font-weight:900;text-align:right}
        .traitement-variation.negative{color:var(--danger)}
        .traitement-variation.positive{color:var(--success)}
        
        .back-btn{display:inline-block;padding:10px 20px;background:var(--accent);color:#fff;text-decoration:none;border-radius:999px;font-weight:700;transition:all .25s}
        .back-btn:hover{background:var(--accent-4);transform:translateY(-2px);box-shadow:0 8px 16px rgba(108,53,104,.2)}
        
        @media (max-width:768px){
            .stat-cards{grid-template-columns:1fr}
            .charts-section{grid-template-columns:1fr}
            .chart-container{height:300px}
            .traitement-item{grid-template-columns:1fr;gap:8px}
            .traitement-variation{text-align:left}
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <main class="stats-page">
        <!-- Header -->
        <div class="header-section">
            <div>
                <h1 class="page-title">📊 Suivi de votre Régime</h1>
                <p class="page-subtitle">Suivez votre progression et vos objectifs</p>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="stat-cards">
            <div class="stat-card primary">
                <div class="stat-card-label">Poids Initial</div>
                <div class="stat-card-value"><?= number_format($poidInitial, 1, '.', '') ?> kg</div>
                <div class="stat-card-subtitle">Depuis le <?= date('d/m/Y', strtotime($dateDebut)) ?></div>
            </div>
            <div class="stat-card success">
                <div class="stat-card-label">Poids Actuel</div>
                <div class="stat-card-value"><?= number_format($poidActuel, 1, '.', '') ?> kg</div>
                <div class="stat-card-subtitle">Aujourd'hui, <?= date('d/m/Y') ?></div>
            </div>
            <div class="stat-card <?= $variationTotale < 0 ? 'success' : ($variationTotale > 0 ? 'warning' : 'primary') ?>">
                <div class="stat-card-label">Variation Totale</div>
                <div class="stat-card-value"><?= $variationTotale > 0 ? '+' : '' ?><?= number_format($variationTotale, 1, '.', '') ?> kg</div>
                <div class="stat-card-subtitle">Depuis le début</div>
            </div>
            <div class="stat-card primary">
                <div class="stat-card-label">Régimes Consommés</div>
                <div class="stat-card-value"><?= $totalRegimesConsommes ?></div>
                <div class="stat-card-subtitle">Environ <?= $joursEcules ?> jours</div>
            </div>
        </div>

        <!-- Progress Section -->
        <div class="progress-section">
            <h2 class="progress-title">📈 Votre Progression</h2>
            <div class="progress-container">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;color:var(--text)">Évolution du Poids</label>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:<?= min(100, max(0, (($poidInitial - $poidActuel) / max($poidInitial * 0.1, 1)) * 100)) ?>%">
                            <?= $variationTotale < 0 ? number_format(abs($variationTotale), 1) . ' kg' : (number_format($variationTotale, 1) . ' kg') ?>
                        </div>
                    </div>
                </div>

                <div class="progress-details">
                    <div class="detail-item">
                        <div class="detail-label">Date de Début</div>
                        <div class="detail-value"><?= date('d/m/Y', strtotime($dateDebut)) ?></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Date Actuelle</div>
                        <div class="detail-value"><?= date('d/m/Y', strtotime($dateActuelle)) ?></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jours Écoulés</div>
                        <div class="detail-value"><?= $joursEcules ?> j</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Moyenne par Jour</div>
                        <div class="detail-value"><?= $joursEcules > 0 ? number_format($variationTotale / $joursEcules, 2, '.', '') : '0' ?> kg</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="charts-section">
            <div class="chart-card">
                <h3 class="chart-title">📉 Évolution du Poids</h3>
                <div class="chart-container">
                    <canvas id="weightChart"></canvas>
                </div>
            </div>
            <div class="chart-card">
                <h3 class="chart-title">🍽️ Régimes Consommés</h3>
                <div class="chart-container">
                    <canvas id="regimesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Historique des Régimes -->
        <?php if (count($achatsDetailles) > 0): ?>
        <div class="traitements-section">
            <h2 class="traitements-title">📋 Historique des Régimes</h2>
            <div class="traitement-list">
                <?php foreach (array_reverse($achatsDetailles) as $achat): ?>
                <div class="traitement-item <?= $achat['variation'] < 0 ? 'positive' : 'negative' ?>">
                    <div class="traitement-date"><?= date('d/m/Y', strtotime($achat['dateAchat'])) ?></div>
                    <div>
                        <div class="traitement-regime"><?= esc($achat['regime']) ?></div>
                        <small style="color:var(--muted)">Poids après: <?= number_format($achat['poids_apres'], 1) ?> kg</small>
                    </div>
                    <div style="text-align:right">
                        <div class="traitement-variation <?= $achat['variation'] < 0 ? 'negative' : 'positive' ?>">
                            <?= $achat['variation'] < 0 ? '' : '+' ?><?= number_format($achat['variation'], 1) ?> kg
                        </div>
                        <small style="color:var(--muted)">x<?= $achat['quantite'] ?></small>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
        <div class="progress-section">
            <p style="text-align:center;color:var(--muted);margin:0">Aucun régime consommé pour le moment. Commencez votre suivi en achetant un régime!</p>
        </div>
        <?php endif; ?>
    </main>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        // Chart.js - Évolution du Poids
        const chartDataRaw = <?= $chartData ?>;
        const chartCtx = document.getElementById('weightChart')?.getContext('2d');
        if (chartCtx) {
            new Chart(chartCtx, {
                type: 'line',
                data: {
                    labels: chartDataRaw.map(d => new Date(d.date).toLocaleDateString('fr-FR')),
                    datasets: [{
                        label: 'Poids (kg)',
                        data: chartDataRaw.map(d => d.poids),
                        borderColor: '#a6a800',
                        backgroundColor: 'rgba(166, 168, 0, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: '#6c3568',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {font: {family: "'Poppins', sans-serif", size: 14, weight: 600}}
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            ticks: {font: {family: "'Poppins', sans-serif"}}
                        },
                        x: {
                            ticks: {font: {family: "'Poppins', sans-serif"}}
                        }
                    }
                }
            });
        }

        // Chart.js - Régimes Consommés
        const regimesData = <?= json_encode(array_keys($regimesCounts)) ?>;
        const regimesCount = <?= json_encode(array_values($regimesCounts)) ?>;
        const regimesCtx = document.getElementById('regimesChart')?.getContext('2d');
        if (regimesCtx && regimesData.length > 0) {
            const colors = ['#6c3568', '#a6a800', '#9ba07a', '#6a6ea6', '#c93b4e', '#2e7d32'];
            new Chart(regimesCtx, {
                type: 'doughnut',
                data: {
                    labels: regimesData,
                    datasets: [{
                        data: regimesCount,
                        backgroundColor: colors.slice(0, regimesData.length),
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {font: {family: "'Poppins', sans-serif", size: 12, weight: 600}, padding: 15}
                        }
                    }
                }
            });
        } else if (regimesCtx) {
            regimesCtx.canvas.innerHTML = '<p style="text-align:center;color:#6b6d8f">Aucune donnée disponible</p>';
        }
    </script>
<?= $this->endSection() ?>