<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-13
 * Time: 10:54
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/Database.class.php';
include_once '../modeles/Utilisateur.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oUtilisateur = new Utilisateur($oBDD);

// set product id to be deleted
$oUtilisateur->idUtilisateur = isset($_GET['idUtilisateur']) ? $_GET['idUtilisateur'] : die();

// delete the product
if($oUtilisateur->supprimer()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Utilisateur was deleted."));
}

// if unable to delete the product
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete Utilisateur."));
}
