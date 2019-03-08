<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:17
 */

class Adresse {

    // Connexion BDD et nom de la table
    private $oConnexion;
    private $sNomTable = "adresse";

    public $idAdresse;
    public $sRue;
    public $sVille;
    public $sPays;
    public $sProvince;
    public $sCodePostal;

    /**
     * Categorie constructor.
     * @param $oBDD
     */
    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les Adresses dans la BDD
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
     * Rechercher un Adresse dans la BDD
     * @return mixed
     */
    public function rechercherUn() {

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
            WHERE idAdresse = :idAdresse";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(":idAdresse", $this->idAdresse);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->idAdresse = $row['idAdresse'];
        $this->sRue = $row['sRue'];
        $this->sVille = $row['sVille'];
        $this->sPays = $row['sPays'];
        $this->sProvince = $row['sProvince'];
        $this->sCodePostal = $row['sCodePostal'];
    }

    /**
     * Ajouter un Adresse dans la BDD
     * @return bool
     */
    public function ajouter() {

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET sRue = :sRue,
                sVille = :sVille,
                sPays = :sPays,
                sProvince = :sProvince,
                sCodePostal = :sCodePostal";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":sRue", $this->sRue);
        $stmt->bindParam(":sVille", $this->sVille);
        $stmt->bindParam(":sPays", $this->sPays);
        $stmt->bindParam(":sProvince", $this->sProvince);
        $stmt->bindParam(":sCodePostal", $this->sCodePostal);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Modifier un Adresse dans la BDD
     * @return bool
     */
    public function modifier() {

        $sRequete = "UPDATE " . $this->sNomTable . "
            SET
                sRue = :sRue,
                sVille = :sVille,
                sPays = :sPays,
                sProvince = :sProvince,
                sCodePostal = :sCodePostal
            WHERE
                idAdresse = :idAdresse";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":sRue", $this->sRue);
        $stmt->bindParam(":sVille", $this->sVille);
        $stmt->bindParam(":sPays", $this->sPays);
        $stmt->bindParam(":sProvince", $this->sProvince);
        $stmt->bindParam(":sCodePostal", $this->sCodePostal);
        $stmt->bindParam(":idAdresse", $this->idAdresse);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Supprimer un Adresse dans la BDD
     * @return bool
     */
    public function supprimer() {
        // delete query
        $query = "DELETE FROM " . $this->sNomTable . " WHERE idAdresse = :idAdresse";

        // prepare query
        $stmt = $this->oConnexion->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(":idAdresse", $this->idAdresse);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
