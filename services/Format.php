<?php
class Format
{
  public function __construct()
  {
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
      $jour = (string) $horaire['jour'];
      $heures = $horaire["heures"];
      $minutes = $horaire["minutes"];
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