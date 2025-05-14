<?php
require_once '../src/klant.php';
require_once '../src/klus.php';

$id = $_GET['id'];
$klant = new Klant();
$klus = new Klus();
$klantGegevens = $klant->geefKlantOpId($id);

print_r($klantGegevens);

echo "<h2>{$klantGegevens[0]['naam']}</h2>";

?>
<form method="get">
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
  <input type="text" name="klusTitel" placeholder="klus"> 

  <br>
  
  <textarea name="klusBeschrijving" rows="7" cols="50" placeholder="omschrijving"></textarea>
  <br><br>
  <input type="submit" value="Klus Toevoegen" name="klusToevoegen">
</form>

<?php
if (isset($_GET['klusToevoegen'])) {
  $klusDetail = $_GET['klusBeschrijving'];
  $klantId = $klantGegevens[0]['klantId'];
  $klusTitel = $_GET['klusTitel'];
  $klus->voegKlusToe($klantId, $klusTitel, $klusDetail);

  header('Location: bekijkpagina.php?id=' . $klantId);
  exit;
}
