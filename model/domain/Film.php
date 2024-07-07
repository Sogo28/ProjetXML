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

  function __construct($titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $notes)
  {
    $this->id = uniqid();
    $this->titre = $titre;
    $this->duree = $duree;
    $this->genre = $genre;
    $this->realisateur = $realisateur;
    $this->acteurs = $acteurs;
    $this->annee = $annee;
    $this->langue = $langue;
    $this->description = $description;
    $this->horaires = $horaires;
    $this->notes = $notes;
  }
}
?>