<link rel="stylesheet" href="../css/style.css">
<?php
include_once '../src/klant.php';
include_once '../src/vooraad.php';
$klant = new Klant();
$voorraad = new Vooraad();

$alleVoorraad = $voorraad->geefAlleVooraden();

foreach ($alleVoorraad as $product) {
  if ($product['aantal'] <= 10){
    echo "Let Op! Er is van {$product['naam']} nog maar {$product['aantal']} over <br>";
  }
}
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

<div class="card">
  <table cellpadding='5' cellspacing='0'>
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
        <td><?= htmlspecialchars($rij['adres'] ?? ''); ?></td>
        <td><a href="bekijkpagina.php?id=<?= urlencode($rij['klantId']); ?>">Bekijk</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
<br>


<form action="toevoegen.php">
  <input type="submit" value="Klant Toevoegen" class="klantToevoegen">
</form>

<form action="Voorraad.php">
  <input type="submit" value="Voorraad bekijken" class="voorraadBekijken">
</form>