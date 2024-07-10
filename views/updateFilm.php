<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body class="bg-slate-100">
  <?php require_once 'components/header.php' ?>
  <div class="flex flex-col justify-center items-center bg-white w-2/3 h-full mt-8 shadow shadow-lg m-auto py-8 gap-3">
    <h1 class="text-2xl">Modifier un film</h1>
    <form action="index.php?action=handleUpdateFilmSubmit&id=<?= $film->id ?>" method="post"
      class=" flex flex-col gap-2 w-full px-8 ">

      <div class="flex flex-row justify-between">
        <div class="flex flex-col">
          <label for="titre">Titre</label>
          <input type="text" name="titre" id="titre" required
            class="border border-1 p-2 rounded rounded-lg  border-slate-300 text-sm w-60 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
            placeholder="Le seigneur des anneaux..." value="<?= $film->titre ?>">
        </div>

        <div class="flex flex-col">
          <label for="duree_heures">Durée</label>
          <input type="time" name="duree_heures" id="duree_heures" required
            class="border border-1 p-2 rounded rounded-lg  border-slate-300 text-sm w-60 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
            value="<?= implode(":", [$film->duree[0], $film->duree[1]]) ?>">
        </div>
      </div>


      <div class="flex flex-row justify-between">
        <div class="flex flex-col">
          <label for="genre">Genre</label>
          <input type="text" name="genre"
            class="border border-1 p-2 rounded rounded-lg  border-slate-300 text-sm w-60 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
            value="<?= $film->genre ?>">
        </div>
        <div class="flex flex-col">
          <label for="realisateur">Réalisateur</label>
          <input type="text" name="realisateur" id="realisateur" required
            class="border border-1 p-2 rounded rounded-lg  border-slate-300 text-sm w-60 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
            value="<?= $film->realisateur ?>">
        </div>
      </div>
      <div class="flex flex-row justify-between">
        <div class="flex flex-col">
          <label for="langue">Langue</label>
          <select name="langue" id="genre" required
            class="border border-1 p-2 rounded rounded-lg  border-slate-300 text-sm w-60 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            <?php if ($film->langue == "vf"): ?>
              <option value="vf" selected>Français</option>
              <option value="en">Anglais</option>
            <?php else: ?>
              <option value="vf">Français</option>
              <option value="en" selected>Anglais</option>
            <?php endif; ?>
          </select>
        </div>
        <div class="flex flex-col">
          <label for="annee">Année</label>
          <input type="number" name="annee" id="annee" required
            class="border border-1 p-2 rounded rounded-lg  border-slate-300 text-sm w-60 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
            placeholder="2003..." value="<?= $film->annee ?>">
        </div>
      </div>
      <div class="flex flex-col">
        <label for="description">Description</label>
        <textarea name="description" id="description" required
          class="border border-1 p-2 rounded rounded-lg  border-slate-300 text-sm w-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent mb-2"><?= $film->description ?></textarea>
      </div>

      <div class="flex flex-col mt-4 gap-1 bg-slate-100 p-2 rounded shadow">
        <h2 class="text-lg font-bold text-center">Acteurs</h2>
        <table id="acteurs">
          <tr>
            <td class="text-left">Nom de l'acteur</td>
          </tr>
          <?php foreach ($film->acteurs as $acteur): ?>
            <tr>
              <td><input type="text" name="acteurs[]"
                  class="border-b-2 p-2 rounded rounded-lg  border-slate-300 text-sm w-80 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent mb-2"
                  value="<?= $acteur ?>">
              </td>
            </tr>
          <?php endforeach; ?>
          <!-- <td><input type="text" name="acteurs[]"
                class="border-b-2 p-2 rounded rounded-lg  border-slate-300 text-sm w-80 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent mb-2">
            </td> -->
        </table>
        <div class="flex gap-4 justify-end w-full">
          <input type="button" value="Ajouter" onclick="addRowsActeurs()"
            class="bg-green-500 text-white rounded p-2 text-sm cursor-pointer" />
          <input type="button" value="Supprimer" onclick="deleteRowsActeurs()"
            class="bg-red-500 text-white rounded p-2 text-sm cursor-pointer" />
        </div>
      </div>

      <div class="flex flex-col mt-4 gap-1 bg-slate-100 p-2 rounded">
        <h2 class="text-lg font-bold text-center">Horaires</h2>
        <table id="horaires">
          <tr>
            <td class="text-left">Jour</td>
            <td class="text-left">Heure</td>
          </tr>

          <!-- <td id="col0">
              <select name="horairesJours[]" id="horairesJours"
                class="border-b-2 p-2 rounded rounded-lg  border-slate-300 text-sm w-80 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                required>
                <option value="Lun">Lundi</option>
                <option value="Mar">Mardi</option>
                <option value="Mer">Mercredi</option>
                <option value="Jeu">Jeudi</option>
                <option value="Ven">Vendredi</option>
                <option value="Sam">Samedi</option>
                <option value="Dim">Dimanche</option>
              </select>
            </td>
            <td id="col1"><input type="time" name="horairesHeures[]"
                class="border-b-2 p-2 rounded rounded-lg  border-slate-300 text-sm w-40 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent mb-2"
                required>
            </td> -->
          <?php foreach ($film->horaires as $horaire): ?>
            <tr>
              <td id="col0">
                <select name="horairesJours[]" id="horairesJours"
                  class="border-b-2 p-2 rounded rounded-lg  border-slate-300 text-sm w-80 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                  required>
                  <option value="Lun" <?= $horaire[0] == "Lun" ? "selected" : "" ?>>Lundi</option>
                  <option value="Mar" <?= $horaire[0] == "Mar" ? "selected" : "" ?>>Mardi</option>
                  <option value="Mer" <?= $horaire[0] == "Mer" ? "selected" : "" ?>>Mercredi</option>
                  <option value="Jeu" <?= $horaire[0] == "Jeu" ? "selected" : "" ?>>Jeudi</option>
                  <option value="Ven" <?= $horaire[0] == "Ven" ? "selected" : "" ?>>Vendredi</option>
                  <option value="Sam" <?= $horaire[0] == "Sam" ? "selected" : "" ?>>Samedi</option>
                  <option value="Dim" <?= $horaire[0] == "Dim" ? "selected" : "" ?>>Dimanche</option>
                </select>
              </td>
              <td id="col1"><input type="time" name="horairesHeures[]"
                  class="border-b-2 p-2 rounded rounded-lg  border-slate-300 text-sm w-40 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent mb-2"
                  required value="<?= implode(":", [$horaire[1], $horaire[2]]) ?>">
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
        <div class="flex gap-4 justify-end w-full">
          <input type="button" value="Ajouter" onclick="addRowsHoraires()"
            class="bg-green-500 text-white rounded p-2 text-sm cursor-pointer" />
          <input type="button" value="Supprimer" onclick="deleteRowsHoraires()"
            class="bg-red-500 text-white rounded p-2 text-sm cursor-pointer" />
        </div>
      </div>

      <div class="flex flex-col mt-4 gap-1 bg-slate-100 p-2 rounded">
        <h2 class="text-lg font-bold text-center">Notes</h2>
        <table id="notes">
          <tr>
            <td class="text-left">Note (Auteur,valeur,base)</td>
          </tr>
          <?php if (isset($film->notes)): ?>
            <?php foreach ($film->notes as $note): ?>
              <tr>
                <td><input type="text" name="notes[]"
                    class="border-b-2 p-2 rounded rounded-lg  border-slate-300 text-sm w-80 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent mb-2"
                    value="<?= implode(",", $note) ?>">
                </td>
              <?php endforeach; ?>
            <?php else: ?>
              <td id="col0"><input type="text" name="notes[]"
                  class="border-b-2 p-2 rounded rounded-lg  border-slate-300 text-sm w-80 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent mb-2">
            </tr>
            </td>
          <?php endif; ?>
        </table>
        <div class="flex gap-4 justify-end w-full">
          <input type="button" value="Ajouter" onclick="addRowsNotes()"
            class="bg-green-500 text-white rounded p-2 text-sm cursor-pointer" />
          <input type="button" value="Supprimer" onclick="deleteRowsNotes()"
            class="bg-red-500 text-white rounded p-2 text-sm cursor-pointer" />
        </div>
      </div>


      <input type="submit" value="Modifier le film"
        class="cursor-pointer mt-4 border border-1 bg-indigo-500 text-white p-1 rounded hover:bg-indigo-700">
    </form>
  </div>


  <script src="https://cdn.tailwindcss.com"></script>
  <script type="text/javascript">
    function addRowsActeurs() {
      var table = document.getElementById("acteurs");
      var rowCount = table.rows.length;
      var cellCount = table.rows[0].cells.length;
      var row = table.insertRow(rowCount);
      for (var i = 0; i < cellCount; i++) {
        var newcell = row.insertCell(i);
        newcell.innerHTML = table.rows[1].cells[i].innerHTML;
      }
    }
    function deleteRowsActeurs() {
      var table = document.getElementById("acteurs");
      var rowCount = table.rows.length;
      if (rowCount > 2) {
        table.deleteRow(rowCount - 1);
      }
    }
    function addRowsHoraires() {
      var table = document.getElementById("horaires");
      var rowCount = table.rows.length;
      var cellCount = table.rows[0].cells.length;
      var row = table.insertRow(rowCount);
      for (var i = 0; i < cellCount; i++) {
        var cell = 'cell' + i;
        cell = row.insertCell(i);
        var copycel = document.getElementById('col' + i).innerHTML;
        cell.innerHTML = copycel;
      }
    }
    function deleteRowsHoraires() {
      var table = document.getElementById("horaires");
      var rowCount = table.rows.length;
      if (rowCount > 2) {
        table.deleteRow(rowCount - 1);
      }
    }
    function addRowsNotes() {
      var table = document.getElementById("notes");
      var rowCount = table.rows.length;
      var cellCount = table.rows[0].cells.length;
      var row = table.insertRow(rowCount);
      for (var i = 0; i < cellCount; i++) {
        var newcell = row.insertCell(i);
        newcell.innerHTML = table.rows[1].cells[i].innerHTML;
      }
    }
    function deleteRowsNotes() {
      var table = document.getElementById("notes");
      var rowCount = table.rows.length;
      if (rowCount > 2) {
        table.deleteRow(rowCount - 1);
      }
    }
  </script>
</body>

</html>