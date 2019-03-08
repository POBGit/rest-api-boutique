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
include_once '../modeles/Commande.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN PRODUIT
$oCommande = new Commande($oBDD);

if(
    isset($_POST['sNumeroCommande']) &&
    isset($_POST['iNoUtilisateur']) &&
    isset($_POST['fFraisLivraison']) &&
    isset($_POST['iNoAdresseFacturation']) &&
    isset($_POST['iNoAdresseExpedition'])
) {

    $oCommande->sNumeroCommande = $_POST['sNumeroCommande'];
    $oCommande->sDateCommande = date("Y-m-d H:i:s");
    $oCommande->iNoUtilisateur = $_POST['iNoUtilisateur'];
    $oCommande->fFraisLivraison = $_POST['fFraisLivraison'];
    $oCommande->fTPS = 1.05;
    $oCommande->fTVQ = 1.09975;
    $oCommande->sEtatCommande = "reçue";
    $oCommande->sTrackingNumCommande = "";
    $oCommande->iNoAdresseFacturation = $_POST['iNoAdresseFacturation'];
    $oCommande->iNoAdresseExpedition = $_POST['iNoAdresseExpedition'];

    if($oCommande->ajouter()){
        http_response_code(201);

        echo json_encode(array("message" => "Commande créé"));
    }
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Impossible de créer le Commande!"));
    }

}
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create Commande. Data is incomplete."));
}
