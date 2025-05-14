<?php
require_once('../src/klant.php');
$id = $_GET['id'];

$klant = new Klant();

$klantGegevens = $klant->geefKlantOpId($id);

// Controleer of er minstens één klus is
$heeftKlus = false;
foreach ($klantGegevens as $klus) {
    if ($klus['klus'] !== null) {
        $heeftKlus = true;
        break;
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
    <table border='1' cellpadding='5' cellspacing='0'>
        <tr>
            <th>Klant</th>
            <th>Adres</th>
            <th>Telefoonnummer</th>
            <th>E-mailadres</th>
            <th>KlantId</th>
        </tr>
        <tr>
            <td><?php echo $klantGegevens[0]['naam']; ?></td>
            <td><?php echo $klantGegevens[0]['adres']; ?></td>
            <td><?php echo $klantGegevens[0]['telefoon']; ?></td>
            <td><?php echo $klantGegevens[0]['email']; ?></td>
            <td><?php echo $klantGegevens[0]['klantId']; ?></td>
        </tr>
    </table>
    <?php if ($heeftKlus) { ?>
        <h3>Klussen:</h3>
        <table border='1' cellpadding='5' cellspacing='0'>
            <tr>
                <th>Klus</th>
                <th>Klus Details</th>
                <th>Klus bekijken</th>
            </tr>
            <?php foreach ($klantGegevens as $klus) {
                if ($klus['klus'] !== null) { ?>
                    <tr>
                        <td><?php echo $klus['klus']; ?></td>
                        <td><?php echo mb_strimwidth($klus['detailsKlus'], 0, 50, '...'); ?></td>
                        <td>
                            <a href="klusBekijken.php?id=<?= urlencode($klus['klusId']) ?>&klantId=<?= urlencode($klus['klantId']) ?>">Klus bekijken</a>
                        </td>
                    </tr>
            <?php }
            } ?>
        </table>
    <?php } ?>
    <br>
    <form action="klusToevoegen.php" method="get">
        <input type="hidden" name="id" value="<?= htmlspecialchars($klantGegevens[0]['klantId']) ?>">
        <input type="submit" value="Klus Toevoegen">
    </form>
    <form action="index.php">
        <input type="submit" value="Terug naar overzicht">
    </form>
</body>
</html>
<a href="kostenberekenen.php?id=<?= $klantGegevens[0]['klantId']?>">kostenberekenen</a>