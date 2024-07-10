<?php
require_once 'controllers/filmController.php';
$controller = new FilmController();
if (!isset($_GET['action'])) {
  $controller->showIndex();
} else {
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
      $controller->showError("Cette Page n'existe pas");
      break;
  }
}
?>