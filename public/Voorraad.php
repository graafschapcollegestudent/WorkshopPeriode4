<?php
require_once('../src/vooraad.php');

$vooraad = new Vooraad();
$foutmelding = "";

// Eerst POST verwerken
if (isset($_POST['erbij']) || isset($_POST['eraf'])) {
    $aantal = $_POST['aantalToevoegen'];
    $voorraadId = $_POST['voorraadId'];

    if ($aantal === "" || !is_numeric($aantal)) {
        $foutmelding = "Je hebt niks ingevuld!";
    } else if ($aantal < 0) {
        $foutmelding = "Ingevoerd aantal kan niet lager zijn dan 0";
    } else {
        $aantal = (int)$aantal;

        if (isset($_POST['erbij'])) {
            $vooraad->aantalAanpassen($voorraadId, $aantal);
        }
        if (isset($_POST['eraf'])) {
            $vooraad->aantalAanpassen($voorraadId, -$aantal);
        }

        // Redirect naar dezelfde pagina om dubbele submit te voorkomen en data te verversen
        header("Location: voorraad.php");
        exit;
    }
}

// Daarna pas de data ophalen
$vooraadGegevens = $vooraad->geefAlleVooraden();
?>

<h1>Voorraad</h1>

<?php if ($foutmelding): ?>
    <div><?= htmlspecialchars($foutmelding) ?></div>
<?php endif; ?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Naam</th>
        <th>Aantal</th>
        <th>Toevoegen</th>
        <th>Prijs</th>
    </tr>
    <?php foreach ($vooraadGegevens as $vooraaden): ?>
        <tr>
            <td><?= htmlspecialchars($vooraaden['naam']) ?></td>
            <td><?= htmlspecialchars($vooraaden['aantal']) ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="voorraadId" value="<?= htmlspecialchars($vooraaden['voorraadId']) ?>">
                    <input type="number" name="aantalToevoegen" style="width: 100px;">
                    <input type="submit" value="+" name="erbij">
                    <input type="submit" value="-" name="eraf">
                </form>
            </td>
            <td><?php echo "€ " . $vooraaden['prijs'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<form action="VooraadToevoegen.php">
    <input type="submit" value="Nieuw materiaal toevoegen">
</form>
<form action="index.php">
    <input type="submit" value="Terug">
</form>
