<?php
namespace App\Controllers;

use App\Models\Score;

class UserController
{
    public function profile(): void
    {
        $username = $_SESSION['username'] ?? null;
        if (!$username) {
            header('Location: ?page=home');
            exit;
        }

        $scoreModel = new Score();
        $stats = $scoreModel->getUserStats($username);
        $history = $scoreModel->getUserHistory($username);

        require_once __DIR__ . '/../Views/profile.php';
    }

    public function logout(): void
{
    session_unset();    // Supprime toutes les variables de session
    session_destroy();  // Détruit la session
    header('Location: ?page=home'); // Retour à la page d’accueil
    exit;
}

}
