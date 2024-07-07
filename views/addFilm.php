<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body class="bg-slate-100">
  <?php require_once 'components/header.php' ?>
  <div class="flex flex-col justify-center items-center bg-white w-2/3 h-full m-auto py-2 gap-3">
    <h1 class="text-2xl">Ajouter un film</h1>
    <form action="index.php?action=handleAddFilmSubmit" method="post" class=" flex flex-col gap-4">
      <div>
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required class="border border-2 border-slate-200"><br>
      </div>

      <div>
        <label for="duree_heures">Durée (heures) :</label>
        <input type="number" name="duree_heures" id="duree_heures" required
          class="border border-2 border-slate-200"><br>
      </div>

      <div>
        <label for="duree_minutes">Durée (minutes) :</label>
        <input type="number" name="duree_minutes" id="duree_minutes" required
          class="border border-2 border-slate-200"><br>
      </div>

      <div>
        <label for="genre">Genre :</label>
        <input type="text" name="genre" id="genre" required class="border border-2 border-slate-200"><br>
      </div>

      <div>
        <label for="realisateur">Réalisateur :</label>
        <input type="text" name="realisateur" id="realisateur" required class="border border-2 border-slate-200"><br>
      </div>

      <div>
        <label for="acteurs">Acteurs (séparés par des virgules) :</label>
        <input type="text" name="acteurs" id="acteurs" required class="border border-2 border-slate-200"><br>
      </div>

      <div>
        <label for="annee">Année :</label>
        <input type="number" name="annee" id="annee" required class="border border-2 border-slate-200"><br>
      </div>

      <div>
        <label for="langue">Langue (code) :</label>
        <input type="text" name="langue" id="langue" required class="border border-2 border-slate-200"><br>
      </div>

      <div class="flex flex-col">
        <label for="description">Description :</label>
        <textarea name="description" id="description" required class="border border-2 border-slate-200"></textarea><br>
      </div>

      <div>
        <label for="horaires">Horaires (jour;heures;minutes, séparés par des virgules) :</label>
        <input type="text" name="horaires" id="horaires" required class="border border-2 border-slate-200"><br>
      </div>

      <div>
        <label for="notes">Notes (auteur;valeur;base, séparées par des virgules) :</label>
        <input type="text" name="notes" id="notes" required class="border border-2 border-slate-200"><br>
      </div>

      <input type="submit" value="Ajouter le film" class="border border-1 bg-black text-white p-1 rounded">
    </form>
  </div>


  <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>