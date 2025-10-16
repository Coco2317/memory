<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\GameController;
use App\Controllers\ScoreController;
use App\Controllers\UserController;

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'game':
        (new GameController())->index();
        break;
    case 'score':
        (new ScoreController())->index();
        break;
    case 'profile':
        (new UserController())->profile();
        break;
    default:
        (new HomeController())->index();
        break;
}
