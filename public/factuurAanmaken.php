<?php
include_once '../src/klant.php';

$id = $_GET['id'];
$klusId = $_GET['klusId'];
$klant = new Klant();

$gekozenKlant = $klant->geefKlantOpId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['opslaan'])) {
    $factuurDatum = $_POST["factuurDatum"];
    $vervalDatum = $_POST["vervalDatum"];
    $klant->factureerKlus($klusId, $factuurDatum, $vervalDatum);
    
    header('Location: bekijkpagina.php?id=' . $id);
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Factuur aanmaken</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Pas het pad aan -->
</head>
<body>

<div class="toevoegen-container">
    <h2>Klantgegevens</h2>
    <p><strong>Klant:</strong> <?= $gekozenKlant[0]['naam'] ?></p>
    <p><strong>Telefoonnummer:</strong> <?= $gekozenKlant[0]['telefoon'] ?></p>
    <p><strong>Email:</strong> <?= $gekozenKlant[0]['email'] ?></p>
    <p><strong>Adres:</strong> <?= $gekozenKlant[0]['adres'] ?></p>

    <h2>Kosten</h2>
    <p><strong>Voorrijkosten:</strong> € <?= $gekozenKlant[0]['voorrijkosten'] ?></p>
    <p><strong>Uurtarief:</strong> € <?= $gekozenKlant[0]['uurTarief'] ?></p>
    <p><strong>Uren gewerkt:</strong> <?= $gekozenKlant[0]['urenGewerkt'] ?> uur</p>
    <p><strong>Totaalbedrag:</strong> € <?= $gekozenKlant[0]['totaalBedrag'] ?></p>

    <form method="post">
        <h2>Factuur</h2>
        
        <label for="factuurDatum">Factuurdatum</label>
        <input type="date" name="factuurDatum" id="factuurDatum" value="<?= date('Y-m-d') ?>" readonly>
<br>
        <label for="vervalDatum">Vervaldatum</label>
        <input type="date" name="vervalDatum" id="vervalDatum" required>

        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="klusId" value="<?= $klusId ?>">

        <input type="submit" name="opslaan" value="Opslaan">
    </form>
</div>

</body>
</html>
