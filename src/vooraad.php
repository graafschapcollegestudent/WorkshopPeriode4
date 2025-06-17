<?php
include_once 'database.php';

class Vooraad extends Database
{
    public function geefAlleVooraden()
    {
        $query = "SELECT
        v.VooraadId AS voorraadId,
        v.Naam AS naam, 
        v.Aantal AS aantal,
        v.Prijs AS prijs
    FROM vooraad AS v";
        return parent::voerQueryUit($query);
    }

    public function aantalAanpassen($id, $nieuwAantal)
    {
        $query = "UPDATE vooraad SET Aantal = aantal + ? WHERE VooraadId = ?;";
        $params = [$nieuwAantal, $id];
        return parent::voerQueryUit($query, $params) > 0;
        }

        public function voegVooraadToe($naam, $aantal, $prijs)
        {
        // Controleer of het materiaal al bestaat
        $query = "SELECT VooraadId, Aantal, Prijs FROM vooraad WHERE Naam = ?;";
        $result = parent::voerQueryUit($query, [$naam]);

        if (!empty($result)) {
            // Materiaal bestaat al, update het aantal en prijs indien nodig
            $vooraadId = $result[0]['VooraadId'];
            $queryUpdate = "UPDATE vooraad SET Aantal = Aantal + ?, Prijs = ? WHERE VooraadId = ?;";
            $paramsUpdate = [$aantal, $prijs, $vooraadId];
            return parent::voerQueryUit($queryUpdate, $paramsUpdate) > 0;
        } else {
            // Materiaal bestaat nog niet, voeg nieuw toe
            $queryInsert = "INSERT INTO vooraad (Naam, Aantal, Prijs) VALUES (?,?,?);";
            $paramsInsert = [$naam, $aantal, $prijs];
            return parent::voerQueryUit($queryInsert, $paramsInsert) > 0;
        }
        }
        public function verwerkProduct($productId, $aantal){
            $vooraad = new Vooraad();
            $alleProducten = $vooraad->geefAlleVooraden();

            foreach ($alleProducten as $product) {
                if ($product['voorraadId'] == $productId);
                $query = "UPDATE vooraad SET Aantal = Aantal - ? WHERE VooraadId = ? ;";
                $params = [$aantal, $productId];
                return parent::voerQueryUit($query, $params);
            }
        }
}
