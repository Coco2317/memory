<?php

namespace App\Models;

use PDO;

class Score
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Enregistre un score en base
     */
    public function save(string $username, int $score, int $attempts): bool
    {
        $stmt = $this->db->prepare('
            INSERT INTO scores (username, score, time_seconds, attempts, created_at)
            VALUES (:username, :score, 0, :attempts, NOW())
        ');

        return $stmt->execute([
            ':username' => htmlspecialchars($username),
            ':score' => $score,
            ':attempts' => $attempts
        ]);
    }

    /**
     * Récupère les meilleurs scores
     */
    public function getTopScores(int $limit = 10): array
    {
        $stmt = $this->db->prepare('
            SELECT * 
            FROM scores 
            ORDER BY score DESC, created_at ASC 
            LIMIT :limit
        ');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Statistiques globales d’un joueur
     */
    public function getUserStats(string $username): ?array
    {
        $stmt = $this->db->prepare('
            SELECT 
                COUNT(*) AS total_games,
                MAX(score) AS best_score,
                AVG(score) AS avg_score
            FROM scores
            WHERE username = :username
        ');
        $stmt->execute([':username' => htmlspecialchars($username)]);
        return $stmt->fetch();
    }

    /**
     * Historique détaillé d’un joueur
     */
    public function getUserHistory(string $username, int $limit = 10): array
    {
        $stmt = $this->db->prepare('
            SELECT score, attempts, created_at
            FROM scores
            WHERE username = :username
            ORDER BY created_at DESC
            LIMIT :limit
        ');
        $stmt->bindValue(':username', htmlspecialchars($username));
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
