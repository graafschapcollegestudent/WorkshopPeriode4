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
$materiaalKosten = $_POST['materiaal'] ?? [];

if (isset($_POST['berekenen']) && !empty($id) && !empty($klusId)) {
    $uren = (float) str_replace(',', '.', $_POST['uren'] ?? '0');
    $uurTarief = (float) str_replace(',', '.', $_POST['uurTarief'] ?? '0');
    $voorrijKosten = (float) str_replace(',', '.', $_POST['voorrijKosten'] ?? '0');

    $materiaalTotaal = 0.0;
    $gebruikteProducten = [];

    foreach ($materiaalKosten as $entry) {
        $productId = (int) ($entry['id'] ?? 0);
        $aantalGebruikt = (int) ($entry['aantal'] ?? 0);

        if ($productId > 0 && $aantalGebruikt > 0) {
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

        <div class="materiaal-container">
            <h3>Materiaalgebruik</h3>
            <div id="materiaalBlokken">
                <div class="materiaal-blok">
                    <select name="materiaal[0][id]">
                        <option value="">-- Kies een product --</option>
                        <?php foreach ($alleVoorraad as $product): ?>
                            <option value="<?= $product['voorraadId'] ?>">
                                <?= htmlspecialchars($product['naam']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="materiaal[0][aantal]" min="0" placeholder="Aantal gebruikt">
                    <button type="button" onclick="verwijderBlok(this)">X</button>
                </div>
            </div>
            <button type="button" id="voegMateriaalToe">+ Materiaal toevoegen</button>
        </div>

        <input type="submit" name="berekenen" value="Berekenen">
    </form>

    <form action="bekijkpagina.php" method="get" style="margin-top: 10px;">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <input type="submit" value="Terug naar klantgegevens" class="klantToevoegen">
    </form>
</div>

<script>
let materiaalTeller = 1;

document.getElementById('voegMateriaalToe').addEventListener('click', () => {
    const blok = document.createElement('div');
    blok.className = 'materiaal-blok';
    blok.innerHTML = `
        <select name="materiaal[${materiaalTeller}][id]">
            <option value="">-- Kies een product --</option>
            <?php foreach ($alleVoorraad as $product): ?>
                <option value="<?= $product['voorraadId'] ?>"><?= htmlspecialchars($product['naam']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="materiaal[${materiaalTeller}][aantal]" min="0" placeholder="Aantal gebruikt">
        <button type="button" onclick="verwijderBlok(this)">X</button>
    `;
    document.getElementById('materiaalBlokken').appendChild(blok);
    materiaalTeller++;
});

function verwijderBlok(btn) {
    btn.parentElement.remove();
}
</script>
</body>
</html>
