<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:17
 */

class ContenuPanier {
    // Connexion BDD et nom de la table
    private $oConnexion;
    private $sNomTable = "contenupanier";

    public $idContenuPanier;
    public $iQteProduit;

    // Produit
    public $iNoProduit;
    public $sSKUProduit;
    public $sNomProduit;
    public $sMarque;
    public $fPrixProduit;
    public $fPrixSolde;
    public $sDescCourteProduit;
    public $sDescLongProduit;
    public $sCouleur;
    public $sCapacite;
    public $sDateAjout;
    public $bAfficheProduit;
    public $iNoCategorie;
    public $sNomCategorie;
    public $sUrlCategorie;

    // Panier
    public $iNoPanier;
    public $sNumPanier;
    public $sDateModification;

    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les ContenuPaniers dans la BDD
     * @return mixed
     */
    public function rechercherTous() {
        // select all query
        $sRequete = "SELECT * FROM " . $this->sNomTable ."
        LEFT JOIN panier ON idPanier = iNoPanier
        LEFT JOIN produit ON idProduit = iNoProduit
        ";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    /**
     * Rechercher un ContenuPanier dans la BDD
     * @return mixed
     */
    public function rechercherUn() {

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
        LEFT JOIN panier ON idPanier = iNoPanier
        LEFT JOIN produit ON idProduit = iNoProduit
            WHERE iNoPanier = :iNoPanier";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(":iNoPanier", $this->iNoPanier);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->idContenuPanier = $row['idContenuPanier'];
        $this->iQteProduit = $row['iQteProduit'];

        // Produit
        $this->iNoProduit = $row['iNoProduit'];
        $this->sSKUProduit = $row['sSKUProduit'];
        $this->sNomProduit = $row['sNomProduit'];
        $this->sMarque = $row['sMarque'];
        $this->fPrixProduit = $row['fPrixProduit'];
        $this->fPrixSolde = $row['fPrixSolde'];
        $this->sDescCourteProduit = $row['sDescCourteProduit'];
        $this->sDescLongProduit = $row['sDescLongProduit'];
        $this->sCouleur = $row['sCouleur'];
        $this->sCapacite = $row['sCapacite'];
        $this->sDateAjout = $row['sDateAjout'];
        $this->bAfficheProduit = $row['bAfficheProduit'];
        $this->iNoCategorie = $row['iNoCategorie'];
        $this->sNomCategorie = $row['sNomCategorie'];
        $this->sUrlCategorie = $row['sUrlCategorie'];

        // Panier
        $this->iNoPanier = $row['iNoPanier'];
        $this->sNumPanier = $row['sNumPanier'];
        $this->sDateModification = $row['sDateModification'];
    }


    public function rechercherTousParPanier(){
        // select all query
        $sRequete = "SELECT * FROM " . $this->sNomTable . "
            LEFT JOIN panier ON idPanier = iNoPanier
            LEFT JOIN produit ON idProduit = iNoProduit
            WHERE iNoPanier = :iNoPanier
        ";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        $stmt->bindParam(":iNoPanier", $this->iNoPanier);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    /**
     * Ajouter un ContenuPanier dans la BDD
     * @return bool
     */
    public function ajouter() {

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET  iNoProduit = :iNoProduit,
                iNoPanier = :iNoPanier,
                iQteProduit = :iQteProduit";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":iQteProduit", $this->iQteProduit);
        $stmt->bindParam(":iNoProduit", $this->iNoProduit);
        $stmt->bindParam(":iNoPanier", $this->iNoPanier);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Modifier un ContenuPanier dans la BDD
     * @return bool
     */
    public function modifier() {

        $sRequete = "UPDATE " . $this->sNomTable . "
            SET
                iNoProduit = :iNoProduit,
                iNoPanier = :iNoPanier,
                iQteProduit = :iQteProduit
            WHERE
                idContenuPanier = :idContenuPanier";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":iQteProduit", $this->iQteProduit);
        $stmt->bindParam(":iNoProduit", $this->iNoProduit);
        $stmt->bindParam(":iNoPanier", $this->iNoPanier);
        $stmt->bindParam(":idContenuPanier", $this->idContenuPanier);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Supprimer un ContenuPanier dans la BDD
     * @return bool
     */
    public function supprimer() {
        // delete query
        $query = "DELETE FROM " . $this->sNomTable . " WHERE idContenuPanier = :idContenuPanier";

        // prepare query
        $stmt = $this->oConnexion->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(":idContenuPanier", $this->idContenuPanier);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
