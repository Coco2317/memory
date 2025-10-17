<?php

namespace App\Controllers;

use App\Models\Score;

class ScoreController
{
    public function index(): void
    {
        $scoreModel = new Score();
        $topScores = $scoreModel->getTopScores();

        require_once __DIR__ . '/../Views/score.php';
    }

    public function saveScore(): void
    {
        if (!isset($_POST['username'], $_POST['score'], $_POST['attempts'])) {
            http_response_code(400);
            exit('Données manquantes');
        }

        $scoreModel = new Score();
        $scoreModel->save(
            $_POST['username'],
            (int) $_POST['score'],
            (int) $_POST['attempts']
        );
    }
}
