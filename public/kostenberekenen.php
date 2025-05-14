
<form method="POST">
    Voorrijkosten: <input type="text" name="voorrijKosten" id=""><br>
    Aantal uur gewerkt: <input type="text" name="uren" id=""><br>
    Uurtarief: <input type="text" name="uurTarief" id=""><br>
</form>

<?php

include_once '../src/kosten.php';
$kosten = new Kosten();

if (isset($_POST['submit'])) {
    $uren = $_POST['uren'];
    $uurTarief = $_POST['uurTarief'];
    if ($kosten->VoegUrenToe($uren, $uurTarief)) {
        header('Location: bekijkpagina.php');
    } else {
        echo "het toevoegen is niet gelukt";
    }

  }
?>
