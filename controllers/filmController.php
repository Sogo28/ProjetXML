<?php
require_once 'model/DAO/FilmDAO.php';
require_once 'model/domain/Film.php';
class FilmController
{
  public function showIndex()
  {
    $filmDAO = new FilmDAO();
    $films = $filmDAO->getAll();
    $genres = $filmDAO->getAllGenres();
    require_once 'views/accueil.php';
  }

  public function showAddFilm()
  {
    $filmDAO = new FilmDAO();
    $films = $filmDAO->getAll();
    $genres = $filmDAO->getAllGenres();
    require_once 'views/addFilm.php';
  }
  public function showGenre($genre)
  {
    $filmDAO = new FilmDAO();
    $films = $filmDAO->getByGenre($genre);
    $genres = $filmDAO->getAllGenres();
    require_once 'views/filmsByGenre.php';
  }

  public function showFilm($id)
  {
    $filmDAO = new FilmDAO();
    $film = $filmDAO->getByid($id);
    $genres = $filmDAO->getAllGenres();
    require_once 'views/film.php';
  }

  public function showError($errorMessage = 'Une erreur est survenue')
  {
    $filmDAO = new FilmDAO();
    $films = $filmDAO->getAll();
    $genres = $filmDAO->getAllGenres();
    require_once 'views/error.php';
  }

  public function addFilm()
  {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $titre = $_POST['titre'];
      $duree = [(int) $_POST['duree_heures'], (int) $_POST['duree_minutes']];
      $genre = $_POST['genre'];
      $realisateur = $_POST['realisateur'];
      $acteurs = explode(',', $_POST['acteurs']);
      $annee = (int) $_POST['annee'];
      $langue = $_POST['langue'];
      $description = $_POST['description'];
      $horaires = array_map(function ($horaire) {
        return explode(';', $horaire);
      }, explode(',', $_POST['horaires']));
      $notes = array_map(function ($note) {
        return explode(';', $note);
      }, explode(',', $_POST['notes']));
      $film = new Film($titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $notes);

      $filmDAO = new FilmDAO();
      if ($filmDAO->addFilm($film)) {
        $this->showIndex(); // Redirect to index after adding the film
      } else {
        $this->showError("Erreur lors de l'ajout du film. Fichier non conforme à la DTD");
      }
    }

  }

  public function deleteFilm($id)
  {
    $filmDAO = new FilmDAO();
    $filmDAO->deleteFilm($id);
    $this->showIndex(); // Redirect to index after deleting the film
  }
}
?>