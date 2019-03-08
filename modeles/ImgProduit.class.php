<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:18
 */

class ImgProduit {
    // Connexion BDD et nom de la table
    private $oConnexion;
    private $sNomTable = "imgProduit";

    public $idImgProduit;
    public $sUrlImg;
    public $iNoProduit;

    /**
     * Categorie constructor.
     * @param $oBDD
     */
    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }


    /**
     * Rechercher toutes les images
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
     * Rechercher une image
     */
    public function rechercherUn(){

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
            WHERE idImgProduit = :idImgProduit";

        // prepare query statement
        $stmt = $this->oConnexion->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(":idImgProduit", $this->idImgProduit);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->idImgProduit = $row['idImgProduit'];
        $this->sUrlImg = $row['sUrlImg'];
        $this->iNoProduit = $row['iNoProduit'];
    }

    /**
     * Rechercher toutes les images en fonction du produit
     * @return mixed
     */
    public function rechercherTousParProduit(){
        // select all query
        $sRequete = "SELECT * FROM ". $this->sNomTable ."
        WHERE iNoProduit = :iNoProduit";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        $stmt->bindParam(":iNoProduit", $this->iNoProduit);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}