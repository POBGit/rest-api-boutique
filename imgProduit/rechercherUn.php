<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-13
 * Time: 11:30
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/Database.class.php';
include_once '../modeles/ImgProduit.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oImgProduit = new ImgProduit($oBDD);

// set ID property of record to read
$oImgProduit->idImgProduit = isset($_GET['idImgProduit']) ? $_GET['idImgProduit'] : die();

// read the details of product to be edited
$oImgProduit->rechercherUn();

if($oImgProduit->sUrlImg != null){
    // create array
    $aCategories = array(
        // Produit
        "idImgProduit" => $oImgProduit->idImgProduit,
        "sUrlImg" => $oImgProduit->sUrlImg,
        "iNoProduit" => $oImgProduit->iNoProduit
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