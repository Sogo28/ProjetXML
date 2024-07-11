<div class="flex flex-col mb-8">
  <?php if (array_filter($restaurants)): ?>
    <div class="flex flex-col gap-8">
      <?php foreach ($restaurants as $restaurant): ?>
        <div class="flex flex-col gap-4 bg-white py-4 px-4 shadow shadow-xl rounded rounded-lg">
          <div class="flex flex-col border-b-2 border-slate-300">
            <a href="index.php?action=restaurant&id=<?= $restaurant->id ?>"
              class="text-xl font-bold"><?= $restaurant->nom ?></a>
            <p class="text-xs italic">Restaurateur : <?= $restaurant->nomRestaurateur ?></p>
          </div>
          <p class="text-sm"><i class="fa-solid fa-map-pin"></i> <?= $restaurant->adresse ?></p>
          <a href="index.php?action=restaurant&id=<?= $restaurant->id ?>"
            class="self-end mr-4 bg-slate-100 px-3 py-1 rounded rounded-lg hover:bg-black hover:text-white  ease-in duration-100"><i
              class="fa-solid fa-eye"></i></a>
        </div>
      <?php endforeach ?>
    </div>
  <?php else: ?>
    <div class="flex flex-col gap-4">
      <h1 class="text-xl">Aucun Restaurant trouvé</h1>
    </div>
  <?php endif ?>
</div>