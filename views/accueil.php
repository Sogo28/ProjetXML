<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
</head>
<body>
    <?php require_once 'components/header.php' ?>
    <div class="flex flex-col gap-4 m-4">
        <?php foreach ($films as $film): ?>
            <div class="flex flex-col gap-4 border border-1">
                <a href="index.php?action=film&id=<?= $film->id ?>" class="text-2xl font-bold"><?= $film->titre ?></a>
                <p><?= $film->description ?></p>
            </div>
        <?php endforeach ?>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
