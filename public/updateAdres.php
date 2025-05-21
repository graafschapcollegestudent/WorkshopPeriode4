<?php
require_once '../src/klant.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $klantid=$_POST['klantId'];
    $nieuweAdres=$_POST['nieuwAdres'];

    $klant=new Klant();
    $klant->deactiveerHuidigeAdres($klantid);
    $klant->voegAdresToe($klantid, $nieuweAdres);
    header('Location: bekijkpagina.php?id='. urlencode($klantid));
    exit;
}