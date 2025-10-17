<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement - Memory Halloween</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="game">
    <div class="container">
        <h1><i class="fa-solid fa-ranking-star"></i> Classement des meilleurs joueurs</h1>

        <table class="score-table">
            <thead>
                <tr>
                    <th>Rang</th>
                    <th>Joueur</th>
                    <th>Score</th>
                    <th>Temps (s)</th>
                    <th>Tentatives</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topScores as $index => $score): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($score['username']) ?></td>
                        <td><?= $score['score'] ?></td>
                        <td><?= $score['time_seconds'] ?></td>
                        <td><?= $score['attempts'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="?page=home" class="btn-score"><i class="fa-solid fa-house"></i> Retour à l'accueil</a>
    </div>
    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
