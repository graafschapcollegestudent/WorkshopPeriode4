
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="uren" id="uren" placeholder="Uren" required>
        <br>

        <input type="submit" value="Toevoegen" name="submit">
    </form>
</body>

</html>

<?php
include_once '../src/kosten.php';
$kosten = new Kosten();

if (isset($_POST['submit'])) {
    $uren = $_POST['uren'];
    if ($kosten->VoegUrenToe($uren)) {
        header('Location: bekijkpagina.php');
    } else {
        echo "het toevoegen is niet gelukt";
    }

  }
?>
