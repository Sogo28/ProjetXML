<?php
class FilmDAO
{
  public $dataPath = 'data\films.xml';
  public $Films;
  function __construct()
  {
    if ($this->isValid($this->dataPath)[0]) {
      $this->Films = simplexml_load_file($this->dataPath);
    } else {
      exit("Le fichier xml n'est pas valide.");
    }
  }
  private function isValid($dataPath)
  {
    if (!file_exists($dataPath)) {
      return false;
    }
    $dom = new DOMDocument();
    $dom->Load($dataPath);
    libxml_use_internal_errors(true);
    if (!$dom->validate()) {
      // iterate over the errors and put it in a string
      $errors = "";
      foreach (libxml_get_errors() as $error) {
        $errors .= $error->message . "<br>";
      }
      return [false, $errors];
    } else {
      // $this->Films = simplexml_import_dom($dom);
      return [true, null];
    }
  }
  public function getAll()
  {
    return $this->Films->xpath("//Film[@deleted='false']");
  }
  public function getByid($id)
  {
    return $this->Films->xpath("//Film[@id='$id']")[0];
  }
  public function getByGenre($genre)
  {
    return $this->Films->xpath("//Film[genre='$genre' and @deleted='false']");
  }
  public function getAllGenres()
  {
    // return $this->Films->xpath("//Film/genre");
    // get all genres from the xml file without duplicates
    $genres = [];
    foreach ($this->Films->Film as $film) {
      $genre = (string) $film->genre;
      if (!in_array($genre, $genres)) {
        $genres[] = $genre;
      }
    }
    return $genres;
  }
  public function addFilm($Film)
  {
    $newFilm = $this->Films->addChild('Film');
    $newFilm->addAttribute('titre', $Film->titre);
    $newFilm->addAttribute('deleted', $Film->deleted);
    $newFilm->addAttribute('id', $Film->id);
    $newFilmDuree = $newFilm->addChild('duree');
    $newFilmDuree->addAttribute('heures', (string) $Film->duree[0]);
    $newFilmDuree->addAttribute('minutes', (string) $Film->duree[1]);
    $newFilm->addChild('genre', $Film->genre);
    $newFilm->addChild('realisateur', $Film->realisateur);
    $newFilmActeurs = $newFilm->addChild('acteurs');
    foreach ($Film->acteurs as $acteur) {
      $newFilmActeurs->addChild('acteur', $acteur);
    }
    $newFilm->addChild('annee', $Film->annee);
    $newFilmLangue = $newFilm->addChild('langue');
    $newFilmLangue->addAttribute('code', $Film->langue);
    $newFilm->addChild('description', $Film->description);
    $newFilmHoraires = $newFilm->addChild('horaires');
    foreach ($Film->horaires as $horaire) {
      $newHoraire = $newFilmHoraires->addChild('horaire');
      $newHoraire->addAttribute('jour', $horaire[0]);
      $newHoraire->addAttribute('heures', $horaire[1]);
      $newHoraire->addAttribute('minutes', $horaire[2]);
    }
    if (!empty($Film->notes)) {
      $newFilmNotes = $newFilm->addChild('notes');
      foreach ($Film->notes as $note) {
        $newNote = $newFilmNotes->addChild('note');
        $newNote->addAttribute('auteur', $note[0]);
        $newNote->addAttribute('valeur', $note[1]);
        $newNote->addAttribute('base', $note[2]);
      }
    }
    $this->Films->asXML("data\\temp.xml");
    $isValid = $this->isValid("data\\temp.xml");
    if ($isValid[0]) {
      $this->Films->asXML($this->dataPath);
      unlink("data\\temp.xml");
      return [true, $Film->id];
    } else {
      unlink("data\\temp.xml");
      return [false, $isValid[1]];
    }
  }
  public function deleteFilm($id)
  {
    $removedfilm = $this->getByid($id);
    $removedfilm['deleted'] = "true";
    $this->Films->asXML($this->dataPath);
    echo ("Film Supprimé avec succès.");
  }
  public function updateFilm($id, $Film)
  {
    $filmToUpdate = $this->Films->xpath("//Film[@id='$id']")[0];
    $filmToUpdate['titre'] = $Film->titre;
    $filmToUpdate['deleted'] = $Film->deleted;
    $filmToUpdate->duree->attributes()->heures = $Film->duree[0];
    $filmToUpdate->duree->attributes()->minutes = $Film->duree[1];
    $filmToUpdate->genre = $Film->genre;
    $filmToUpdate->realisateur = $Film->realisateur;
    $filmToUpdate->acteurs = '';
    foreach ($Film->acteurs as $acteur) {
      $filmToUpdate->acteurs->addChild('acteur', $acteur);
    }
    $filmToUpdate->annee = $Film->annee;
    $filmToUpdate->langue->attributes()->code = $Film->langue;
    $filmToUpdate->description = $Film->description;
    $filmToUpdate->horaires = '';
    foreach ($Film->horaires as $horaire) {
      $newHoraire = $filmToUpdate->horaires->addChild('horaire');
      $newHoraire->addAttribute('jour', $horaire[0]);
      $newHoraire->addAttribute('heures', $horaire[1]);
      $newHoraire->addAttribute('minutes', $horaire[2]);
    }
    $filmToUpdate->notes = '';
    foreach ($Film->notes as $note) {
      $newNote = $filmToUpdate->notes->addChild('note');
      $newNote->addAttribute('auteur', $note[0]);
      $newNote->addAttribute('valeur', $note[1]);
      $newNote->addAttribute('base', $note[2]);
    }
    libxml_use_internal_errors(true);
    if ($this->Films === false) {
      foreach (libxml_get_errors() as $error) {
        echo $error->message;
      }
    } else {
      $this->Films->asXML($this->dataPath);
      echo ("Film modifié avec succès.");
    }
  }


}
?>