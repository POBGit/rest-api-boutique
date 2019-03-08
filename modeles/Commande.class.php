<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-01-27
 * Time: 15:53
 */

class Commande {

    // Connexion BDD et nom de la table
    private $oConnexion;
    private $sNomTable = "Commande";

    public $idCommande;
    public $sNumeroCommande;
    public $sDateCommande;
    public $fFraisLivraison;
    public $fTPS;
    public $fTVQ;
    public $sEtatCommande;
    public $sTrackingNumCommande;

    // Commande facturation
    public $iNoAdresseFacturation;
    public $sRueFacturation;
    public $sVilleFacturation;
    public $sPaysFacturation;
    public $sProvinceFacturation;
    public $sCodePostalFacturation;

    // Commande de livraison
    public $iNoAdresseExpedition;
    public $sRueExpedition;
    public $sVilleExpedition;
    public $sPaysExpedition;
    public $sProvinceExpedition;
    public $sCodePostalExpedition;

    // Utilisateur
    public $iNoUtilisateur;
    public $sCourriel;
    public $sNumTelephone;
    public $sPrenomUtilisateur;
    public $sNomUtilisateur;

    /**
     * Commande constructor.
     * @param $oBDD
     */
    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les Commandes dans la BDD
     * @return mixed
     */
    public function rechercherTous() {
        // select all query
        $sRequete = "SELECT * FROM " . $this->sNomTable ."
        LEFT JOIN utilisateur ON idUtilisateur = iNoUtilisateur
        LEFT JOIN adresse AS adresseFacturation ON adresseFacturation.idAdresse = iNoAdresseFacturation
        LEFT JOIN adresse AS adresseExpedition ON adresseExpedition.idAdresse = iNoAdresseExpedition
        ";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    /**
     * Rechercher un Commande dans la BDD
     * @return mixed
     */
    public function rechercherUn() {

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
        LEFT JOIN utilisateur ON idUtilisateur = iNoUtilisateur
        LEFT JOIN adresse AS adresseFacturation ON adresseFacturation.idAdresse = iNoAdresseFacturation
        LEFT JOIN adresse AS adresseExpedition ON adresseExpedition.idAdresse = iNoAdresseExpedition
            WHERE idCommande = :idCommande";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(":idCommande", $this->idCommande);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->idCommande = $row['idCommande'];
        $this->sNumeroCommande = $row['sNumeroCommande'];
        $this->sDateCommande = $row['sDateCommande'];
        $this->fFraisLivraison = $row['fFraisLivraison'];
        $this->fTPS = $row['fTPS'];
        $this->fTVQ = $row['fTVQ'];
        $this->sEtatCommande = $row['sEtatCommande'];
        $this->sTrackingNumCommande = $row['sTrackingNumCommande'];

        // Commande facturation
        $this->iNoAdresseFacturation = $row['iNoAdresse'];
        $this->sRueFacturation = $row['sRue'];
        $this->sVilleFacturation = $row['sVille'];
        $this->sPaysFacturation = $row['sPays'];
        $this->sProvinceFacturation = $row['sProvince'];
        $this->sCodePostalFacturation = $row['sCodePostal'];

        // Commande de livraison
        $this->iNoAdresseExpedition = $row['iNoAdresse'];
        $this->sRueExpedition = $row['sRue'];
        $this->sVilleExpedition = $row['sVille'];
        $this->sPaysExpedition = $row['sPays'];
        $this->sProvinceExpedition = $row['sProvince'];
        $this->sCodePostalExpedition = $row['sCodePostal'];

        // Utilisateur
        $this->iNoUtilisateur = $row['iNoUtilisateur'];
        $this->sCourriel = $row['sCourriel'];
        $this->sNumTelephone = $row['sNumTelephone'];
        $this->sPrenomUtilisateur = $row['sPrenomUtilisateur'];
        $this->sNomUtilisateur = $row['sNomUtilisateur'];
    }

    /**
     * Ajouter un Commande dans la BDD
     * @return bool
     */
    public function ajouter() {

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET sNumeroCommande = :sNumeroCommande,
                sDateCommande = :sDateCommande,
                iNoUtilisateur = :iNoUtilisateur,
                fFraisLivraison = :fFraisLivraison,
                fTPS = :fTPS,
                fTVQ = :fTVQ,
                sEtatCommande = :sEtatCommande,
                sTrackingNumCommande = :sTrackingNumCommande,
                iNoAdresseFacturation = :iNoAdresseFacturation,
                iNoAdresseExpedition = :iNoAdresseExpedition
                ";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":sNumeroCommande", $this->sNumeroCommande);
        $stmt->bindParam(":sDateCommande", $this->sDateCommande);
        $stmt->bindParam(":iNoUtilisateur", $this->iNoUtilisateur);
        $stmt->bindParam(":fFraisLivraison", $this->fFraisLivraison);
        $stmt->bindParam(":fTPS", $this->fTPS);
        $stmt->bindParam(":fTVQ", $this->fTVQ);
        $stmt->bindParam(":sEtatCommande", $this->sEtatCommande);
        $stmt->bindParam(":sTrackingNumCommande", $this->sTrackingNumCommande);
        $stmt->bindParam(":iNoAdresseFacturation", $this->iNoAdresseFacturation);
        $stmt->bindParam(":iNoAdresseExpedition", $this->iNoAdresseExpedition);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Modifier un Commande dans la BDD
     * @return bool
     */
    public function modifier() {

        $sRequete = "UPDATE " . $this->sNomTable . "
            SET
                fFraisLivraison = :fFraisLivraison,
                fTPS = :fTPS,
                fTVQ = :fTVQ,
                sEtatCommande = :sEtatCommande,
                sTrackingNumCommande = :sTrackingNumCommande
            WHERE
                idCommande = :idCommande";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":idCommande", $this->idCommande);
        $stmt->bindParam(":fFraisLivraison", $this->fFraisLivraison);
        $stmt->bindParam(":fTPS", $this->fTPS);
        $stmt->bindParam(":fTVQ", $this->fTVQ);
        $stmt->bindParam(":sEtatCommande", $this->sEtatCommande);
        $stmt->bindParam(":sTrackingNumCommande", $this->sTrackingNumCommande);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Supprimer un Commande dans la BDD
     * @return bool
     */
    public function supprimer() {
        // delete query
        $query = "DELETE FROM " . $this->sNomTable . " WHERE idCommande = :idCommande";

        // prepare query
        $stmt = $this->oConnexion->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(":idCommande", $this->idCommande);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
