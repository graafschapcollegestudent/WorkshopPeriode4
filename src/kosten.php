<?php
include_once 'database.php';

class Kosten extends Database {

  public function VoegUrenToe($uren, $uurTarief){
    if ($uren == "" || $uurTarief == "") {
      return false;
    } else {
      $query = "INSERT INTO klusdetails (urenGewerkt, totaalBedrag) VALUES (?, ?);";
      $params = [$uren, $uurTarief];

      return parent::voerQueryUit($query, $params) > 0;
    }
  }
}