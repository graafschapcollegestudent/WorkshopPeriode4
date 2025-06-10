<?php
include_once '../src/kosten.php';
include_once '../src/klant.php';
include_once '../src/vooraad.php';

$kosten = new Kosten();
$klant = new Klant();
$voorraad = new Vooraad();

$id = $_GET['id'] ?? null;
$klusId = $_GET['klusId'] ?? null;

$klantGegevens = $klant->geefKlantOpId($id);
$klantNaam = $klantGegevens[0]['naam'] ?? '';

// Haal bestaande kosten op (voor invullen formulier)
$kostenGegevens = ($klusId) ? ($kosten->haalKostenOp($klusId)[0] ?? null) : null;
$alleVoorraad = $voorraad->geefAlleVooraden();
$materiaalKosten = $_POST['aantalGebruikt'] ?? [];

if (isset($_POST['berekenen']) && !empty($id) && !empty($klusId)) {
    $uren = (float) str_replace(',', '.', $_POST['uren'] ?? '0');
    $uurTarief = (float) str_replace(',', '.', $_POST['uurTarief'] ?? '0');
    $voorrijKosten = (float) str_replace(',', '.', $_POST['voorrijKosten'] ?? '0');

    $materiaalTotaal = 0.0;
    $materiaal = [];
    $gebruikteProducten = [];

    foreach ($materiaalKosten as $productId => $aantalGebruikt) {
        $productId = (int) $productId;
        $aantalGebruikt = (int) $aantalGebruikt;

        if ($aantalGebruikt > 0) {
            foreach ($alleVoorraad as $product) {
                if ((int)$product['voorraadId'] === $productId) {
                    $prijsPerStuk = (float) $product['prijs'];
                    $materiaalPrijs = $prijsPerStuk * $aantalGebruikt;
                    $materiaalTotaal += $materiaalPrijs;

                    $kosten->slaMateriaalGebruikOp($klusId, $productId, $aantalGebruikt);
                    $voorraad->verwerkProduct($productId, $aantalGebruikt);
                    $gebruikteProducten[] = "{$product['naam']} x{$aantalGebruikt}";
                }
            }
        }
    }
    
    $productSamenvatting = implode(', ', $gebruikteProducten);
    $arbeidsKosten = $uren * $uurTarief;
    $totaalBedrag = $arbeidsKosten + $voorrijKosten + $materiaalTotaal;

    if ($kosten->slaKostenOp($uren, $totaalBedrag, $uurTarief, $voorrijKosten, $productSamenvatting, $materiaalTotaal, $klusId, $klantNaam)) {
        header("Location: bekijkpagina.php?id=" . urlencode($id));
        exit;
    } else {
        echo "<p style='color:red;'>Het opslaan is niet gelukt.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kosten invoeren</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <div class="toevoegen-container">
    <h2>Kosten invoeren voor <?= htmlspecialchars($klantNaam) ?></h2>

    <form method="POST">
        <label>
            Klantnaam:
            <input type="text" name="klantNaam" value="<?= htmlspecialchars($klantNaam) ?>" readonly>
        </label>

        <label>
            Voorrijkosten: €
            <input type="text" name="voorrijKosten" value="<?= htmlspecialchars(str_replace(',', '.', $kostenGegevens['voorrijKosten'] ?? '0')) ?>">
        </label>

        <label>
            Aantal uur gewerkt:
            <input type="text" name="uren" value="<?= htmlspecialchars(str_replace(',', '.', $kostenGegevens['urenGewerkt'] ?? '0')) ?>">
        </label>

        <label>
            Uurtarief: €
            <input type="text" name="uurTarief" value="<?= htmlspecialchars(str_replace(',', '.', $kostenGegevens['uurTarief'] ?? '0')) ?>">
        </label>

            <?php foreach ($alleVoorraad as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['naam']) ?></td>
                    <td>
                        <input class="aantalGebruikt" type="number" name="aantalGebruikt[<?= $product['voorraadId'] ?>]" value="0" style="width: 100%;">
                    </td>
                </tr>
            <?php endforeach; ?>


        <input type="submit" name="berekenen" value="Berekenen">
    </form>

    <form action="bekijkpagina.php" method="get" style="margin-top: 10px;">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <input type="submit" value="Terug naar klantgegevens" class="klantToevoegen">
    </form>
  </div>
</body>
</html>
