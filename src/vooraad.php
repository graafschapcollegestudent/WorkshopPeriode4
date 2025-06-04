<?php
include_once 'database.php';

class Vooraad extends Database
{
    public function geefAlleVooraden()
    {
        $query = "SELECT
        v.Naam AS naam, 
        v.Aantal AS aantal, 
        v.Maat AS maat
    FROM vooraad AS v";
        return parent::voerQueryUit($query);
    }

    // public function slaVooraadOp($Naam, $Vooraad, $Maat)
    // {
    //     if ($Naam === "" || $Vooraad === "" || $Maat === "") {
    //         return false;
    //     }

    //     $query = "UPDATE klusdetails 
    //         SET 
    //             urenGewerkt = ?, 
    //             totaalBedrag = ?,
    //             uurTarief = ?,
    //             voorrijKosten = ?,
    //             klant = ?,
    //             Betaald = ?
    //         WHERE klusId = ?;";

    //     $params = [$Naam, $Vooraad, $Maat];

    //     try {
    //         $result = parent::voerQueryUit($query, $params);
    //         return $result > 0;
    //     } catch (Exception $e) {
    //         error_log("Database error: " . $e->getMessage());
    //         return false;
    //     }
    // }

    public function voegVooraadToe($naam, $aantal, $maat)
    {
        $query = "INSERT INTO vooraad (Naam, Aantal, Maat) VALUES (?,?,?);";
        $params = [$naam, $aantal, $maat];

        return parent::voerQueryUit($query, $params) > 0;
    }
}
