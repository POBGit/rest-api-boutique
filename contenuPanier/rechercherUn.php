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
include_once '../modeles/ContenuPanier.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oContenuPanier = new ContenuPanier($oBDD);

// set ID property of record to read
$oContenuPanier->iNoPanier = isset($_GET['iNoPanier']) ? $_GET['iNoPanier'] : die();

// read the details of product to be edited
$oContenuPanier->rechercherUn();

if($oContenuPanier->idContenuPanier != null){
    // create array
    $aContenuPanier = array(
        "idContenuPanier" => $oContenuPanier->idContenuPanier,
        "iQteProduit" => $oContenuPanier->iQteProduit,
        "iNoPanier" => $oContenuPanier->iNoPanier,
        "iNoProduit" => $oContenuPanier->iNoProduit,

        // Produit
        "sSKUProduit" => $oContenuPanier->sSKUProduit,
        "sNomProduit" => $oContenuPanier->sNomProduit,
        "sMarque" => $oContenuPanier->sMarque,
        "fPrixProduit" => $oContenuPanier->fPrixProduit,
        "fPrixSolde" => $oContenuPanier->fPrixSolde,
        "sDescCourteProduit" => $oContenuPanier->sDescCourteProduit,
        "sDescLongProduit" => $oContenuPanier->sDescLongProduit,
        "sCouleur" => $oContenuPanier->sCouleur,
        "sCapacite" => $oContenuPanier->sCapacite,
        "sDateAjout" => $oContenuPanier->sDateAjout,
        "bAfficheProduit" => $oContenuPanier->bAfficheProduit,

        // Catégorie
        "idCategorie" => $oContenuPanier->iNoCategorie,
        "sNomCategorie" => $oContenuPanier->sNomCategorie,
        "sUrlCategorie" => $oContenuPanier->sUrlCategorie,

        // Panier
        "idPanier" => $oContenuPanier->iNoPanier,
        "sNumPanier" => $oContenuPanier->sNumPanier,
        "sDateModification" => $oContenuPanier->sDateModification
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($aContenuPanier);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "ContenuPanier does not exist."));
}
