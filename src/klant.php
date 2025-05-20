<?php
include_once 'database.php';

class Klant extends Database {

  public function geefAlleKlanten($id) {
    $query = "
      SELECT 
        k.klant, 
        k.adres, 
        k.telefoonnummer, 
        k.`e-mailadres`, 
        k.klantId,
        kd.Klus AS Klus,
        kd.DetailsKlus AS DetailsKlus
      FROM klanten k
      LEFT JOIN klusdetails kd ON k.klantId = kd.klantId
      WHERE k.klantId = ?
    ";
    
    $params = [$id];
    return parent::voerQueryUit($query, $params);
  }
  

  public function voegKlantToe($naam, $adres, $telefoon, $email){
    if ($naam == "" || $adres == "" || $telefoon == "" || $email == "") {
      return false;
    } else {
      $query = "INSERT INTO klanten (klant, adres, telefoonnummer, `e-mailadres`) VALUES (?, ?, ?, ?);";
      $params = [$naam, $adres, $telefoon, $email];

      return parent::voerQueryUit($query, $params) > 0;
    }
  }

  public function geefKlantenOpAdres($zoekterm){
    $query = "SELECT * FROM klanten WHERE adres like ? OR klant like ?;";
    $params = ["%{$zoekterm}%", "%{$zoekterm}%"];
    return parent::voerQueryUit($query, $params);
  }
}
