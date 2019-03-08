<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-11
 * Time: 11:41
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/Database.class.php';
include_once '../modeles/Produit.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oProduit = new Produit($oBDD);

var_dump($_POST);

// set ID property of product to be edited
$oProduit->idProduit = $_POST['idProduit'];

// set product property values
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
$oProduit->bAfficheProduit = $_POST['bAfficheProduit'];

// update the product
if($oProduit->modifier()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Le produit est mit à jour."));
}

// if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Impossible de modifier ce produit"));
}