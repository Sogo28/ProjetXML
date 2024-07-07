<div class="w-full bg-black text-white flex flex-row justify-center items-center gap-4">
  <a href="index.php" class="font-bold">Accueil</a>
  <a href="index.php?action=addFilm" class="font-bold">Ajouter un film</a>
  <?php foreach ($genres as $genre): ?>
    <a href="index.php?action=genre&value=<?= $genre ?>" class="font-bold"><?= $genre ?></a>
  <?php endforeach ?>
</div>