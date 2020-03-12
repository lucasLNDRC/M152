<?php
// Projet: Association XYZ
// Script: Modèle dbconnecion.php
// Description: contient la fonction de connexion à la base de données.
// Auteur: Novice Entreprise
// Version 1.0.0 PC 02.10.2017 / Codage initial

require_once 'config.php';

class Db{
    static $db = null;

    /**
     * effectue la connexion à la base de données 
     * PDO objet de connexion à la base de données
     */
    function __construct()
    {
        try{
            if (Db::$db === null)
            {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                Db::$db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PWD, $pdo_options);
                Db::$db->exec('SET CHARACTER SET utf8');
            } 
        }
        catch (Exception $e){  die("Impossible de se connecter à la base ". $e->getMessage());}
    }

    /**
     * 
     */
    function Select($sql, $data){
        try{
            $query = Db::$db->prepare($sql);
            $query->execute($data);
            
            $donnee = $query->fetchAll(PDO::FETCH_ASSOC);
            if (count($donnee)>1)
                return $donnee;
            else if (count($donnee)==1)
                return  $donnee[0];
            else 
                return $donnee;
        }
        catch (Exception $e) {
            throw new Exception();            
        }
    }

     /**
     * 
     */
    function Insert($sql, $data){
        try{
            $query = Db::$db->prepare($sql);
    
            $query->execute($data);
            return true;
        }
        catch (Exception $e) {
            throw new Exception();
        }
    }
}