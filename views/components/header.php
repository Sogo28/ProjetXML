<div class="w-full bg-black text-white flex flex-row justify-center items-center gap-4">
  <a href="index.php" class="font-bold">Accueil</a>
  <?php foreach ($genres as $genre): ?>
      <a href="index.php?action=genre&value=<?= $genre ?>" class="font-bold"><?= $genre ?></a>
    <?php endforeach ?>
  <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
    <a href="index.php?action=addFilm" class="font-bold">Ajouter un film</a>
    <a href="index.php?action=logout" class="font-bold">Se déconnecter</a>
  <?php else: ?>
    <a href="index.php?action=login" class="font-bold">Se connecter</a>
  <?php endif; ?>
</div>
