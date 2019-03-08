<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:18
 */

class Panier {

    // Connexion BDD et nom de la table
    private $oConnexion;
    private $sNomTable = "panier";

    public $idPanier;
    public $sNumPanier;
    public $sDateModification;

    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les Paniers dans la BDD
     * @return mixed
     */
    public function rechercherTous() {
        // select all query
        $sRequete = "SELECT * FROM " . $this->sNomTable;

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    /**
     * Rechercher un Panier dans la BDD
     * @return mixed
     */
    public function rechercherUn() {

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
            WHERE idPanier = :idPanier";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(":idPanier", $this->idPanier);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->idPanier = $row['idPanier'];
        $this->sNumPanier = $row['sNumPanier'];
        $this->sDateModification = $row['sDateModification'];
    }

    /**
     * Ajouter un Panier dans la BDD
     * @return bool
     */
    public function ajouter() {

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET sNumPanier = :sNumPanier,
                sDateModification = :sDateModification";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":sNumPanier", $this->sNumPanier);
        $stmt->bindParam(":sDateModification", $this->sDateModification);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Modifier un Panier dans la BDD
     * @return bool
     */
    public function modifier() {

        var_dump($this);

        $sRequete = "UPDATE " . $this->sNomTable . "
            SET
                sDateModification = :sDateModification
            WHERE
                idPanier = :idPanier";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":sDateModification", $this->sDateModification);
        $stmt->bindParam(":idPanier", $this->idPanier);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Supprimer un Panier dans la BDD
     * @return bool
     */
    public function supprimer() {
        // delete query
        $query = "DELETE FROM " . $this->sNomTable . " WHERE idPanier = :idPanier";

        // prepare query
        $stmt = $this->oConnexion->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(":idPanier", $this->idPanier);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
