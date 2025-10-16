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

    public function save(string $username, int $score, int $time, int $attempts): bool
    {
        $stmt = $this->db->prepare('
            INSERT INTO scores (username, score, time_seconds, attempts)
            VALUES (:username, :score, :time_seconds, :attempts)
        ');
        return $stmt->execute([
            ':username' => htmlspecialchars($username),
            ':score' => $score,
            ':time_seconds' => $time,
            ':attempts' => $attempts
        ]);
    }

    public function getTopScores(int $limit = 10): array
    {
        $stmt = $this->db->prepare('SELECT * FROM scores ORDER BY score DESC, time_seconds ASC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }


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

    public function getUserHistory(string $username, int $limit = 10): array
    {
        $stmt = $this->db->prepare('
        SELECT score, time_seconds, attempts, created_at
        FROM scores
        WHERE username = :username
        ORDER BY created_at DESC
        LIMIT :limit
    ');
        $stmt->bindValue(':username', htmlspecialchars($username));
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
