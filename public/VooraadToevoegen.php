<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Product Naam  </label><input type="text" name="Naam" id="naam" placeholder="Naam" required>
        <br>
        <label for="">Product Aantal  </label><input type="text" name="Aantal" id="aantal" placeholder="Aantal" required>
        <br>
        <label for="">Product Prijs </label> <input type="text" name="Prijs" id="prijs" placeholder="Prijs" required>
        <input type="submit" value="Toevoegen" name="submit">
    </form>
</body>
</html>

<?php
include_once '../src/vooraad.php';
$nieuweVooraad = new Vooraad();

if (isset($_POST['submit'])) {
    $naam = $_POST['Naam'];
    $aantal = $_POST['Aantal'];
    $prijs = $_POST['Prijs'];

    if ($nieuweVooraad->voegVooraadToe($naam, $aantal, $prijs)) {
        header('Location: Vooraad.php');
    } else {
        echo "het toevoegen is niet gelukt";
    }

  }