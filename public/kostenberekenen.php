
<form method="POST">
    Voorrijkosten: <input type="text" name="voorrijKosten" id=""><br>
    Aantal uur gewerkt: <input type="text" name="uren" id=""><br>
    Uurtarief: <input type="text" name="uurTarief" id=""><br>
    <input type="submit" value="berekenen" name="berekenen">
</form>

<?php
if (isset($_POST["berekenen"]))
{
    $voorrijKosten = $_POST["voorrijKosten"];
    $uren = $_POST["uren"];
    $uurTarief = $_POST["uurTarief"];
    echo $voorrijKosten;
    echo $uren;
    echo $uurTarief;
}


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
