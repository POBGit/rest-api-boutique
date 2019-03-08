<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-10
 * Time: 15:04
 */

class Database {
    private $sHote = "localhost";
    private $sNomBDD = "boutique";
    private $sUsername = "root";
    private $sMotDePasse = "";
    public $connexion;

    public function getConnexion(){
        $this->connexion = null;

        try{
            $this->connexion = new PDO("mysql:host=". $this->sHote .";dbname=". $this->sNomBDD, $this->sUsername, $this->sMotDePasse);
            $this->connexion->exec("set names utf8");
        }
        catch (PDOException $oPDOException){
            echo "Erreur de connexion : " . $oPDOException->getMessage();
        }

        return $this->connexion;
    }
}