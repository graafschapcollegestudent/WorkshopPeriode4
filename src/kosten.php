<?php
include_once 'database.php';

class Kosten extends Database
{

  public function VoegUrenToe($uren, $totaalBedrag, $klantId)
  {
    if ($uren == "" || $totaalBedrag == "" || $klantId == "") {
      return false;
    } else {
      $query = "INSERT INTO klusdetails (urenGewerkt, totaalBedrag, klantId) VALUES (?, ?, ?);";
      $params = [$uren, $totaalBedrag, $klantId];

      return parent::voerQueryUit($query, $params) > 0;
    }
  }
}
