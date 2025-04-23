<?php
include_once 'database.php';

class Klant extends Database {

  public function geefAlleKlanten(){
    $query = "SELECT * FROM klanten;";

    return parent::voerQueryUit($query);
  }
}