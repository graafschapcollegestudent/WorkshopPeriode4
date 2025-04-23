<?php
include_once '../src/klant.php';
$klant = new Klant();

$alleKlanten = $klant->geefAlleKlanten();

?>
<table border="1">
  <tr>
    <th>Klant</th>
    <th>e-mail</th>
    <th>Telefoonnummer</th>
    <th>Adres</th>
  </tr>
  <?php foreach ($alleKlanten as $rij): ?>
    <tr>
      <td><?= $rij['klant']; ?></td>
      <td><?= $rij['e-mailadres']; ?></td>
      <td><?= $rij['telefoonnummer']; ?></td>
      <td><?= $rij['adres']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<br>

<form action="toevoegen.php">
  <input type="submit" value="Klant Toevoegen">
</form>