<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="voornaam" id="voornaam" placeholder="Voornaam" required>
        <br>
        <input type="text" name="achternaam" id="achternaam" placeholder="Achternaam" required>
        <br>
        <input type="text" name="email" id="email" placeholder="Email" required>
        <br>
        <input type="text" name="telefoon" id="telefoon" placeholder="Telefoon" required>
        <br>
        <input type="text" name="adres" id="adres" placeholder="Adres" required>
        <br>
        <input type="text" name="opmerking" id="opmerking" placeholder="Opmerking">
        <br>
        <input type="submit" value="Toevoegen" name="submit">
    </form>
</body>
</html>

<?php
include_once '../src/kosten.php';
include_once '../src/klant.php';
$nieuweKlant = new Klant();

if (isset($_POST['submit'])) {
    $naam = "{$_POST['voornaam']} {$_POST['achternaam']}";
    $adres = $_POST['adres'];
    $telefoon = $_POST['telefoon'];
    $email = $_POST['email'];
    $opmerking = $_POST['opmerking'];

    if ($nieuweKlant->voegKlantToe($naam, $adres, $telefoon, $email, $opmerking)) {
        header('Location: index.php');
    } else {
        echo "het toevoegen is niet gelukt";
    }

  }
  