<?php
require_once('../src/vooraad.php');

$vooraad = new Vooraad();
$vooraadGegevens = $vooraad->geefAlleVooraden();
?>

<h1>Voorraad</h1>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Naam</th>
        <th>Aantal</th>
    </tr>
    <?php foreach ($vooraadGegevens as $vooraaden): ?>
        <tr>
            <td><?= htmlspecialchars($vooraaden['naam']) ?></td>
            <td><?= htmlspecialchars($vooraaden['aantal']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<form action="VooraadToevoegen.php">
  <input type="submit" value="Vooraad Toevoegen">
</form>