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
        $controller->showGenre($_GET['value']);
      } else {
        $controller->showError("Le genre n'existe pas");
      }
      break;
    case 'addFilm':
      $controller->showAddFilm();
      break;
    case 'deleteFilm':
      if (isset($_GET['id'])) {
        $controller->deleteFilm($_GET['id']);
      } else {
        $controller->showError("Le film n'existe pas");
      }
      break;
    case 'handleAddFilmSubmit':
      $controller->addFilm();
      break;
    default:
      break;
  }
}
?>