<?php
namespace App\Controllers;

use App\Models\Game;

class GameController
{
    public function index(): void
    {
        // Si le joueur clique sur "Rejouer"
        if (isset($_GET['replay']) && isset($_SESSION['username'], $_SESSION['pairCount'])) {
            $username = $_SESSION['username'];
            $pairCount = (int) $_SESSION['pairCount'];
        } 
        // Sinon, il vient de la page d’accueil (nouvelle partie)
        else {
            $username = $_POST['username'] ?? 'Invité';
            $pairCount = isset($_POST['pairs']) ? (int)$_POST['pairs'] : 3;

            // Enregistre dans la session
            $_SESSION['username'] = htmlspecialchars($username);
            $_SESSION['pairCount'] = $pairCount;
        }

        // Crée une instance du jeu
        $game = new Game($pairCount);

        // Mélange et génère les cartes
        $cards = $game->generateCards();

        // Affiche la vue du plateau
        require_once __DIR__ . '/../Views/game.php';
    }
}
