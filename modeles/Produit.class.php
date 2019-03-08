<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-01-27
 * Time: 15:50
 */

class Produit {

    // Connexion BDD et nom de la table
    private $oConnexion;
    private $sNomTable = "produit";

    // Propriétés
    public $idProduit;
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

    /**
     * Produit constructor.
     * @param $oBDD
     */
    public function __construct($oBDD) {
        $this->oConnexion = $oBDD;
    }

    /**
     * Rechercher tous les produits dans la BDD
     * @return mixed
     */
    public function rechercherTous(){
        // select all query
        $sRequete = "SELECT * FROM ". $this->sNomTable ." 
        LEFT JOIN categorie ON iNoCategorie = idCategorie
        ORDER BY sDateAjout DESC";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    /**
     * Rechercher un produit dans la BDD
     * @return mixed
     */
    public function rechercherUn(){

        // query to read single record
        $query = "SELECT * FROM " . $this->sNomTable . "
                LEFT JOIN
                    categorie ON iNoCategorie = idCategorie
            WHERE idProduit = :idProduit";

        // prepare query statement
        $stmt = $this->oConnexion->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(":idProduit", $this->idProduit);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->idProduit = $row['idProduit'];
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
    }


    /**
     * Rechercher tous les produits en fonction de la catégorie
     * @return mixed
     */
    public function rechercherTousParCateg(){
        // select all query
        $sRequete = "SELECT * FROM ". $this->sNomTable ." 
        LEFT JOIN categorie ON iNoCategorie = idCategorie
        WHERE iNoCategorie = :iNoCategorie ORDER BY sDateAjout DESC";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        $stmt->bindParam(":iNoCategorie", $this->iNoCategorie);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    /**
     * Ajouter un produit dans la BDD
     * @return bool
     */
    public function ajouter(){

        // query to insert record
        $sRequete = "INSERT INTO " . $this->sNomTable . "
            SET sSKUProduit=:sSKUProduit, sNomProduit=:sNomProduit, sMarque=:sMarque, fPrixProduit=:fPrixProduit, fPrixSolde=:fPrixSolde, sDescCourteProduit=:sDescCourteProduit, sDescLongProduit=:sDescLongProduit, sCouleur=:sCouleur, sCapacite=:sCapacite, iNoCategorie=:iNoCategorie, sDateAjout=:sDateAjout, bAfficheProduit=:bAfficheProduit";

        // prepare query
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind values
        $stmt->bindParam(":sSKUProduit", $this->sSKUProduit);
        $stmt->bindParam(":sNomProduit", $this->sNomProduit);
        $stmt->bindParam(":sMarque", $this->sMarque);
        $stmt->bindParam(":fPrixProduit", $this->fPrixProduit);
        $stmt->bindParam(":fPrixSolde", $this->fPrixSolde);
        $stmt->bindParam(":sDescCourteProduit", $this->sDescCourteProduit);
        $stmt->bindParam(":sDescLongProduit", $this->sDescLongProduit);
        $stmt->bindParam(":sCouleur", $this->sCouleur);
        $stmt->bindParam(":sCapacite", $this->sCapacite);
        $stmt->bindParam(":iNoCategorie", $this->iNoCategorie);
        $stmt->bindParam(":sDateAjout", $this->sDateAjout);
        $stmt->bindParam(":bAfficheProduit", $this->bAfficheProduit);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


    /**
     * Modifier un produit dans la BDD
     * @return bool
     */
    public function modifier(){
        $sRequete = "UPDATE ". $this->sNomTable ."
            SET
                sSKUProduit = :sSKUProduit,
                sNomProduit = :sNomProduit,
                sMarque = :sMarque,
                fPrixProduit = :fPrixProduit,
                fPrixSolde = :fPrixSolde,
                sDescCourteProduit = :sDescCourteProduit,
                sDescLongProduit = :sDescLongProduit,
                sCouleur = :sCouleur,
                sCapacite = :sCapacite,
                iNoCategorie = :iNoCategorie,
                bAfficheProduit = :bAfficheProduit
            WHERE
                idProduit = :idProduit";

        // prepare query statement
        $stmt = $this->oConnexion->prepare($sRequete);

        // bind new values
        $stmt->bindParam(":idProduit", $this->idProduit);
        $stmt->bindParam(":sSKUProduit", $this->sSKUProduit);
        $stmt->bindParam(":sNomProduit", $this->sNomProduit);
        $stmt->bindParam(":sMarque", $this->sMarque);
        $stmt->bindParam(":fPrixProduit", $this->fPrixProduit);
        $stmt->bindParam(":fPrixSolde", $this->fPrixSolde);
        $stmt->bindParam(":sDescCourteProduit", $this->sDescCourteProduit);
        $stmt->bindParam(":sDescLongProduit", $this->sDescLongProduit);
        $stmt->bindParam(":sCouleur", $this->sCouleur);
        $stmt->bindParam(":sCapacite", $this->sCapacite);
        $stmt->bindParam(":iNoCategorie", $this->iNoCategorie);
        $stmt->bindParam(":bAfficheProduit", $this->bAfficheProduit);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


    /**
     * Supprimer un produit dans la BDD
     * @return bool
     */
    public function supprimer(){
        // delete query
        $query = "DELETE FROM " . $this->sNomTable . " WHERE idProduit = :idProduit";

        // prepare query
        $stmt = $this->oConnexion->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(":idProduit", $this->idProduit);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}