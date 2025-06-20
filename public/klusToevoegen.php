<link rel="stylesheet" href="../css/style.css">
<?php
require_once '../src/klant.php';
require_once '../src/klus.php';

$id = $_GET['id'];
$klant = new Klant();
$klus = new Klus();
$klantGegevens = $klant->geefKlantOpId($id);

echo "<h2>{$klantGegevens[0]['naam']}</h2>";

?>
<form method="get">
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
  <input type="text" name="klusTitel" placeholder="klus"> 

  <br>
  
  <textarea name="klusBeschrijving" rows="7" cols="50" placeholder="omschrijving"></textarea>
  <br><br>
  <input type="submit" value="Klus Toevoegen" name="klusToevoegen">
  <input type="submit" value="Terug" name="terug">
</form>

<?php
if (isset($_GET['klusToevoegen'])) {
  $naam = $klantGegevens[0]['naam'];
  $klusDetail = $_GET['klusBeschrijving'];
  $klantId = $klantGegevens[0]['klantId'];
  $klusTitel = $_GET['klusTitel'];
  $klus->voegKlusToe($naam, $klantId, $klusTitel, $klusDetail, $adresId);

  header('Location: bekijkpagina.php?id=' . $klantId);
  exit;
}
if (isset($_GET['terug'])) {
  header('Location: bekijkpagina.php?id=' . $klantGegevens[0]['klantId']);
}
