<<<<<<< HEAD
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
=======
<div class="w-full text-black flex flex-row gap-4 px-4 py-2 justify-between bg-white items-center shadow shadow-lg">
  <a href="index.php" class="text-sm italic font-bold">SenFilms</a>
  <a href="index.php?action=login"
    class="rounded rounded-lg px-2 py-1 text-black pointer font-bold text-sm ease-in duration-100">Se
    connecter</a>
</div>
>>>>>>> 5d03d43b4079a4892fe421433e214cfa807e6fe1
