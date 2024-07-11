<div class="flex flex-col mb-8">
  <div class="flex flex-row gap-4 py-2 items-center w-full mb-2">
    <a href="index.php?action=film"
      class="border-b-0 text-sm text-black bg-white px-2 py-1 rounded rounded-lg hover:text-white shadow shadow-lg hover:bg-black ease-in duration-100 font-medium">Tout
      Genre</a>
    <?php foreach ($genres as $genre): ?>
      <a href="index.php?action=genre&value=<?= $genre ?>"
        class="border-b-0 text-sm text-black bg-white px-2 py-1 rounded rounded-lg hover:text-white shadow shadow-lg hover:bg-black ease-in duration-100 font-medium"><?= $genre ?></a>
    <?php endforeach ?>
  </div>
  <?php if (array_filter($films)): ?>
    <div class="flex flex-col gap-8">
      <?php foreach ($films as $film): ?>
        <div class="flex flex-col gap-4 bg-white py-4 px-4 shadow shadow-xl rounded rounded-lg">
          <div class="flex flex-col border-b-2 border-slate-300">
            <a href="index.php?action=film&id=<?= $film->id ?>" class="text-xl font-bold"><?= $film->titre ?></a>
            <p class="text-xs italic">De <?= $film->realisateur ?></p>
          </div>
          <p class="text-sm"><?= $film->description ?></p>
          <div class="flex flex-row gap-4 items-center">
            <p class="text-xs text-black px-2 font-bold">
              <i class="fa-solid fa-clock"></i>
              <?= $film->duree[0] . ":" . $film->duree[1] ?>
            </p>
            <p class="text-xs text-black px-2 font-bold">
              <i class="fa-solid fa-film"></i>
              <?= $film->genre ?>
            </p>
          </div>
          <a href="index.php?action=film&id=<?= $film->id ?>"
            class="self-end mr-4 bg-slate-100 px-3 py-1 rounded rounded-lg hover:bg-black hover:text-white  ease-in duration-100"><i
              class="fa-solid fa-eye"></i></a>
        </div>
      <?php endforeach ?>
    </div>
  <?php else: ?>
    <div class="flex flex-col gap-4">
      <h1 class="text-xl">Aucun film trouvé</h1>
    </div>
  <?php endif ?>
</div>