<?php
require_once '../src/klant.php';

$id = $_GET['id'];
$klant = new Klant();
$geselecteerd = $klant->geefKlantOpId($id);

if (isset($_POST['opslaan'])) {
    if ($_POST['nieuwAdres'] == "") {
        echo "Je moet wel het nieuwe adres invullen";
    } else {
        $oudeAdressen = $geselecteerd[0]['adres'];

        $klant->verwerkOudAdres($id, $oudeAdressen);

        $nieuwAdres = $_POST['nieuwAdres'];
        $klant->updateAdres($id, $nieuwAdres);

        header('Location: index.php');
    }
}



echo "<h1>{$geselecteerd[0]['naam']}</h1>";

echo "Oud adres: {$geselecteerd[0]['adres']}";

echo "<br><br>";
?>
<form method="post">
    Nieuw adres: <input type="text" name="nieuwAdres" id="nieuwAdres">
    <br><br>
    <input type="submit" value="Adres opslaan" name="opslaan">
</form>

