<?php
namespace App\Models;

class Game
{
    private int $pairCount;
    private array $images = [];
    private array $cards = [];

    public function __construct(int $pairCount)
    {
        $this->pairCount = $pairCount;
        $this->images = [
            'cat_pumpkin.jpg',
            'pumpkin_man.jpg',
            'skull.jpg',
            'double_ghost.jpg',
            'bat_pumpkin.jpg',
            'ghost.svg',
        ];
    }

    public function generateCards(): array
    {
        // On limite au nombre d’images dispo
        $available = array_slice($this->images, 0, min($this->pairCount, count($this->images)));

        // Duplique chaque image pour créer les paires
        $cards = array_merge($available, $available);

        // Mélange aléatoirement
        shuffle($cards);

        // Stocke dans la session
        $_SESSION['cards'] = $cards;

        return $cards;
    }
}
