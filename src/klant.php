<?php
include_once 'database.php';

class Klant extends Database
{

  public function geefAlleKlanten()
{
    $query = "SELECT
    k.klant AS naam, 
    k.telefoonnummer AS telefoon, 
    -- Straks a.adres ipv k.adres
    k.adres AS adres,
    k.`e-mailadres` AS email, 
    k.klantId AS klantId
FROM klanten AS k
-- LEFT JOIN klant_adressen AS a ON k.klantId = a.klantId
-- AND a.actief = 1";
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
        d.detailsKlus AS detailsKlus,
        d.KlusId AS klusId,
        d.totaalBedrag AS totaalBedrag,
        d.urenGewerkt AS urenGewerkt,
        d.uurTarief AS uurTarief,
        d.voorrijkosten AS voorrijkosten,
        d.gebruiktMateriaal AS materiaal,
        d.materiaalPrijs AS materiaalPrijs,
        d.Betaald AS Betaald,
        d.gefactureerd AS gefactureerd
    FROM klanten AS k
    LEFT JOIN klusdetails AS d 
        ON d.klantId = k.klantId
    WHERE k.klantId = ?;";
    
    $params = [$id];

    return parent::voerQueryUit($query, $params);
  }
  public function markeerKlusAlsGefactureerd($klusId) {
    $query = "UPDATE klusdetails SET gefactureerd = 1 WHERE klusId = ?";
    $params = [$klusId];
    return parent::voerQueryUit($query, $params) > 0;
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
  public function geefKlantenOpAdresOfNaam($zoekterm)
  {
    $query = "SELECT k.klant AS naam, 
        k.telefoonnummer AS telefoon, 
        k.adres AS adres, 
        k.`e-mailadres` AS email, 
        k.klantId AS klantId
        FROM klanten AS k
        LEFT JOIN klant_adressen AS a ON k.klantId = a.klantId
        WHERE (a.adres LIKE ? AND a.actief = 1) OR k.klant LIKE ?";
    $params = ["%{$zoekterm}%", "%{$zoekterm}%"];
    return parent::voerQueryUit($query, $params);
  }
  public function voegAdresToe($klantid, $adres){
    $query = "INSERT INTO klant_adressen (adres, klantId, actief) VALUES (?, ?, 1);";
    return parent::voerQueryUit($query, [$adres, $klantid]);
  }
  public function deactiveerHuidigeAdres($klantid){
    $query = "UPDATE klant_adressen SET actief = 0 WHERE klantId = ? ";
    return parent::voerQueryUit($query, [$klantid]);
  }
  public function geefActiefAdres($klantid){
    $query="SELECT adres FROM klant_adressen WHERE klantId=? AND actief = 1 LIMIT 1";
    return parent::voerQueryUit($query, [$klantid])[0]['adres'] ?? '';
  }
  public function geefAdressenVanKlant($klantid){
    $query="SELECT adres, actief, datumToegevoegd FROM klant_adressen WHERE klantId=?";
    return parent::voerQueryUit($query, [$klantid]);
  }
  public function updateBetaaldStatus($klusId, $betaald) {
    $query = "UPDATE klusdetails SET Betaald = ? WHERE klusId = ?";
    $params = [$betaald, $klusId];
    return parent::voerQueryUit($query, $params) > 0;
}
}
