<?php
require_once('../src/klant.php');
$id = $_GET['id'];

$klant = new Klant();

$klantGegevens = $klant->geefKlantOpId($id);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Details van de klant</title>
</head> 
<body>
    <h2>Details van de klant:</h2>
    <table border='1' cellpadding='5' cellspacing='0'>
        <tr>
            <th>Klant</th>
            <th>Adres</th>
            <th>Telefoonnummer</th>
            <th>E-mailadres</th>
            <th>KlantId</th>
            <th>Klus</th>
            <th>DetailsKlus</th>
        </tr>
        <tr>
            <td><?php echo $klantGegevens['naam']; ?></td>
            <td><?php echo $klantGegevens['adres']; ?></td>
            <td><?php echo $klantGegevens['telefoon']; ?></td>
            <td><?php echo $klantGegevens['email']; ?></td>
            <td><?php echo $klantGegevens['klantId']; ?></td>
            <td><?php echo $klantGegevens['klus']; ?></td>
            <td><?php echo $klantGegevens['detailsKlus']; ?></td>
        </tr>
    </table>

    <br>
    
    <form action="index.php">
        <input type="submit" value="Terug naar overzicht">
    </form>
</body>
</html>



$klantGegevens = $klant->geefAlleKlanten($id);

echo "<h2>Details van de klant:</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>k.klant</th><th>k.adres</th><th>k.telefoonnummer</th><th>k.e-mailadres</th><th>k.klantId</th><th>k.Klus</th><th>k.DetailsKlus</th></tr>";

foreach ($klantGegevens as $result) {
    $gegevens1 = $result['naam'];
    $gegevens2 = $result['adres'];
    $gegevens3 = $result['telefoon'];
    $gegevens4 = $result['email'];
    $gegevens5 = $result['klantId'];
    $gegevens6 = $result['Klus'];
    $gegevens7 = $result['DetailsKlus'];

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

<a href="kostenberekenen.php">test</a>

