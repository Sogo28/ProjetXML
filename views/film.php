<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film Infos</title>

</head>

<body class="bg-slate-100">
  <?php require_once 'components/header.php' ?>
  <div class="flex flex-col gap-4 m-4 bg-white rounded rounded-xl p-4 shadow shadow-lg">
    <div class="flex flex-col gap-4 ">
      <h1 class="text-2xl font-bold m-auto"><?= $film['titre'] ?></h1>
      <p class="">
        <?php echo $film->genre . " (" . $film->duree["heures"] . "h" . $film->duree["minutes"] . "min)" ?>
      </p>
      <p>De <?= $film->realisateur ?></p>
      <p>Langue : <?= $film->langue["code"] ?></p>
      <?php
      echo "Avec : ";
      foreach ($film->acteurs->acteur as $acteur) {
        echo $acteur . ", ";
      } ?>
      <p>Année : <?= $film->annee ?></p>
      <p class="italic ml-3"><?php foreach ($film->notes->note as $note) {
        echo $note["auteur"] . " : " . $note["valeur"] . "/" . $note["base"] . " ";
      } ?></p>
      <p class="italic ml-3"><?= $film->description ?></p>
    </div>
    <div class="flex gap-4 justify-end w-full">
      <a href="index.php?action=deleteFilm&id=<?= $id ?>" class="bg-red-500 text-white p-2 rounded">Supprimer</a>
      <a href="index.php?action=updateFilm&id=<?= $film->id ?>" class="bg-blue-500 text-white p-2 rounded">Modifier</a>
    </div>
  </div>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/16516bbfae.js" crossorigin="anonymous"></script>
</body>

</html>