<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
</head>

<body class="bg-slate-50">
    <?php require_once 'views/components/header.php' ?>
    <div
        class="flex flex-col justify-center items-center bg-white w-2/3 h-full mt-8 shadow shadow-lg m-auto py-8 gap-3">
        <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
            <h1 class="text-2xl">Cher Admin</h1>
            <p class="ml-2">Bienvenue sur notre site de gestion de films et de restaurants. Vous pouvez ajouter,
                modifier et supprimer des films via la navigation ci-dessus.</p>
        <?php else: ?>
            <h1 class="text-2xl">Bienvenue Cher Visiteur</h1>
            <p class="text-center">Vous pouvez consulter les films et les restaurants via la navigation ci-dessus.</p>
        <?php endif ?>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/16516bbfae.js" crossorigin="anonymous"></script>

</body>

</html>