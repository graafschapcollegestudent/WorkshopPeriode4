<?php
include_once 'database.php';

class Klus extends Database
{
  public function voegKlusToe($klantId, $klusTitel, $klusDetail, $factuur)
  {
    $query = "INSERT INTO klusdetails (DetailsKlus, klantId, klus, Betaald) VALUES (?,?,?,?);";
    $params = [$klusDetail, $klantId, $klusTitel, $factuur];

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
  public function updateKlus($klusId, $klusTitel, $klusDetail, $factuur)
  {
    $query = "UPDATE klusdetails SET klus = ?, DetailsKlus = ?, Betaald = ? WHERE KlusId = ?";
    $params = [$klusTitel, $klusDetail, $factuur, $klusId];

    return parent::voerQueryUit($query, $params) > 0;
  }
}
