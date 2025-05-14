<?php
require_once('../src/klant.php');
$id = $_GET['id'];

$klant = new Klant();

$klantGegevens = $klant->geefKlantOpId($id);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Details van de klant</title>
</head> 
<body>
    <h2>Details van de klant:</h2>
    <table border='1' cellpadding='5' cellspacing='0'>
        <tr>
            <th>Klant</th>
            <th>Adres</th>
            <th>Telefoonnummer</th>
            <th>E-mailadres</th>
            <th>KlantId</th>
            <th>Klus</th>
            <th>DetailsKlus</th>
        </tr>
        <tr>
            <td><?php echo $klantGegevens['naam']; ?></td>
            <td><?php echo $klantGegevens['adres']; ?></td>
            <td><?php echo $klantGegevens['telefoon']; ?></td>
            <td><?php echo $klantGegevens['email']; ?></td>
            <td><?php echo $klantGegevens['klantId']; ?></td>
            <td><?php echo $klantGegevens['klus']; ?></td>
            <td><?php echo $klantGegevens['detailsKlus']; ?></td>
        </tr>
    </table>

    <br>
    
    <form action="index.php">
        <input type="submit" value="Terug naar overzicht">
    </form>
</body>
</html>

<a href="kostenberekenen.php?id=<?= $klantGegevens['klantId']?>">kostenberekenen</a>

