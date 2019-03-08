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
include_once '../modeles/Adresse.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oAdresse = new Adresse($oBDD);

// set ID property of product to be edited
$oAdresse->idAdresse = $_POST['idAdresse'];

// set product property values
$oAdresse->sRue = $_POST['sRue'];
$oAdresse->sVille = $_POST['sVille'];
$oAdresse->sPays = $_POST['sPays'];
$oAdresse->sProvince = $_POST['sProvince'];
$oAdresse->sCodePostal = $_POST['sCodePostal'];

// update the product
if($oAdresse->modifier()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Le Adresse est mit à jour."));
}

// if unable to update the product, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Impossible de modifier ce Adresse"));
}
