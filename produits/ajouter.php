<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:52
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.class.php';
include_once '../modeles/Produit.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN PRODUIT
$oProduit = new Produit($oBDD);

if( 
    isset($_POST['sSKUProduit']) &&
    isset($_POST['sNomProduit']) &&
    isset($_POST['sMarque']) &&
    isset($_POST['fPrixProduit']) &&
    isset($_POST['sDescCourteProduit']) &&
    isset($_POST['iNoCategorie'])
) {

    $oProduit->sSKUProduit = $_POST['sSKUProduit'];
    $oProduit->sNomProduit = $_POST['sNomProduit'];
    $oProduit->sMarque = $_POST['sMarque'];
    $oProduit->fPrixProduit = $_POST['fPrixProduit'];
    $oProduit->fPrixSolde = $_POST['fPrixSolde'];
    $oProduit->sDescCourteProduit = $_POST['sDescCourteProduit'];
    $oProduit->sDescLongProduit = $_POST['sDescLongProduit'];
    $oProduit->sCouleur = $_POST['sCouleur'];
    $oProduit->sCapacite = $_POST['sCapacite'];
    $oProduit->iNoCategorie = $_POST['iNoCategorie'];
    $oProduit->sDateAjout = date("Y-m-d");
    $oProduit->bAfficheProduit = 0;

    if($oProduit->ajouter()){
        http_response_code(201);

        echo json_encode(array("message" => "Produit créé"));
    }
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Impossible de créer le produit!"));
    }

}
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}