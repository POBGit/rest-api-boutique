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
include_once '../modeles/ContenuCommande.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oContenuCommande = new ContenuCommande($oBDD);

// set ID property of record to read
$oContenuCommande->idContenuCommande = isset($_GET['idContenuCommande']) ? $_GET['idContenuCommande'] : die();

// read the details of product to be edited
$oContenuCommande->rechercherUn();

if($oContenuCommande->idContenuCommande != null){
    // create array
    $aContenuCommande = array(
        "idContenuCommande" => $oContenuCommande->idContenuCommande,
        "iQteProduitCommande" => $oContenuCommande->iQteProduitCommande,
        "fPrixCommande" => $oContenuCommande->fPrixCommande,
        "iNoCommande" => $oContenuCommande->iNoCommande,

        // Produit
        "iNoProduit" => $oContenuCommande->iNoProduit,
        "sSKUProduit" => $oContenuCommande->sSKUProduit,
        "sNomProduit" => $oContenuCommande->sNomProduit,
        "sMarque" => $oContenuCommande->sMarque,
        "fPrixProduit" => $oContenuCommande->fPrixProduit,
        "fPrixSolde" => $oContenuCommande->fPrixSolde,
        "sDescCourteProduit" => $oContenuCommande->sDescCourteProduit,
        "sCouleur" => $oContenuCommande->sCouleur,
        "sCapacite" => $oContenuCommande->sCapacite
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($aContenuCommande);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "ContenuCommande does not exist."));
}
