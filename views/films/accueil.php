<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Films</title>
</head>

<body class="bg-slate-50 h-full flex flex-col">
  <?php require_once 'views/components/header.php' ?>
  <?php require_once 'views/components/films/addFilm.php' ?>
  <div class="mt-4 mx-8">
    <?php require_once 'views/components/films/filmContainer.php' ?>
  </div>
  <?php require_once 'views/components/footer.php' ?>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/16516bbfae.js" crossorigin="anonymous"></script>
</body>

</html>