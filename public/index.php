<?php
include_once '../src/klant.php';
$klant = new Klant();

$alleKlanten = $klant->geefAlleKlanten();

echo "<pre>";
print_r($alleKlanten);

?>
<form action="toevoegen.php">Toevoegen</form>