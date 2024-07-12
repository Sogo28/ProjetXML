<?php
require_once 'services/FilmService.php';
class FilmController
{
  private $filmService;
  public function __construct()
  {
    $this->filmService = new FilmService();
  }
  public function showIndex()
  {
    $films = $this->filmService->getAll();
    $genres = $this->filmService->getAllGenres();
    require_once 'views/films/accueil.php';
  }
  public function showAddFilm()
  {
    $genres = $this->filmService->getAllGenres();
    require_once 'views/films/addFilm.php';
  }
  public function showUpdateFilm()
  {
    $genres = $this->filmService->getAllGenres();
    $film = $this->filmService->getByid($_GET['id']);
    require_once 'views/films/updateFilm.php';
  }
  public function showAllByGenre($genre)
  {
    $films = $this->filmService->getAllByGenre($genre);
    $genres = $this->filmService->getAllGenres();
    require_once 'views/films/accueil.php';
  }
  public function showFilm($id)
  {
    $film = $this->filmService->getByid($id);
    $genres = $this->filmService->getAllGenres();
    $horairesFormatees = $this->filmService->formatHoraires($film->horaires);
    require_once 'views/films/film.php';
  }
  public function showError($errorMessage = 'Une erreur est survenue')
  {
    require_once 'views/error.php';
  }
  public function addFilm()
  {
    $data = [
      'titre' => $_POST['titre'],
      'duree' => $_POST['duree_heures'],
      'genre' => $_POST['genre'],
      'realisateur' => $_POST['realisateur'],
      'acteurs' => $_POST['acteurs'],
      'annee' => $_POST['annee'],
      'langue' => $_POST['langue'],
      'description' => $_POST['description'],
      'horairesJours' => $_POST['horairesJours'],
      'horairesHeures' => $_POST['horairesHeures'],
      'notes' => $_POST['notes']
    ];
    $isAdded = $this->filmService->addFilm($data);
    if ($isAdded[0]) {
      header('Location: index.php?action=film');
    } else {
      $this->showError("Erreur lors de l'ajout du film : " . $isAdded[1]);
    }
  }
  public function updateFilm()
  {
    $data = [
      'id' => $_GET['id'],
      'titre' => $_POST['titre'],
      'duree' => $_POST['duree_heures'],
      'genre' => $_POST['genre'],
      'realisateur' => $_POST['realisateur'],
      'acteurs' => $_POST['acteurs'],
      'annee' => $_POST['annee'],
      'langue' => $_POST['langue'],
      'description' => $_POST['description'],
      'horairesJours' => $_POST['horairesJours'],
      'horairesHeures' => $_POST['horairesHeures'],
      'notes' => $_POST['notes']
    ];
    $isUpdated = $this->filmService->updateFilm($data);
    if ($isUpdated[0]) {
      header('Location: index.php?action=film');
    } else {
      $this->showError("Erreur lors de la mise à jour du film : " . $isUpdated[1]);
    }
  }
  public function deleteFilm($id)
  {
    $this->filmService->deleteFilm($id);
    header('Location: index.php?action=film');

  }
}
?>