<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Halloween</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="home">

    <nav class="home-nav">
        <a href="?page=home" title="Accueil"><i class="fa-solid fa-house"></i></a>
        <a href="?page=profile" title="Profil"><i class="fa-solid fa-user"></i></a>
    </nav>

    <div class="container">
        <h1>Bienvenue dans le Memory Halloween</h1>

        <form action="?page=game" method="POST" class="start-form">
            <label for="username">Votre pseudo :</label>
            <input type="text" id="username" name="username" required>


            <label for="pairs">Niveau de difficulté :</label>
            <select id="pairs" name="pairs">
                <option value="3">Facile (6 cartes)</option>
                <option value="6">Moyen (12 cartes)</option>
                <option value="9">Difficile (18 cartes)</option>
                <option value="12">Expert (24 cartes)</option>
            </select>



            <button type="submit" class="btn">Jouer</button>
        </form>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>


</body>

</html>