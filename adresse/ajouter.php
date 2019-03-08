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
include_once '../modeles/Adresse.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN PRODUIT
$oAdresse = new Adresse($oBDD);

if(
    isset($_POST['sRue']) &&
    isset($_POST['sVille']) &&
    isset($_POST['sPays']) &&
    isset($_POST['sProvince']) &&
    isset($_POST['sCodePostal'])
) {

    $oAdresse->sRue = $_POST['sRue'];
    $oAdresse->sVille = $_POST['sVille'];
    $oAdresse->sPays = $_POST['sPays'];
    $oAdresse->sProvince = $_POST['sProvince'];
    $oAdresse->sCodePostal = $_POST['sCodePostal'];

    if($oAdresse->ajouter()){
        http_response_code(201);

        echo json_encode(array("message" => "Adresse créé"));
    }
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Impossible de créer le Adresse!"));
    }

}
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create Adresse. Data is incomplete."));
}
