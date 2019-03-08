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
include_once '../modeles/Panier.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN PRODUIT
$oPanier = new Panier($oBDD);

if(isset($_POST['cmd'])) {

    $oPanier->sNumPanier = uniqid();
    $oPanier->sDateModification = date("Y-m-d");

    if($oPanier->ajouter()){
        http_response_code(201);

        echo json_encode(array("message" => "Panier créé"));
    }
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Impossible de créer le Panier!"));
    }

}
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create Panier. Data is incomplete."));
}
