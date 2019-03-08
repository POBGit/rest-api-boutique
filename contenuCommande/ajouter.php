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
include_once '../modeles/ContenuCommande.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN PRODUIT
$oContenuCommande = new ContenuCommande($oBDD);

if(
    isset($_POST['iQteProduitCommande']) &&
    isset($_POST['fPrixCommande']) &&
    isset($_POST['iNoCommande']) &&
    isset($_POST['iNoProduit'])
) {

    $oContenuCommande->iQteProduitCommande = $_POST['iQteProduitCommande'];
    $oContenuCommande->fPrixCommande = $_POST['fPrixCommande'];
    $oContenuCommande->iNoCommande = $_POST['iNoCommande'];
    $oContenuCommande->iNoProduit = $_POST['iNoProduit'];

    if($oContenuCommande->ajouter()){
        http_response_code(201);

        echo json_encode(array("message" => "ContenuCommande créé"));
    }
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Impossible de créer le ContenuCommande!"));
    }

}
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create ContenuCommande. Data is incomplete."));
}
