
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

    $totaal = (int)$uren * (int)$uurTarief;
    echo "<br> $totaal";
}


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
