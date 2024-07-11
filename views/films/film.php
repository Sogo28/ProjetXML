<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film Infos</title>

</head>

<body class="bg-slate-50">
  <?php require_once 'views/components/header.php' ?>
  <div class="flex flex-col gap-4 mx-auto my-4 bg-white rounded rounded-xl p-4 shadow shadow-lg w-1/2">
    <div class="flex flex-col gap-4">
      <h1 class="text-xl font-bold m-auto"><?= $film->titre ?></h1>
      <p class="">
        <?php echo $film->genre . " (" . $film->duree[0] . "h" . $film->duree[1] . "min)" ?>
      </p>
      <p>De <?= $film->realisateur ?></p>
      <p>Langue : <?= $film->langue ?></p>
      <?php
      echo "Avec : ";
      foreach ($film->acteurs as $acteur) {
        echo $acteur . ", ";
      } ?>
      <p>Année : <?= $film->annee ?></p>

      <?php
      if (isset($film->notes)) {
        ?>
        <p class="italic ml-3">
          <?php
          foreach ($film->notes as $note) {
            echo $note[0] . " : " . $note[1] . "/" . $note[2] . " ";
          }
          ?>
        </p>
        <?php
      }
      ?>
      <p class="italic ml-3 p-3 bg-slate-100 rounded rounded-lg"><?= $film->description ?></p>
      <div>
        <h3 class="font-bold">Horaires</h3>
        <?php foreach ($horairesFormatees as $jour => $heure): ?>
          <p><?= $jour ?> : <?= $heure ?></p>
        <?php endforeach; ?>
      </div>
    </div>
    <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
      <div class="flex gap-4 justify-end w-full">
        <a href="index.php?action=deleteFilm&id=<?= $id ?>"
          class="bg-red-500 hover:bg-red-700 ease-in duration-100 text-white p-2 rounded"><i
            class="fa-solid fa-trash"></i></a>
        <a href="index.php?action=updateFilm&id=<?= $film->id ?>"
          class="bg-blue-500 hover:bg-blue-700 ease-in duration-100 text-white p-2 rounded"><i
            class="fa-solid fa-pen"></i></a>
      </div>
    <?php endif ?>
  </div>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/16516bbfae.js" crossorigin="anonymous"></script>
</body>

</html>