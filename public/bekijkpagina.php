<?php
require_once('../src/klant.php');

$id = $_GET['id'] ?? null;
$klant = new Klant();
$klantGegevens = $klant->geefKlantOpId($id);

<<<<<<< HEAD

$klantGegevens = $klant->geefAlleKlanten();

echo "<h2>Details van de klant:</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>klant</th><th>adres</th><th>telefoonnummer</th><th>e-mailadres</th><th>klantId</th><th>Klus</th><th>DetailsKlus</th></tr>";

foreach ($klantGegevens as $result) {
    $gegevens1 = $result['klant'];
    $gegevens2 = $result['adres'];
    $gegevens3 = $result['telefoonnummer'];
    $gegevens4 = $result['e-mailadres'];
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
=======
// Controleer of er minstens één klus is
$heeftKlus = false;
$heeftKosten = false;
foreach ($klantGegevens as $klus) {
    if ($klus['klus'] !== null) {
        $heeftKlus = true;
        if (!empty($klus['totaalBedrag'])) {
            $heeftKosten = true;
        }
    }
>>>>>>> cf1aca74c25452c06b43bb52cd13271f4794f2a8
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Details van de klant</title>
</head>
<body>
    <h2>Details van de klant:</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Klant</th>
            <th>Adres</th>
            <th>Telefoonnummer</th>
            <th>E-mailadres</th>
            <th>KlantId</th>
        </tr>
        <tr>
            <td><?= $klantGegevens[0]['naam'] ?></td>
            <td><?= $klantGegevens[0]['adres'] ?></td>
            <td><?= $klantGegevens[0]['telefoon'] ?></td>
            <td><?= $klantGegevens[0]['email'] ?></td>
            <td><?= $klantGegevens[0]['klantId'] ?></td>
        </tr>
    </table>

    <?php if ($heeftKlus): ?>
        <h3>Klussen:</h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Klus</th>
                <th>Klus Details</th>
                <th>Klus bekijken</th>
                <?php if ($heeftKosten): ?>
                    <th>Kosten</th>
                <?php endif; ?>
                <th>Kosten berekenen</th>
            </tr>
            <?php foreach ($klantGegevens as $klus): ?>
                <?php if ($klus['klus'] !== null): ?>
                    <tr>
                        <td><?= $klus['klus'] ?></td>
                        <td><?= mb_strimwidth($klus['detailsKlus'], 0, 50, '...') ?></td>
                        <td><a href="klusBekijken.php?id=<?= urlencode($klus['klusId']) ?>&klantId=<?= urlencode($klus['klantId']) ?>">Klus bekijken</a></td>
                        <?php if ($heeftKosten): ?>
                            <td><?= !empty($klus['totaalBedrag']) ? "€ {$klus['totaalBedrag']}" : '' ?></td>
                        <?php endif; ?>
                        <td><a href="kostenberekenen.php?id=<?= urlencode($klus['klantId']) ?>&klusId=<?= urlencode($klus['klusId']) ?>">Kosten berekenen</a></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <br>
                            
    <form action="klusToevoegen.php" method="get">
        <input type="hidden" name="id" value="<?= $klantGegevens[0]['klantId'] ?>">
        <input type="submit" value="Klus Toevoegen">
    </form>

    <form action="index.php">
        <input type="submit" value="Terug naar overzicht">
    </form>
</body>
</html>
