<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant infos</title>

</head>

<body class="bg-slate-50">
  <?php require_once 'views/components/header.php' ?>
  <div class="flex flex-row gap-4 m-4 justify-center">
    <div class="flex flex-col gap-4 bg-white rounded rounded-xl p-4 shadow shadow-lg w-1/2">
      <div class="flex flex-col gap-4">
        <h1 class="text-xl font-bold m-auto"><?= $restaurant->nom ?></h1>
        <div class="text-sm flex flex-col gap-4"><?= $restaurant->description ?></div>
      </div>
      <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
        <div class="flex gap-4 justify-end w-full">
          <a href="index.php?action=deleteRestaurant&id=<?= $id ?>"
            class="bg-red-500 hover:bg-red-700 ease-in duration-100 text-white p-2 rounded"><i
              class="fa-solid fa-trash"></i></a>
          <a href="index.php?action=updateRestaurant&id=<?= $restaurant->id ?>"
            class="bg-blue-500 hover:bg-blue-700 ease-in duration-100 text-white p-2 rounded"><i
              class="fa-solid fa-pen"></i></a>
        </div>
      <?php endif ?>
    </div>
    <div class="h-fit text-sm flex flex-col gap-4 p-4 rounded rounded-lg bg-white shadow shadow-lg">
      <h1 class="text-xl font-bold">Notre Carte</h1>
      <div>
        <?= $restaurant->carte ?>
      </div>
    </div>
    <div class="h-fit text-sm flex flex-col gap-4 p-4 rounded rounded-lg bg-white shadow shadow-lg">
      <h1 class="text-xl font-bold">Nos Menus</h1>
      <div>
        <?= $restaurant->menus ?>
      </div>
    </div>
  </div>


  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/16516bbfae.js" crossorigin="anonymous"></script>
</body>

</html>