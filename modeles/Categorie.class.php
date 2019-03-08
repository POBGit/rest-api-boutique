<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-01-27
 * Time: 15:52
 */

class Categorie {

    // Connexion BDD et nom de la table
    private $oConnexion;
    private $sNomTable = "categorie";

    public $idCategorie;
    public $sNomCategorie;
    public $sUrlImg;
    public $sUrlCategorie;

    /**
     * Categorie constructor.
     * @param $oBDD
     */
    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }


    /**
     * Rechercher toutes les categories
     * @return mixed
     */
    public function rechercherTous(){
        // select all query
        $sRequete = "SELECT * FROM ". $this->sNomTable;

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    /**
     * Rechercher une categorie
     */
    public function rechercherUn(){

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
            WHERE sUrlCategorie = :sUrlCategorie";

        // prepare query statement
        $stmt = $this->oConnexion->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(":sUrlCategorie", $this->sUrlCategorie);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->idCategorie = $row['idCategorie'];
        $this->sNomCategorie = $row['sNomCategorie'];
        $this->sUrlImg = $row['sUrlImg'];
        $this->sUrlCategorie = $row['sUrlCategorie'];
    }
}
