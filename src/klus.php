<?php
include_once 'database.php';

class Klus extends Database
{
  public function voegKlusToe($klantId, $klusTitel, $klusDetail)
  {
    $query = "INSERT INTO klusdetails (DetailsKlus, klantId, klus) VALUES (?,?,?);";
    $params = [$klusDetail, $klantId, $klusTitel];

    return parent::voerQueryUit($query, $params) > 0;
  }
}
