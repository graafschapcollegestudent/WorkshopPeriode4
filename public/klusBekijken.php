<?php
require_once '../src/klus.php';

$klus = new Klus();
$klusgegevens = null;
$klantId = $_GET['klantId'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $klusTitel = $_POST['klusTitel'];
  $klusDetails = $_POST['klusDetails'];
  $klantId = $_POST['klantId'];

  $result = $klus->updateKlus($id, $klusTitel, $klusDetails);

  header("Location: bekijkpagina.php?id=" . urlencode($klantId));
  exit;
} elseif (isset($_GET['id'])) {
  $id = $_GET['id'];
  $klusgegevens = $klus->geefKlusOpId($id);

  if (!$klusgegevens) {
    echo "<p>Klus met ID $id niet gevonden.</p>";
    exit;
  }
} else {
  echo "<p>Geen klus ID opgegeven.</p>";
  exit;
}
?>

<form method="post" action="klusBekijken.php">
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
  <input type="hidden" name="klantId" value="<?php echo htmlspecialchars($klantId); ?>">

  <h2>Klus:</h2>
  <input type="text" name="klusTitel" value="<?php echo htmlspecialchars($klusgegevens['klusTitel']); ?>"><br>

  <h3>Klus omschrijving:</h3>
  <textarea name="klusDetails" rows="5" cols="50"><?php echo htmlspecialchars($klusgegevens['klusDetails']); ?></textarea><br>

  <input type="submit" value="Opslaan" name="opslaan">
</form>