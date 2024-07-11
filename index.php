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
            if (isset($_GET['id'])) {
                $restaurantController->showRestaurant($_GET['id']);
            } else {
                $restaurantController->showIndex();
            }
            break;
        case 'addRestaurant':
            $restaurantController->showAddRestaurant();
            break;
        case 'handleAddRestaurantSubmit':
            $restaurantController->addRestaurant();
            break;
        case 'updateRestaurant':
            if (isset($_GET['id'])) {
                $restaurantController->showUpdateRestaurant();
            } else {
                $restaurantController->showError("Le restaurant n'existe pas");
            }
            break;
        case 'handleUpdateRestaurantSubmit':
            $restaurantController->updateRestaurant();
            break;
        case 'deleteRestaurant':
            if (isset($_GET['id'])) {
                $restaurantController->deleteRestaurant($_GET['id']);
            } else {
                $restaurantController->showError("Le restaurant n'existe pas");
            }
            break;
        case 'film':
            if (isset($_GET['id'])) {
                $filmController->showFilm($_GET['id']);
            } else {
                $filmController->showIndex();
            }
            break;
        case 'genre':
            if (isset($_GET['value'])) {
                $filmController->showAllByGenre($_GET['value']);
            } else {
                $filmController->showError("Le genre n'existe pas");
            }
            break;
        case 'addFilm':
            $filmController->showAddFilm();
            break;
        case 'handleAddFilmSubmit':
            $filmController->addFilm();
            break;
        case 'updateFilm':
            if (isset($_GET['id'])) {
                $filmController->showUpdateFilm();
            } else {
                $filmController->showError("Le film n'existe pas");
            }
            break;
        case 'handleUpdateFilmSubmit':
            if (isset($_GET['id'])) {
                $filmController->updateFilm();
            } else {
                $filmController->showError("Le film n'existe pas");
            }
            break;
        case 'deleteFilm':
            if (isset($_GET['id'])) {
                $filmController->deleteFilm($_GET['id']);
            } else {
                $filmController->showError("Le film n'existe pas");
            }
            break;
    }
} else {
    $appController->showIndex();
}
?>