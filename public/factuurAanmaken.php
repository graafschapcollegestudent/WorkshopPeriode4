<?php
include_once '../src/klant.php';
$id = $_GET['id'];
$klusId = $_GET['klusId'];
$klant = new Klant();

$gekozenKlant = $klant->geefKlantOpId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['opslaan'])) {
    $klant->markeerKlusAlsGefactureerd($klusId);
    $currentDateTime = date('Y-m-d') . "<br>";
        $datum = $_POST["dateEnd"] ?? "" . "<br>";

        if ($datum < $currentDateTime)
        {
            echo "overschreden<br>";
            $overschreden = 1;
            echo $overschreden;
            $klant->betaalPeriode($overschreden);
        }
        if ($datum < $currentDateTime)
        {
            echo "Startdatum moet eerder zijn dan de einddatum.<br>";
            $overschreden = 0;
            echo $overschreden;
        }
        if ($currentDateTime < $datum)
        {
            echo "<br>Tijdperiode NIET overschreden<br>";
            $overschreden = 0;
            echo $overschreden;
            $klant->betaalPeriode($overschreden);
        }
    
    header('Location: bekijkpagina.php?id=' . $id);
    exit;
}
?>
<h2>Klantgegevens</h2>
<?php echo "Klant: " . $gekozenKlant[0]['naam']; ?>
<br>
<?php echo "Telefoonnummer: " . $gekozenKlant[0]['telefoon']; ?>
<br>
<?php echo "Email: " . $gekozenKlant[0]['email']?>
<br>
<?php echo "Adres: " . $gekozenKlant[0]['adres']?>

<h2>Kosten:</h2>

<?php echo "Voorrijkosten: € " . $gekozenKlant[0]['voorrijkosten']?>
<br>
<?php echo "Uurtarief: € " . $gekozenKlant[0]['uurTarief']?>
<br>
<?php echo "Aantal uur gewerkt: € " . $gekozenKlant[0]['urenGewerkt']?>
<br>
<?php echo "Totaalbedrag: € " . $gekozenKlant[0]['totaalBedrag']?>
<br>

<h2>Betalen voor:</h2>

    <form method="POST">
        <br><br>
        <input type="date" name="dateEnd" id=""><br><br>
    </form>
        <?php

        
?>
<form method="post" style="margin-top:10px;">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
    <input type="hidden" name="klusId" value="<?= htmlspecialchars($klusId) ?>">
    <button type="submit" name="opslaan">Opslaan</button>
</form>