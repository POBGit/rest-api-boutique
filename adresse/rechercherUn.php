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
include_once '../modeles/Adresse.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oAdresse = new Adresse($oBDD);

// set ID property of record to read
$oAdresse->idAdresse = isset($_GET['idAdresse']) ? $_GET['idAdresse'] : die();

// read the details of product to be edited
$oAdresse->rechercherUn();

if($oAdresse->idAdresse != null){
    // create array
    $aAdresse = array(
        "idAdresse" => $oAdresse->idAdresse,
        "sRue" => $oAdresse->sRue,
        "sVille" => $oAdresse->sVille,
        "sPays" => $oAdresse->sPays,
        "sProvince" => $oAdresse->sProvince,
        "sCodePostal" => $oAdresse->sCodePostal
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($aAdresse);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Adresse does not exist."));
}
