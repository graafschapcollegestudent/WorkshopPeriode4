<?php
include_once '../src/klant.php';
$klant = new Klant();

// Zoekfunctie
if (isset($_POST['zoeken'])) {
    $zoekterm = $_POST['invoerAdres'];
    if ($zoekterm == "") {
        $alleKlanten = $klant->geefAlleKlanten();
    } else {
        $alleKlanten = $klant->geefKlantenOpAdresOfNaam($zoekterm);
    }
} else {
    $alleKlanten = $klant->geefAlleKlanten();
}
?>
<form action="" method="POST">
  Voer een naam of adres in: 
  <input type="text" name="invoerAdres" id="invoer">
  <input type="submit" value="Zoeken" name="zoeken">
</form>

<table border="1" cellpadding='5' cellspacing='0'>
  <tr>
    <th>Klant</th>
    <th>e-mail</th>
    <th>Telefoonnummer</th>
    <th>Adres</th>
    <th>Bekijk</th>
  </tr>

  <?php 
  
  foreach ($alleKlanten as $rij): ?>
    <tr>
      <td><?= htmlspecialchars($rij['naam']); ?></td>
      <td><?= htmlspecialchars($rij['email']); ?></td>
      <td><?= htmlspecialchars($rij['telefoon']); ?></td>
      <td><?= htmlspecialchars($rij['adres']); ?></td>
      <td><a href="bekijkpagina.php?id=<?= urlencode($rij['klantId']); ?>">Bekijk</a></td>
    </tr>
  <?php endforeach; ?>
</table>

<br>

<form action="toevoegen.php">
  <input type="submit" value="Klant Toevoegen">
</form>