<?php
require_once '../src/klant.php';

$id = $_GET['id'];
$klant = new Klant();
$geselecteerd = $klant->geefKlantOpId($id);

$foutmelding = "";

if (isset($_POST['opslaan'])) {
    if (empty($_POST['nieuwAdres'])) {
        $foutmelding = "Je moet wel het nieuwe adres invullen.";
    } else {
        $oudeAdressen = $geselecteerd[0]['adres'];
        $klant->verwerkOudAdres($id, $oudeAdressen);

        $nieuwAdres = $_POST['nieuwAdres'];
        $klant->updateAdres($id, $nieuwAdres);

        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Adres Wijzigen</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Pas dit pad aan -->
</head>
<body>

<div class="toevoegen-container">
    <h2><?= htmlspecialchars($geselecteerd[0]['naam']) ?></h2>
    <p><strong>Oud adres:</strong> <?= htmlspecialchars($geselecteerd[0]['adres']) ?></p>

    <?php if (!empty($foutmelding)): ?>
        <div class="error"><?= $foutmelding ?></div>
    <?php endif; ?>

    <form method="post">
        <label for="nieuwAdres">Nieuw adres</label>
        <input type="text" name="nieuwAdres" id="nieuwAdres" class="tekstvak" required>

        <input type="submit" value="Adres opslaan" name="opslaan">
    </form>
</div>

</body>
</html>
