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
        <input type="submit" value="Toevoegen" name="submit">
    </form>
</body>
</html>

<?php
require_once '../config.php';
$naam=$_POST['voornaam'];
$achternaam=$_POST['achternaam'];
$email=$_POST['email'];
$telefoon=$_POST['telefoon'];   
$adres=$_POST['adres'];
$submit=$_POST['submit'];