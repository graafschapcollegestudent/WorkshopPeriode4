<?php
include_once 'database.php';

class Klus extends Database
{
  public function voegKlusToe($klantId, $klusTitel, $klusDetail, $adresId)
  {
    $query = "INSERT INTO klusdetails (DetailsKlus, klantId, klus, adresId) VALUES (?,?,?,?);";
    $params = [$klusDetail, $klantId, $klusTitel, $adresId];

    return parent::voerQueryUit($query, $params) > 0;
  }
  public function geefKlusOpId($klusId)
  {
    $query = "SELECT 
        d.klus AS klusTitel, 
        d.DetailsKlus AS klusDetails,
        d.Betaald
        FROM klusdetails AS d
        WHERE d.KlusId = ?";
    $params = [$klusId];

    $result = parent::voerQueryUit($query, $params);

    return $result && count($result) > 0 ? $result[0] : null;
  }
  public function updateKlus($klusId, $klusTitel, $klusDetail)
{
    $query = "UPDATE klusdetails SET klus = ?, DetailsKlus = ? WHERE KlusId = ?";
    $params = [$klusTitel, $klusDetail, $klusId];

    return parent::voerQueryUit($query, $params) > 0;
}
  private function haalActiefAdresId($klantId){
    $query="SELECT adresId FROM klant_adressen WHERE klantId=? AND actief=1 LIMIT 1";
    return parent::voerQueryUit($query, [$klantId])[0]['adresId'] ?? null;
  }
}
