<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-13
 * Time: 11:25
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/Database.class.php';
include_once '../modeles/Categorie.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oCategorie = new Categorie($oBDD);

// set ID property of record to read
$oCategorie->sUrlCategorie = isset($_GET['sUrlCategorie']) ? $_GET['sUrlCategorie'] : die();

// read the details of product to be edited
$oCategorie->rechercherUn();

if($oCategorie->sNomCategorie != null){
    // create array
    $aCategories = array(
        // Produit
        "idCategorie" => $oCategorie->idCategorie,
        "sNomCategorie" => $oCategorie->sNomCategorie,
        "sUrlImg" => $oCategorie->sUrlImg,
        "sUrlCategorie" => $oCategorie->sUrlCategorie
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($aCategories);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Categorie does not exist."));
}
