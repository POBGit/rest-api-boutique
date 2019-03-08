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
include_once '../modeles/Commande.class.php';

// get database connection
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// prepare product object
$oCommande = new Commande($oBDD);

// set ID property of record to read
$oCommande->idCommande = isset($_GET['idCommande']) ? $_GET['idCommande'] : die();

// read the details of product to be edited
$oCommande->rechercherUn();

if($oCommande->idCommande != null){
    // create array
    $aCommande = array(
        "idCommande" => $idCommande,
        "sNumeroCommande" => $sNumeroCommande,
        "sDateCommande" => $sDateCommande,
        "fFraisLivraison" => $fFraisLivraison,
        "fTPS" => $fTPS,
        "fTVQ" => $fTVQ,
        "sEtatCommande" => $sEtatCommande,
        "sTrackingNumCommande" => $sTrackingNumCommande,

        // Commande facturation
        "iNoCommandeFacturation" => $iNoAdresseFacturation,
        "sRueFacturation" => $sRue,
        "sVilleFacturation" => $sVille,
        "sPaysFacturation" => $sPays,
        "sProvinceFacturation" => $sProvince,
        "sCodePostalFacturation" => $sCodePostal,

        // Commande de livraison
        "iNoAdresseExpedition" => $iNoAdresseExpedition,
        "sRueExpedition" => $sRue,
        "sVilleExpedition" => $sVille,
        "sPaysExpedition" => $sPays,
        "sProvinceExpedition" => $sProvince,
        "sCodePostalExpedition" => $sCodePostal,

        // Utilisateur
        "iNoUtilisateur" => $iNoUtilisateur,
        "sNumTelephone" => $sNumTelephone,
        "sPrenomUtilisateur" => $sPrenomUtilisateur,
        "sNomUtilisateur" => $sNomUtilisateur
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($aCommande);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Commande does not exist."));
}
