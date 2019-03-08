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
include_once '../modeles/Utilisateur.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oUtilisateur = new Utilisateur($oBDD);

// set ID property of record to read
$oUtilisateur->idUtilisateur = isset($_GET['idUtilisateur']) ? $_GET['idUtilisateur'] : die();

// read the details of product to be edited
$oUtilisateur->rechercherUn();

if($oUtilisateur->idUtilisateur != null){
    // create array
    $aUtilisateur = array(
        // Utilisateur
        "idUtilisateur" => $oUtilisateur->idUtilisateur,
        "sCourriel" => $oUtilisateur->sCourriel,
        "sNumTelephone" => $oUtilisateur->sNumTelephone,
        "sPrenomUtilisateur" => $oUtilisateur->sPrenomUtilisateur,
        "sNomUtilisateur" => $oUtilisateur->sNomUtilisateur,
        "sDateInscription" => $oUtilisateur->sDateInscription,

        // Adresse
        "iNoAdresse" => $oUtilisateur->iNoAdresse,
        "sRue" => $oUtilisateur->sRue,
        "sVille" => $oUtilisateur->sVille,
        "sPays" => $oUtilisateur->sPays,
        "sProvince" => $oUtilisateur->sProvince,
        "sCodePostal" => $oUtilisateur->sCodePostal
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($aUtilisateur);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Utilisateur does not exist."));
}
