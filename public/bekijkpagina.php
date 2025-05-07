<?php
require_once('../src/klant.php');
$id = $_GET['id'];

$klant = new Klant();


$klantGegevens = $klant->geefAlleKlanten($id);

echo "<h2>Details van de klant:</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>k.klant</th><th>k.adres</th><th>k.telefoonnummer</th><th>k.e-mailadres</th><th>k.klantId</th><th>k.Klus</th><th>k.DetailsKlus</th></tr>";

foreach ($klantGegevens as $result) {
    $gegevens1 = $result['k.klant'];
    $gegevens2 = $result['k.adres'];
    $gegevens3 = $result['k.telefoonnummer'];
    $gegevens4 = $result['k.e-mailadres'];
    $gegevens5 = $result['k.klantId'];
    $gegevens6 = $result['k.Klus'];
    $gegevens7 = $result['k.DetailsKlus'];

    echo "<tr>";
    echo "<td>$gegevens1</td>";
    echo "<td>$gegevens2</td>";
    echo "<td>$gegevens3</td>";
    echo "<td>$gegevens4</td>";
    echo "<td>$gegevens5</td>";
    echo "<td>$gegevens6</td>";
    echo "<td>$gegevens7</td>";
    

    echo "</tr>";
}

echo "</table>";
?>

