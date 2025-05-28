<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="Naam" id="naam" placeholder="Naam" required>
        <br>
        <input type="text" name="Aantal" id="aantal" placeholder="Aantal" required>
        <br>
        <input type="text" name="Maat" id="maat" placeholder="Maat" required>
        <br>
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
    $maat = $_POST['Maat'];

    if ($nieuweVooraad->voegVooraadToe($naam, $aantal, $maat)) {
        header('Location: Vooraad.php');
    } else {
        echo "het toevoegen is niet gelukt";
    }

  }