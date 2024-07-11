<?php
session_start();
require_once 'controllers/filmController.php';
require_once 'controllers/restaurantController.php';
require_once 'controllers/authController.php';
require_once 'controllers/appController.php';

$appController = new AppController();
$restaurantController = new RestaurantController();
$filmController = new FilmController();
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
        case 'restaurant':
            handleRestaurantActions($restaurantController);
            break;
        case 'film':
            handleFilmActions($filmController);
            break;
    }
} else {
    $appController->showIndex();
}

function handleRestaurantActions($controller)
{
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        $controller->showIndex();
        return;
    }

    $action = $_GET['action'];
    switch ($action) {
        case 'restaurant':
            if (isset($_GET['id'])) {
                $controller->showRestaurant($_GET['id']);
            } else {
                $controller->showIndex();
            }
            break;
        case 'addRestaurant':
            $controller->showAddRestaurant();
            break;
        case 'handleAddRestaurantSubmit':
            $controller->addRestaurant();
            break;
        case 'updateRestaurant':
            if (isset($_GET['id'])) {
                $controller->showUpdateRestaurant();
            } else {
                $controller->showError("Le restaurant n'existe pas");
            }
            break;
        case 'handleUpdateRestaurantSubmit':
            $controller->updateRestaurant();
            break;
        case 'deleteRestaurant':
            if (isset($_GET['id'])) {
                $controller->deleteRestaurant($_GET['id']);
            } else {
                $controller->showError("Le restaurant n'existe pas");
            }
            break;
        default:
            $controller->showError("Action non reconnue");
            break;
    }
}
function handleFilmActions($controller)
{
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
                $controller->showIndex();
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