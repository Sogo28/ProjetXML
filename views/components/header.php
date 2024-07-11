<div class="w-full text-black flex flex-row gap-4 px-4 py-2 justify-between bg-white items-center shadow shadow-lg">
  <div>
    <a href="index.php?action=film" class="px-2 text-sm italic font-bold border-r-2 border-black">SenFilms</a>
    <a href="index.php?action=restaurant" class="px-2 text-sm italic font-bold">SenRestaurants</a>
  </div>
  <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
    <a href="index.php?action=logout" class="font-bold">Se déconnecter</a>
  <?php else: ?>
    <a href="index.php?action=login" class="font-bold">Se connecter</a>
  <?php endif; ?>
</div>