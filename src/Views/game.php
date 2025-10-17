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

    <!-- COMMUN NAV-->
    <nav class="global-nav">
        <a href="?page=home" title="Accueil"><i class="fa-solid fa-house"></i></a>
        <a href="?page=profile" title="Profil"><i class="fa-solid fa-user"></i></a>
    </nav>

    <!-- === GAME CONTAINT=== -->
    <div class="game-container">

        <!-- === GAME HEADER === -->
        <header class="game-header">
            <h1><i class="fa-solid fa-ghost"></i> Memory Halloween <i class="fa-solid fa-spider"></i></h1>

            <?php
            function getDifficultyInfo(int $pairCount): array
            {
                return match ($pairCount) {
                    3 => ['label' => 'Facile', 'cards' => 6],
                    6 => ['label' => 'Moyen', 'cards' => 12],
                    9 => ['label' => 'Difficile', 'cards' => 18],
                    12 => ['label' => 'Expert', 'cards' => 24],
                    default => ['label' => $pairCount . ' paires', 'cards' => $pairCount * 2],
                };
            }

            $difficultyInfo = getDifficultyInfo($_SESSION['pairCount']);
            ?>


            <div class="game-info">
                <p><i class="fa-solid fa-user"></i> Joueur : <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>

                <form action="?page=game" method="POST" class="difficulty-form">
                    <label for="pairs">
                        <i class="fa-solid fa-puzzle-piece"></i> Niveau de difficulté :
                    </label>
                    <select id="pairs" name="pairs">
                        <option value="3" <?= $_SESSION['pairCount'] == 3 ? 'selected' : '' ?>>Facile (6 cartes)</option>
                        <option value="6" <?= $_SESSION['pairCount'] == 6 ? 'selected' : '' ?>>Moyen (12 cartes)</option>
                        <option value="9" <?= $_SESSION['pairCount'] == 9 ? 'selected' : '' ?>>Difficile (18 cartes)</option>
                        <option value="12" <?= $_SESSION['pairCount'] == 12 ? 'selected' : '' ?>>Expert (24 cartes)</option>
                    </select>

                    <a href="?page=game&replay=1" class="btn-restart">
                        <i class="fa-solid fa-rotate-right"></i> Rejouer
                    </a>
                </form>
            </div>

        </header>



        <!-- === BOARD GAME === -->
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
    <?php include __DIR__ . '/footer.php'; ?>
</body>

</html>