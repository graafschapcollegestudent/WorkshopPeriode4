<?php
include_once '../src/kosten.php';
include_once '../src/klant.php';

$kosten = new Kosten();
$klant = new Klant();

$id = $_GET['id'] ?? null;
$klusId = $_GET['klusId'] ?? null;

$klantGegevens = $klant->geefKlantOpId($id);
$klantNaam = $klantGegevens[0]['naam'] ?? '';

// Haal bestaande kosten op (voor invullen formulier)
$kostenGegevens = ($klusId) ? ($kosten->haalKostenOp($klusId)[0] ?? null) : null;

if (isset($_POST['berekenen']) && !empty($id) && !empty($klusId)) {
    $uren = (float) str_replace(',', '.', $_POST['uren'] ?? '0');
    $uurTarief = (float) str_replace(',', '.', $_POST['uurTarief'] ?? '0');
    $voorrijKosten = (float) str_replace(',', '.', $_POST['voorrijKosten'] ?? '0');

    $totaalBedrag = ($uurTarief * $uren) + $voorrijKosten;

    if ($kosten->slaKostenOp($uren, $totaalBedrag, $uurTarief, $voorrijKosten, $klusId, $klantNaam)) {
        header("Location: bekijkpagina.php?id=" . urlencode($id));
        exit;
    } else {
        echo "Het opslaan is niet gelukt.";
    }
}
?>

<form method="POST">
    <label>
        Klantnaam:
        <input type="text" name="klantNaam" value="<?= htmlspecialchars($klantNaam) ?>" readonly>
    </label><br>

    <label>
        Voorrijkosten: € 
        <input type="text" name="voorrijKosten" value="<?= htmlspecialchars(str_replace(',', '.', $kostenGegevens['voorrijKosten'] ?? '0')) ?>">
    </label><br>

    <label>
        Aantal uur gewerkt: €
        <input type="text" name="uren" value="<?= htmlspecialchars(str_replace(',', '.', $kostenGegevens['urenGewerkt'] ?? '0')) ?>">
    </label><br>

    <label>
        Uurtarief: €
        <input type="text" name="uurTarief" value="<?= htmlspecialchars(str_replace(',', '.', $kostenGegevens['uurTarief'] ?? '0')) ?>">
    </label><br>

    <button type="submit" name="berekenen">Berekenen</button>
</form>

<form action="bekijkpagina.php" method="get" style="margin-top:10px;">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
    <button type="submit">Terug naar klantgegevens</button>
</form>
