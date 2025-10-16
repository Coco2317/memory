<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Halloween</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="game">
    <div class="game-container">
        <header>
            <h1>Memory Halloween</h1>
            <p>Joueur : <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
            <p>Nombre de paires : <?= $_SESSION['pairCount'] ?></p>
        </header>

        <section class="board">
            <?php foreach ($cards as $index => $card): ?>
                <div class="card" data-card="<?= $index ?>">
                    <div class="card-inner">
                        <div class="card-front">
                            <img src="../img/deck_game.svg" alt="Dos de carte">
                        </div>
                        <div class="card-back">
                            <img src="../img/<?= htmlspecialchars($card) ?>" alt="Carte">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>