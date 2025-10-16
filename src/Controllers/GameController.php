<?php
namespace App\Controllers;

use App\Models\Game;

class GameController
{
    public function index(): void
    {
        // Récupère les infos du formulaire de l'accueil
        $username = $_POST['username'] ?? 'Invité';
        $pairCount = isset($_POST['pairs']) ? (int)$_POST['pairs'] : 3;

        // Enregistre dans la session
        $_SESSION['username'] = htmlspecialchars($username);
        $_SESSION['pairCount'] = $pairCount;

        // Crée une instance du jeu
        $game = new Game($pairCount);

        // Mélange et génère les cartes
        $cards = $game->generateCards();

        // Affiche la vue du plateau
        require_once __DIR__ . '/../Views/game.php';
    }
}
