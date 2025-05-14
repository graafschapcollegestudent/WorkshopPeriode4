<?php
include_once 'database.php';

class Kosten extends Database {

  public function VoegUrenToe($uren){
    if ($uren == "") {
      return false;
    } else {
      $query = "INSERT INTO klusdetails (urenGewerkt) VALUES (?);";
      $params = [$uren];

      return parent::voerQueryUit($query, $params) > 0;
    }
  }
}