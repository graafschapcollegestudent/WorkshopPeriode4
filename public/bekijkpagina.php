<?php
require_once('../src/klant.php');

$id = $_GET['id'] ?? null;
$klant = new Klant();
$klantGegevens = $klant->geefKlantOpId($id);
$actiefAdres = $klant->geefActiefAdres($id);

$heeftKlus = false;
$heeftKosten = false;
foreach ($klantGegevens as $klus) {
    if ($klus['klus'] !== null) {
        $heeftKlus = true;
        if (!empty($klus['totaalBedrag'])) {
            $heeftKosten = true;
        }
    }
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
        <td><?= htmlspecialchars($actiefAdres) ?></td>
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
                    <th>Voorrijkosten</th>
                    <th>Uurtarief</th>
                    <th>Aantal uur</th>
                    <th>Totale kosten</th>
                <?php endif; ?>
                <th>Kosten berekenen</th>
                <th>Facturatie</th>
                <?php if ($klus['gefactureerd'] == 1) : ?>
                    <th>Betaald</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($klantGegevens as $klus): ?>
                <?php if ($klus['klus'] !== null): ?>
                    <tr>
                        <td><?= $klus['klus'] ?></td>
                        <td><?= mb_strimwidth($klus['detailsKlus'], 0, 50, '...') ?></td>
                        <td><a href="klusBekijken.php?id=<?= urlencode($klus['klusId']) ?>&klantId=<?= urlencode($klus['klantId']) ?>">Klus bekijken</a></td>
                        <?php if ($heeftKosten): ?>
                            <td><?= !empty($klus['voorrijkosten']) ? "€ {$klus['voorrijkosten']}" : 'hoi' ?></td>
                            <td><?= !empty($klus['uurTarief']) ? "€ {$klus['uurTarief']}" : '' ?></td>
                            <td><?= !empty($klus['urenGewerkt']) ? "{$klus['urenGewerkt']} uur" : '' ?></td>
                            <td><?= !empty($klus['totaalBedrag']) ? "€ {$klus['totaalBedrag']}" : '' ?></td>
                        <?php endif; ?>
                        <td><a href="kostenberekenen.php?id=<?= urlencode($klus['klantId']) ?>&klusId=<?= urlencode($klus['klusId']) ?>">Kosten berekenen</a></td>
                        <td>
                            <?php if (isset($klus['gefactureerd']) && $klus['gefactureerd'] == 1): ?>
                                Gefactureerd
                                <?php else: ?>
                                    <a href="factuurAanmaken.php?id=<?= urlencode($klus['klantId']) ?>&klusId=<?= urlencode($klus['klusId']) ?>">Factuur maken</a>
                                    <?php endif; ?>
                                </td>
                                <?php if (isset($klus['gefactureerd']) && $klus['gefactureerd'] == 1): ?>
                                    <td><input type="checkbox" name="betaald"></td>
                                <?php endif; ?>
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
    <form method="post" action="updateAdres.php">
        <input type="hidden" name="klantId" value="<?= $klantGegevens[0]['klantId'] ?>">
        <input type="text" name="nieuwAdres" placeholder="Nieuw adres" required>
        <input type="submit" value="Adres bijwerken">
    </form>

    <form action="index.php">
        <input type="submit" value="Terug naar overzicht">
    </form>
</body>

echo $datum = date("d-m-Y")  . "<br>";
echo date('d-m-Y', strtotime('+1 week'));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    
    <h1>Kies een periode</h1>
        <form method="POST">
            Start datum: <input type="date" name="startDate" required>
        <br><br>
            Eind datum: <input type="date" name="endDate" required>
        <br><br>

        <button name="calculeren" type="submit">Calculeren</button>
    </form>

    <?php
    if (isset($_POST['calculeren']))
    {
        echo $startDate = $_POST["startDate"] . "<br>";
        echo $endDate = $_POST["endDate"] . "<br>";
        
    }

