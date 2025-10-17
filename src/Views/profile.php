<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil joueur - Memory Halloween</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="game">

    <nav class="home-nav">
        <a href="?page=home" title="Accueil"><i class="fa-solid fa-house"></i></a>
        <a href="?page=profile" title="Profil"><i class="fa-solid fa-user"></i></a>
    </nav>

    <div class="container">
        <h1><i class="fa-solid fa-user"></i> Profil joueur</h1>

        <div class="profile-info">
            <h2><i class="fa-solid fa-ghost"></i> <?= htmlspecialchars($_SESSION['username']) ?></h2>
            <p><i class="fa-solid fa-gamepad"></i> Parties jouées : <?= $stats['total_games'] ?? 0 ?></p>
            <p><i class="fa-solid fa-trophy"></i> Meilleur score : <?= $stats['best_score'] ?? 0 ?></p>
            <p><i class="fa-solid fa-chart-line"></i> Moyenne : <?= $stats['avg_score'] ? number_format($stats['avg_score'], 2) : 0 ?></p>
        </div>

        <h3><i class="fa-solid fa-clock-rotate-left"></i> Historique des dernières parties</h3>
        <table class="score-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Score</th>
                    <th>Tentatives</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($history)): ?>
                    <tr>
                        <td colspan="4">Aucun score enregistré pour le moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($history as $row): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                            <td><?= $row['score'] ?></td>
                            <td><?= $row['attempts'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="profile-buttons">
            <a href="?page=home" class="btn-score"><i class="fa-solid fa-house"></i> Accueil</a>
            <a href="?page=score" class="btn-score"><i class="fa-solid fa-ranking-star"></i> Classement</a>
            <a href="?page=game&replay=1" class="btn-restart"><i class="fa-solid fa-play"></i> Nouvelle partie</a>
        </div>
    </div>
    <?php include __DIR__ . '/footer.php'; ?>
</body>

</html>