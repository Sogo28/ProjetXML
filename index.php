<?php
session_start();
require_once 'controllers/filmController.php';
require_once 'controllers/authController.php';

$controller = new FilmController();
$authController = new AuthController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $authController->login();
            break;
        case 'authenticate':
            $authController->authenticate();
            break;
        case 'logout':
            $authController->logout();
            break;
        default:
            handleFilmActions($controller);
            break;
    }
} else {
    $controller->showIndex();
}

function handleFilmActions($controller) {
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        $controller->showIndex();
        return;
    }

    $action = $_GET['action'];
    switch ($action) {
        case 'film':
            if (isset($_GET['id'])) {
                $controller->showFilm($_GET['id']);
            } else {
                $controller->showError("Ce film n'existe pas");
            }
            break;
        case 'genre':
            if (isset($_GET['value'])) {
                $controller->showAllByGenre($_GET['value']);
            } else {
                $controller->showError("Le genre n'existe pas");
            }
            break;
        case 'addFilm':
            $controller->showAddFilm();
            break;
        case 'handleAddFilmSubmit':
            $controller->addFilm();
            break;
        case 'updateFilm':
            if (isset($_GET['id'])) {
                $controller->showUpdateFilm();
            } else {
                $controller->showError("Le film n'existe pas");
            }
            break;
        case 'handleUpdateFilmSubmit':
            if (isset($_GET['id'])) {
                $controller->updateFilm();
            } else {
                $controller->showError("Le film n'existe pas");
            }
            break;
        case 'deleteFilm':
            if (isset($_GET['id'])) {
                $controller->deleteFilm($_GET['id']);
            } else {
                $controller->showError("Le film n'existe pas");
            }
            break;
        default:
            $controller->showError("Action non reconnue");
            break;
    }
}
?>
