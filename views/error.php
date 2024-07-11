<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error</title>
</head>

<body>
  <?php require_once 'views/components/header.php' ?>
  <div class="flex h-screen bg-red-100 w-full justify-center items-center">
    <h1 class="text-4xl"><?= $errorMessage ?></h1>
  </div>
  <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>