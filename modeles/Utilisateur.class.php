<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-01-27
 * Time: 15:55
 */

class Utilisateur {

    // Connexion BDD et nom de la table
    private $oConnexion;
    private $sNomTable = "utilisateur";

    public $idUtilisateur;
    public $sCourriel;
    public $sMotDePasse;
    public $sNumTelephone;
    public $sPrenomUtilisateur;
    public $sNomUtilisateur;
    public $sDateInscription;

    // Adresse
    public $iNoAdresse;
    public $sRue;
    public $sVille;
    public $sPays;
    public $sProvince;
    public $sCodePostal;

    /**
     * Utilisateur constructor.
     * @param $oBDD
     */
    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les utilisateurs dans la BDD
     * @return mixed
     */
    public function rechercherTous() {
        // select all query
        $sRequete = "SELECT * FROM " . $this->sNomTable . " 
        LEFT JOIN adresse ON iNoAdresse = idAdresse";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    /**
     * Rechercher un utilisateur dans la BDD
     * @return mixed
     */
    public function rechercherUn() {

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
                LEFT JOIN
                    adresse ON iNoAdresse = idAdresse
            WHERE idUtilisateur = :idUtilisateur";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(":idUtilisateur", $this->idUtilisateur);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->idUtilisateur = $row['idUtilisateur'];
        $this->sCourriel = $row['sCourriel'];
        $this->sMotDePasse = "";
        $this->sNumTelephone = $row['sNumTelephone'];
        $this->sPrenomUtilisateur = $row['sPrenomUtilisateur'];
        $this->sNomUtilisateur = $row['sNomUtilisateur'];
        $this->sDateInscription = $row['sDateInscription'];
        $this->iNoAdresse = $row['iNoAdresse'];
        $this->sRue = $row['sRue'];
        $this->sVille = $row['sVille'];
        $this->sPays = $row['sPays'];
        $this->sProvince = $row['sProvince'];
        $this->sCodePostal = $row['sCodePostal'];
    }

    /**
     * Ajouter un utilisateur dans la BDD
     * @return bool
     */
    public function ajouter() {

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET sCourriel = :sCourriel, 
                sMotDePasse = :sMotDePasse, 
                sNumTelephone = :sNumTelephone,
                sPrenomUtilisateur = :sPrenomUtilisateur, 
                sNomUtilisateur = :sNomUtilisateur, 
                sDateInscription = :sDateInscription,
                iNoAdresse = :iNoAdresse";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":sCourriel", $this->sCourriel);
        $stmt->bindParam(":sMotDePasse", $this->sMotDePasse);
        $stmt->bindParam(":sNumTelephone", $this->sNumTelephone);
        $stmt->bindParam(":sPrenomUtilisateur", $this->sPrenomUtilisateur);
        $stmt->bindParam(":sNomUtilisateur", $this->sNomUtilisateur);
        $stmt->bindParam(":sDateInscription", $this->sDateInscription);
        $stmt->bindParam(":iNoAdresse", $this->iNoAdresse);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Modifier un utilisateur dans la BDD
     * @return bool
     */
    public function modifier() {

        var_dump($this);

        $sRequete = "UPDATE " . $this->sNomTable . "
            SET
                sCourriel = :sCourriel, 
                sMotDePasse = :sMotDePasse, 
                sNumTelephone = :sNumTelephone,
                sPrenomUtilisateur = :sPrenomUtilisateur, 
                sNomUtilisateur = :sNomUtilisateur,
                iNoAdresse = :iNoAdresse
            WHERE
                idUtilisateur = :idUtilisateur";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":sCourriel", $this->sCourriel);
        $stmt->bindParam(":sMotDePasse", $this->sMotDePasse);
        $stmt->bindParam(":sNumTelephone", $this->sNumTelephone);
        $stmt->bindParam(":sPrenomUtilisateur", $this->sPrenomUtilisateur);
        $stmt->bindParam(":sNomUtilisateur", $this->sNomUtilisateur);
        $stmt->bindParam(":iNoAdresse", $this->iNoAdresse);
        $stmt->bindParam(":idUtilisateur", $this->idUtilisateur);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Supprimer un utilisateur dans la BDD
     * @return bool
     */
    public function supprimer() {
        // delete query
        $query = "DELETE FROM " . $this->sNomTable . " WHERE idUtilisateur = :idUtilisateur";

        // prepare query
        $stmt = $this->oConnexion->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(":idUtilisateur", $this->idUtilisateur);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
