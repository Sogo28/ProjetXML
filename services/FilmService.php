<?php
require_once 'model/DAO/FilmDAO.php';
require_once 'model/domain/Film.php';

class FilmService
{
  private $filmDAO;
  public function __construct()
  {
    $this->filmDAO = new FilmDAO();
  }

  public function getAll()
  {
    return $this->filmDAO->getAll();
  }

  public function getByid($id)
  {
    return $this->filmDAO->getByid($id);
  }

  public function getAllByGenre($genre)
  {
    return $this->filmDAO->getAllByGenre($genre);
  }

  public function getAllGenres()
  {
    return $this->filmDAO->getAllGenres();
  }

  public function addFilm($data)
  {
    $film = new Film();
    $film->titre = $data['titre'];
    $film->genre = $data['genre'];
    $film->realisateur = $data['realisateur'];
    $film->acteurs = $data['acteurs'];
    $film->annee = $data['annee'];
    $film->langue = strtoupper($data['langue']);
    $film->description = $data['description'];
    $film->setDuree($data['duree']);
    $film->setHoraires($data['horairesJours'], $data['horairesHeures']);
    $film->setNotes($data['notes']);
    return $this->filmDAO->addFilm($film);
  }

  public function updateFilm($data)
  {
    $film = new Film();
    $film->id = $data['id'];
    $film->titre = $data['titre'];
    $film->genre = $data['genre'];
    $film->realisateur = $data['realisateur'];
    $film->acteurs = $data['acteurs'];
    $film->annee = $data['annee'];
    $film->langue = strtoupper($data['langue']);
    $film->description = $data['description'];
    $film->setDuree($data['duree']);
    $film->setHoraires($data['horairesJours'], $data['horairesHeures']);
    $film->setNotes($data['notes']);
    return $this->filmDAO->updateFilm($film);
  }

  public function deleteFilm($id)
  {
    return $this->filmDAO->deleteFilm($id);
  }

  public function formatHoraires($horaires)
  {
    $jours = [
      'Lun' => [],
      'Mar' => [],
      'Mer' => [],
      'Jeu' => [],
      'Ven' => [],
      'Sam' => [],
      'Dim' => []
    ];
    foreach ($horaires as $horaire) {
      $jour = (string) $horaire[0];
      $heures = $horaire[1];
      $minutes = $horaire[2];
      $jours[$jour][] = "$heures:$minutes";
    }
    $horairesGroupees = [];
    foreach ($jours as $jour => $heures) {
      if (!empty($heures)) {
        $chaineHoraires = implode(' | ', $heures);
        if (!isset($horairesGroupees[$chaineHoraires])) {
          $horairesGroupees[$chaineHoraires] = [];
        }
        $horairesGroupees[$chaineHoraires][] = $jour;
      }
    }

    $result = [];
    foreach ($horairesGroupees as $heures => $jours) {
      $chaineJours = implode(', ', $jours);
      $result[$chaineJours] = $heures;
    }
    return $result;
  }
}
?>