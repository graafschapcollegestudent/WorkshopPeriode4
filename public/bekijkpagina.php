<link rel="stylesheet" href="../css/style.css">
<?php
require_once('../src/klant.php');

$id = $_GET['id'] ?? null;
$klant = new Klant();
$klantGegevens = $klant->geefKlantOpId($id);
$actiefAdres = $klant->geefActiefAdres($id);

// Opslaan van Betaald-status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['betaaldOpslaan'])) {
    $klusId = $_POST['klusId'];
    $betaald = isset($_POST['betaald']) ? 1 : 0;
    $klant->updateBetaaldStatus($klusId, $betaald);
    header("Location: bekijkpagina.php?id=" . urlencode($id));
    exit;
}

$nietGefactureerd = [];
$gefactureerd = [];
$betaald = [];

foreach ($klantGegevens as $klus) {
    if ($klus['klus'] !== null) {
        if (!empty($klus['gefactureerd']) && !empty($klus['Betaald'])) {
            $betaald[] = $klus;
        } elseif (!empty($klus['gefactureerd'])) {
            $gefactureerd[] = $klus;
        } else {
            $nietGefactureerd[] = $klus;
        }
    }
}

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
            <td><?= $klantGegevens[0]['adres'] ?></td>
            <td><?= $klantGegevens[0]['telefoon'] ?></td>
            <td><?= $klantGegevens[0]['email'] ?></td>
            <td><?= $klantGegevens[0]['klantId'] ?></td>
        </tr>
    </table>

    <?php if ($heeftKlus): ?>

        <!-- Niet Gefactureerd -->
        <?php if (count($nietGefactureerd) > 0): ?>
        <h3>Openstaande klussen:</h3>
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
            </tr>
            <?php foreach ($nietGefactureerd as $klus): ?>
                <tr>
                    <td><?= $klus['klus'] ?></td>
                    <td><?= mb_strimwidth($klus['detailsKlus'], 0, 50, '...') ?></td>
                    <td><a href="klusBekijken.php?id=<?= urlencode($klus['klusId']) ?>&klantId=<?= urlencode($klus['klantId']) ?>">Klus bekijken</a></td>
                    <?php if ($heeftKosten): ?>
                        <td><?= !empty($klus['voorrijkosten']) ? "€ {$klus['voorrijkosten']}" : '' ?></td>
                        <td><?= !empty($klus['uurTarief']) ? "€ {$klus['uurTarief']}" : '' ?></td>
                        <td><?= !empty($klus['urenGewerkt']) ? "{$klus['urenGewerkt']} uur" : '' ?></td>
                        <td><?= !empty($klus['totaalBedrag']) ? "€ {$klus['totaalBedrag']}" : '' ?></td>
                    <?php endif; ?>
                    <td><a href="kostenberekenen.php?id=<?= urlencode($klus['klantId']) ?>&klusId=<?= urlencode($klus['klusId']) ?>">Kosten berekenen</a></td>
                    <td>
                        <a href="factuurAanmaken.php?id=<?= urlencode($klus['klantId']) ?>&klusId=<?= urlencode($klus['klusId']) ?>">Factuur maken</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <?php endif; ?>

        <!-- Gefactureerd -->
        <?php if (count($gefactureerd) > 0): ?>
        <h3>Gefactureerd:</h3>
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
                <th>Status</th>
                <th>Betaald</th>
            </tr>
            <?php foreach ($gefactureerd as $klus): ?>
                <tr>
                    <td><?= $klus['klus'] ?></td>
                    <td><?= mb_strimwidth($klus['detailsKlus'], 0, 50, '...') ?></td>
                    <td><a href="klusBekijken.php?id=<?= urlencode($klus['klusId']) ?>&klantId=<?= urlencode($klus['klantId']) ?>">Klus bekijken</a></td>
                    <?php if ($heeftKosten): ?>
                        <td><?= !empty($klus['voorrijkosten']) ? "€ {$klus['voorrijkosten']}" : '' ?></td>
                        <td><?= !empty($klus['uurTarief']) ? "€ {$klus['uurTarief']}" : '' ?></td>
                        <td><?= !empty($klus['urenGewerkt']) ? "{$klus['urenGewerkt']} uur" : '' ?></td>
                        <td><?= !empty($klus['totaalBedrag']) ? "€ {$klus['totaalBedrag']}" : '' ?></td>
                    <?php endif; ?>
                    <td>Gefactureerd</td>
                    <td>
                        <form method="post" style="display:inline;" class="betaald-form">
                            <input type="hidden" name="klusId" value="<?= htmlspecialchars($klus['klusId']) ?>">
                            <input type="checkbox" name="betaald" value="1" <?= ($klus['Betaald'] ?? 0) ? 'checked' : '' ?> onchange="this.form.submit()">
                            <input type="hidden" name="betaaldOpslaan" value="1">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <?php endif; ?>

        <!-- Betaald -->
        <?php if (count($betaald) > 0): ?>
        <h3>Betaald:</h3>
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
                <th>Status</th>
                <!-- <th>Vewijderen</th> -->
            </tr>
            <?php foreach ($betaald as $klus): ?>
                <tr>
                    <td><?= $klus['klus'] ?></td>
                    <td><?= mb_strimwidth($klus['detailsKlus'], 0, 50, '...') ?></td>
                    <td><a href="klusBekijken.php?id=<?= urlencode($klus['klusId']) ?>&klantId=<?= urlencode($klus['klantId']) ?>">Klus bekijken</a></td>
                    <?php if ($heeftKosten): ?>
                        <td><?= !empty($klus['voorrijkosten']) ? "€ {$klus['voorrijkosten']}" : '' ?></td>
                        <td><?= !empty($klus['uurTarief']) ? "€ {$klus['uurTarief']}" : '' ?></td>
                        <td><?= !empty($klus['urenGewerkt']) ? "{$klus['urenGewerkt']} uur" : '' ?></td>
                        <td><?= !empty($klus['totaalBedrag']) ? "€ {$klus['totaalBedrag']}" : '' ?></td>
                    <?php endif; ?>
                    <td>Betaald</td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

    <?php endif; ?>

    <br>

    <form action="klusToevoegen.php" method="get">
        <input type="hidden" name="id" value="<?= $klantGegevens[0]['klantId'] ?>">
        <input type="submit" value="Klus Toevoegen">
    </form>
    <!-- <form method="post" action="updateAdres.php">
        <input type="hidden" name="klantId" value="<?= $klantGegevens[0]['klantId'] ?>">
        <input type="text" name="nieuwAdres" placeholder="Nieuw adres" required>
        <input type="submit" value="Adres bijwerken">
    </form> -->

    <form action="index.php">
        <br><input type="submit" value="Terug naar overzicht">
    </form>

    
</body>
</html>
