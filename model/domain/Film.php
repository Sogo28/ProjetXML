<?php
class Film
{
  public $id;
  public $titre;
  public $deleted = 'false';
  public $duree;
  public $genre;
  public $realisateur;
  public $acteurs;
  public $annee;
  public $langue;
  public $description;
  public $horaires;
  public $notes;

  function __construct()
  {
    $this->id = uniqid();
  }

  public function setHoraires($horairesJours, $horairesHeures)
  {
    $horaires = [];
    $horairesJours = $_POST['horairesJours'];
    $horairesHeures = $_POST['horairesHeures'];
    for ($i = 0; $i < count($horairesJours); $i++) {
      list($heures, $minutes) = explode(':', $horairesHeures[$i]);
      $horaires[] = [$horairesJours[$i], $heures, $minutes];
    }
    $this->horaires = $horaires;
  }

  public function setNotes($notes)
  {
    if (array_filter($notes)) {
      $notes = array_map(function ($note) {
        return explode(',', trim($note));
      }, $_POST['notes']);
    } else {
      $notes = [];
    }
    $this->notes = $notes;
  }

  public function setDuree($duree)
  {
    list($heures, $minutes) = explode(':', $duree);
    $this->duree = [$heures, $minutes];
  }
}
?>