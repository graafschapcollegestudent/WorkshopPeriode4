<?php
include_once 'database.php';

class Klant extends Database
{

  public function geefAlleKlanten()
  {
    $query = "SELECT k.klant AS naam, 
    k.telefoonnummer AS telefoon, 
    k.adres AS adres, 
    k.`e-mailadres` AS email, 
    k.klantId AS klantId,
    d.DetailsKlus AS DetailsKlus,
    d.Klus AS Klus
    FROM klanten AS k
    LEFT JOIN klusdetails AS d ON d.klantId = k.klantId";


    return parent::voerQueryUit($query);
  }
  public function geefKlantOpId($id)
  {
    $query = "SELECT 
    k.klant AS naam,
    k.adres AS adres,
    k.telefoonnummer AS telefoon,
    k.`e-mailadres` AS email,
    k.klantId AS klantId,
    d.klus AS klus,
    d.detailsKlus AS detailsKlus

    FROM klanten AS k
    LEFT JOIN klusdetails AS d 
    ON d.klantId = k.klantId
    
    WHERE k.klantId = ?;";

    $params = [$id];

    return parent::voerQueryUit($query, $params)[0];
  }
  public function voegKlantToe($naam, $adres, $telefoon, $email, $opmerking)
  {
    if ($naam == "" || $adres == "" || $telefoon == "" || $email == "") {
      return false;
    } else {
      $query = "INSERT INTO klanten (klant, adres, telefoonnummer, `e-mailadres`, opmerking) VALUES (?, ?, ?, ?, ?);";
      $params = [$naam, $adres, $telefoon, $email, $opmerking];

      return parent::voerQueryUit($query, $params) > 0;
    }
  }
  public function geefKlantenOpAdres($zoekterm)
  {
    $query = "SELECT k.klant AS naam, 
        k.telefoonnummer AS telefoon, 
        k.adres AS adres, 
        k.`e-mailadres` AS email, 
        k.klantId AS klantId
        FROM klanten AS k
        WHERE k.adres LIKE ? OR k.klant LIKE ?;";
    $params = ["%{$zoekterm}%", "%{$zoekterm}%"];
    return parent::voerQueryUit($query, $params);
  }
}
