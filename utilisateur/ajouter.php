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
include_once '../modeles/Utilisateur.class.php';

// BASE DE DONNÉES
$oDatabase = new Database();
$oBDD = $oDatabase->getConnexion();

// CRÉATION D'UN PRODUIT
$oUtilisateur = new Utilisateur($oBDD);

if(
    isset($_POST['sCourriel']) &&
    isset($_POST['sMotDePasse']) &&
    isset($_POST['sNumTelephone']) &&
    isset($_POST['sPrenomUtilisateur']) &&
    isset($_POST['sNomUtilisateur']) &&
    isset($_POST['iNoAdresse'])
) {

    $oUtilisateur->idUtilisateur = $_POST['idUtilisateur'];
    $oUtilisateur->sCourriel = $_POST['sCourriel'];
    $oUtilisateur->sMotDePasse = $_POST['sMotDePasse'];
    $oUtilisateur->sNumTelephone = $_POST['sNumTelephone'];
    $oUtilisateur->sPrenomUtilisateur = $_POST['sPrenomUtilisateur'];
    $oUtilisateur->sNomUtilisateur = $_POST['sNomUtilisateur'];
    $oUtilisateur->sDateInscription = date("Y-m-d H:i:s");
    $oUtilisateur->iNoAdresse = $_POST['iNoAdresse'];

    if($oUtilisateur->ajouter()){
        http_response_code(201);

        echo json_encode(array("message" => "Utilisateur créé"));
    }
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Impossible de créer le Utilisateur!"));
    }

}
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create Utilisateur. Data is incomplete."));
}
