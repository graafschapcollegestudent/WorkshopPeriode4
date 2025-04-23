<?php
include_once 'database.php';

class Klant extends Database {

  public function geefAlleKlanten(){
    $query = "SELECT * FROM klanten;";

    return parent::voerQueryUit($query);
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