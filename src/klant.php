<?php
include_once 'database.php';

class Klant extends Database
{

  public function geefAlleKlanten()
  {
    $query = "SELECT
    k.klant AS naam, 
    k.telefoonnummer AS telefoon, 
    k.adres AS adres,
    k.`e-mailadres` AS email, 
    k.klantId AS klantId
FROM klanten AS k";
    return parent::voerQueryUit($query);
  }
  public function verwerkOudAdres($id, $adres)
  {
    $query = "
  UPDATE klanten 
  SET oudeAdressen = 
    CASE 
      WHEN oudeAdressen IS NULL OR oudeAdressen = '' 
      THEN ? 
      ELSE CONCAT(oudeAdressen, ', ', ?) 
    END 
  WHERE klantId = ?;";
    $params = [$adres, $adres, $id];

    return parent::voerQueryUit($query, $params);
  }
  public function updateAdres($id, $adres)
  {
    $query = "UPDATE klanten SET adres = ? WHERE klantId = ?;";
    $params = [$adres, $id];

    return parent::voerQueryUit($query, $params);
  }
  public function geefKlantOpId($id)
  {
    $query = "SELECT 

        k.klant AS naam,
        k.adres AS adres,
        k.telefoonnummer AS telefoon,
        k.`e-mailadres` AS email,
        k.klantId AS klantId,
        k.oudeAdressen AS oud,
        d.klus AS klus,
        d.detailsKlus AS detailsKlus,
        d.KlusId AS klusId,
        d.totaalBedrag AS totaalBedrag,
        d.urenGewerkt AS urenGewerkt,
        d.uurTarief AS uurTarief,
        d.voorrijkosten AS voorrijkosten,
        d.Betaald AS Betaald,
        d.gefactureerd AS gefactureerd,
        d.vervalDatum AS vervalDatum
    FROM klanten AS k
    LEFT JOIN klusdetails AS d 
        ON d.klantId = k.klantId
    WHERE k.klantId = ?;";

    $params = [$id];

    return parent::voerQueryUit($query, $params);
  }
  public function factureerKlus($klusId, $factuurDatum, $vervalDatum)
  {
    $query = "UPDATE klusdetails SET gefactureerd = 1, factuurDatum = ?, vervalDatum = ? WHERE klusId = ?";
    $params = [$factuurDatum, $vervalDatum, $klusId];
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
        k.klantId AS klantId,
        k.oudeAdressen AS oud
        FROM klanten AS k
        WHERE k.adres LIKE ? OR k.klant LIKE ? OR k.oudeAdressen LIKE ?";
    $params = ["%{$zoekterm}%", "%{$zoekterm}%", "%{$zoekterm}%"];
    return parent::voerQueryUit($query, $params);
  }
  public function updateBetaaldStatus($klusId, $betaald)
  {
    $query = "UPDATE klusdetails SET Betaald = ? WHERE klusId = ?";
    $params = [$betaald, $klusId];
    return parent::voerQueryUit($query, $params) > 0;
  }
  public function betaalPeriode($overschreden)
  {
    $query = "UPDATE klusdetails SET overschreden = ?;";
    $params = [$overschreden];
    return parent::voerQueryUit($query, $params) > 0;
  }
  public function overschredenFactuur($klantId)
  {
    $query = "SELECT count(klusId) AS 'aantal' FROM klusdetails WHERE vervalDatum < sysdate() AND klantId = ? AND (Betaald IS NULL OR Betaald <> 1);";
    $params = [$klantId];

    $test = parent::voerQueryUit($query, $params);
    // print_r($test[0]['aantal']);
    return $test[0]['aantal'] > 0;
  }
}
