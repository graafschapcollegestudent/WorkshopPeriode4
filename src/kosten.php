<?php
include_once 'database.php';

class Kosten extends Database
{
  public function slaKostenOp($uren, $totaalBedrag, $uurTarief, $voorrijKosten, $gebruikt, $totaalPrijsMateriaal, $klusId, $klantnaam)
  {
    if ($uren == "" || $totaalBedrag == "" || $klusId == "") {
      return false;
    }

    $query = "UPDATE klusdetails 
        SET 
            urenGewerkt = ?, 
            totaalBedrag = ?,
            uurTarief = ?,
            voorrijKosten = ?,
            gebruiktMateriaal = ?,
            materiaalPrijs = ?,
            klant = ?
        WHERE klusId = ?;";

    $params = [$uren, $totaalBedrag, $uurTarief, $voorrijKosten, $gebruikt, $totaalPrijsMateriaal, $klantnaam, $klusId];

    try {
      return parent::voerQueryUit($query, $params) > 0;
    } catch (Exception $e) {
      error_log("Database error: " . $e->getMessage());
      return false;
    }
  }

  public function haalKostenOp($klusId)
  {
    $query = "SELECT urenGewerkt, totaalBedrag, uurTarief, voorrijKosten, Betaald FROM klusdetails WHERE klusId = ?";
    $params = [$klusId];

    return parent::voerQueryUit($query, $params);
  }
  public function slaMateriaalGebruikOp($klusId, $productId, $aantal)
  {
    
  }
}
