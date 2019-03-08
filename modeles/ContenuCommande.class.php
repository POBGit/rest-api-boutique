<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:17
 */

class ContenuCommande {

    private $oConnexion;
    private $sNomTable = "contenucommande";

    public $idContenuCommande;
    public $iQteProduitCommande;
    public $fPrixCommande;
    public $iNoCommande;

    // Produit
    public $iNoProduit;
    public $sSKUProduit;
    public $sNomProduit;
    public $sMarque;
    public $fPrixProduit;
    public $fPrixSolde;
    public $sDescCourteProduit;
    public $sCouleur;
    public $sCapacite;


    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les ContenuCommandes dans la BDD
     * @return mixed
     */
    public function rechercherTous() {
        // select all query
        $sRequete = "SELECT * FROM " . $this->sNomTable ."
            LEFT JOIN produit ON idProduit = iNoProduit
        ";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    /**
     * Rechercher un ContenuCommande dans la BDD
     * @return mixed
     */
    public function rechercherUn() {

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
        LEFT JOIN produit ON idProduit = iNoProduit
            WHERE idContenuCommande = :idContenuCommande";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(":idContenuCommande", $this->idContenuCommande);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->idContenuCommande = $row['idContenuCommande'];
        $this->iQteProduitCommande = $row['iQteProduitCommande'];
        $this->fPrixCommande = $row['fPrixCommande'];
        $this->iNoCommande = $row['iNoCommande'];

        // Produit
        $this->iNoProduit = $row['iNoProduit'];
        $this->sSKUProduit = $row['sSKUProduit'];
        $this->sNomProduit = $row['sNomProduit'];
        $this->sMarque = $row['sMarque'];
        $this->fPrixProduit = $row['fPrixProduit'];
        $this->fPrixSolde = $row['fPrixSolde'];
        $this->sDescCourteProduit = $row['sDescCourteProduit'];
        $this->sCouleur = $row['sCouleur'];
        $this->sCapacite = $row['sCapacite'];
    }

    /**
     * Ajouter un ContenuCommande dans la BDD
     * @return bool
     */
    public function ajouter() {

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET iQteProduitCommande = :iQteProduitCommande,
                fPrixCommande = :fPrixCommande,
                iNoCommande = :iNoCommande,
                iNoProduit = :iNoProduit";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":iQteProduitCommande", $this->iQteProduitCommande);
        $stmt->bindParam(":fPrixCommande", $this->fPrixCommande);
        $stmt->bindParam(":iNoCommande", $this->iNoCommande);
        $stmt->bindParam(":iNoProduit", $this->iNoProduit);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Modifier un ContenuCommande dans la BDD
     * @return bool
     */
    public function modifier() {

        $sRequete = "UPDATE " . $this->sNomTable . "
            SET
                iQteProduitCommande = :iQteProduitCommande,
                fPrixCommande = :fPrixCommande,
                iNoProduit = :iNoProduit
            WHERE
                idContenuCommande = :idContenuCommande";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":iQteProduitCommande", $this->iQteProduitCommande);
        $stmt->bindParam(":fPrixCommande", $this->fPrixCommande);
        $stmt->bindParam(":iNoProduit", $this->iNoProduit);
        $stmt->bindParam(":idContenuCommande", $this->idContenuCommande);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Supprimer un ContenuCommande dans la BDD
     * @return bool
     */
    public function supprimer() {
        // delete query
        $query = "DELETE FROM " . $this->sNomTable . " WHERE idContenuCommande = :idContenuCommande";

        // prepare query
        $stmt = $this->oConnexion->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(":idContenuCommande", $this->idContenuCommande);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
