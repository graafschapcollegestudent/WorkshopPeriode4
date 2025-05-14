<?php
include_once 'database.php';

class Klant extends Database {

  public function geefAlleKlanten(){
<<<<<<< HEAD
    $query = "SELECT * FROM klanten AS k
    INNER JOIN klusdetails AS d ON d.KlusId = k.klantId";
=======
    $query = "SELECT k.klant AS naam, 
    k.telefoonnummer AS telefoon, 
    k.adres AS adres, 
    k.`e-mailadres` AS email, 
    k.klantId AS klantId,
    d.DetailsKlus AS DetailsKlus,
    d.Klus AS Klus
    FROM klanten AS k
    LEFT JOIN klusdetails AS d ON d.klantId = k.klantId";
>>>>>>> ad2c94d0c97dd621578b17cdc68efa0fd55aa799


    return parent::voerQueryUit($query);
  }
  public function voegKlantToe($naam, $adres, $telefoon, $email, $opmerking){
    if ($naam == "" || $adres == "" || $telefoon == "" || $email == "") {
      return false;
    } else {
      $query = "INSERT INTO klanten (klant, adres, telefoonnummer, `e-mailadres`, opmerking) VALUES (?, ?, ?, ?, ?);";
      $params = [$naam, $adres, $telefoon, $email, $opmerking];

      return parent::voerQueryUit($query, $params) > 0;
    }
  }
  public function geefKlantenOpAdres($zoekterm){
    $query = "SELECT * FROM klanten WHERE adres like ? OR klant like ?;";
    $params = ["%{$zoekterm}%", "%{$zoekterm}%"];
    return parent::voerQueryUit($query, $params);
  }
}