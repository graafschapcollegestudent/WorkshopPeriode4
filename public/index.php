<?php
include_once '../src/klant.php';
$klant = new Klant();
$alleKlanten = $klant->geefAlleKlanten();
?>
<form action="" method="POST">
  Voer een adres in 
  <input type="text" name="invoerAdres" id="invoer">
  <input type="submit" value="Zoeken" name="zoeken">
</form>

<?php if (isset($_POST['zoeken'])) {
  $zoekterm = $_POST['invoerAdres'];
  if ($zoekterm == "") {
    $alleKlanten = $klant->geefAlleKlanten();
  } else {
    $alleKlanten = $klant->geefKlantenOpAdres($zoekterm);
  }
}

?>
</body>
</html>
<table border="1">
  <tr>
    <th>Klant</th>
    <th>e-mail</th>
    <th>Telefoonnummer</th>
    <th>Adres</th>
    <th>Bekijk</th>
  </tr>
  <?php foreach ($alleKlanten as $rij): ?>
    <tr>
      <td><?= $rij['naam']; ?></td>
      <td><?= $rij['email']; ?></td>
      <td><?= $rij['telefoon']; ?></td>
      <td><?= $rij['adres']; ?></td>
      <td><a href="bekijkpagina.php?id=<?= $rij['klantId']; ?>">Bekijk</a></td>
    </tr>
  <?php endforeach; ?>
</table>

<br>

<form action="toevoegen.php">
  <input type="submit" value="Klant Toevoegen">
</form>