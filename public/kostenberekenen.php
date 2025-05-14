
<form method="POST">
    Voorrijkosten: <input type="text" name="voorrijKosten" id=""><br>
    Aantal uur gewerkt: <input type="text" name="uren" id=""><br>
    Uurtarief: <input type="text" name="uurTarief" id=""><br>
</form>

<?php

include_once '../src/kosten.php';
$kosten = new Kosten();
if (isset($_POST['berekenen'])) {
    $uren = $_POST['uren'];
    $uurTarief = $_POST["uurTarief"];
    $voorrijKosten = $_POST["voorrijKosten"];
    $GewerkteUren = $uurTarief * $uren;
    $totaalBedrag = $GewerkteUren + $voorrijKosten;
    $klantId = $_GET['id'];

    if ($kosten->VoegUrenToe($uren, $totaalBedrag, $klantId)) {
        header("Location: bekijkpagina.php?id=" . $klantId);
        exit;
    } else {
        echo "Het toevoegen is niet gelukt";
    }
}
?>
