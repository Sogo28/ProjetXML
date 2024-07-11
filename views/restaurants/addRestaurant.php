<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un restaurant</title>
</head>

<body>
  <?php require_once 'views/components/header.php' ?>
  <div class="flex flex-col justify-center items-center bg-white w-2/3 h-full mt-8 shadow shadow-lg m-auto py-8 gap-3">
    <h1 class="text-2xl">Ajouter un restaurant</h1>
    <form action="/index.php?action=addRestaurant" method="post" enctype="multipart/form-data">
      <label for="restaurantFile">Fichier XML du restaurant</label>
      <input type="file" name="restaurantFile" id="restaurantFile"
        class="border border-1 p-2 rounded rounded-lg  border-slate-300 text-sm w-60 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
      <button type="submit"
        class="cursor-pointer mt-4 border border-1 bg-slate-500 hover:bg-black text-white p-1 rounded ease-in duration-100">Ajouter</button>
    </form>
  </div>
</body>

</html>