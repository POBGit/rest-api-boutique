<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 16:50
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/Database.class.php';
include_once '../modeles/Produit.class.php';
include_once '../modeles/Categorie.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oProduit = new Produit($oBDD);

// set ID property of record to read
$oProduit->idProduit = isset($_GET['idProduit']) ? $_GET['idProduit'] : die();

// read the details of product to be edited
$oProduit->rechercherUn();

if($oProduit->sNomProduit != null){
    // create array
    $aProduit = array(
        // Produit
        "idProduit" => $oProduit->idProduit,
        "sSKUProduit" => $oProduit->sSKUProduit,
        "sNomProduit" => $oProduit->sNomProduit,
        "sMarque" => $oProduit->sMarque,
        "fPrixProduit" => $oProduit->fPrixProduit,
        "fPrixSolde" => $oProduit->fPrixSolde,
        "sDescCourteProduit" => $oProduit->sDescCourteProduit,
        "sDescLongProduit" => $oProduit->sDescLongProduit,
        "sCouleur" => $oProduit->sCouleur,
        "sCapacite" => $oProduit->sCapacite,
        "sDateAjout" => $oProduit->sDateAjout,
        "bAfficheProduit" => $oProduit->bAfficheProduit,

        // Catégorie
        "idCategorie" => $oProduit->iNoCategorie,
        "sNomCategorie" => $oProduit->sNomCategorie,
        "sUrlCategorie" => $oProduit->sUrlCategorie
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($aProduit);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}