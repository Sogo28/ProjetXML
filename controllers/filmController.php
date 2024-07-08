<?php
require_once 'model/DAO/FilmDAO.php';
require_once 'model/domain/Film.php';
require_once 'services/Format.php';
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
    $serviceFormat = new Format();
    $film = $filmDAO->getByid($id);
    $horairesFormatees = $serviceFormat->formatHoraires($film->horaires->horaire);
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
    // Récupération des données du formulaire
    $titre = $_POST['titre'];
    $duree = $_POST['duree_heures']; // Format HH:MM
    $genre = $_POST['genre'];
    $realisateur = $_POST['realisateur'];
    $acteurs = $_POST['acteurs']; // Tableau d'acteurs
    $annee = $_POST['annee'];
    $langue = strtoupper($_POST['langue']);
    $description = $_POST['description'];

    // Extraction des heures et minutes
    list($heures, $minutes) = explode(':', $duree);

    // Traitement des horaires
    $horaires = [];
    $horairesJours = $_POST['horairesJours'];
    $horairesHeures = $_POST['horairesHeures'];
    for ($i = 0; $i < count($horairesJours); $i++) {
      list($heures, $minutes) = explode(':', $horairesHeures[$i]);
      $horaires[] = [$horairesJours[$i], $heures, $minutes];
    }
    // Traitement des notes
    if (array_filter($_POST['notes'])) {
      $notes = array_map(function ($note) {
        return explode(',', trim($note));
      }, $_POST['notes']);
    } else {
      $notes = [];
    }

    // Création de l'objet Film
    $film = new Film($titre, [$heures, $minutes], $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $notes);

    $filmDAO = new FilmDAO();
    $isAdded = $filmDAO->addFilm($film);
    if ($isAdded[0]) {
      $this->showIndex(); // Redirect to index after adding the film
    } else {
      $this->showError("Erreur lors de l'ajout du film : " . $isAdded[1]);
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