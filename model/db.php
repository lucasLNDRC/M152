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
    function Db()
    {
        try{
            if ($db === null)
            {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PWD, $pdo_options);
                $db->exec('SET CHARACTER SET utf8');
            } 
        }
        catch (Exception $e){ die($e); echo $e;}
    }

    /**
     * 
     */
    function Select($sql, $data=null){
        try{
            $query = $db->prepare($sql);
            $query->execute($data);
            
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if (count($data)>1)
                return $data;
            else
                return  $query->fetch(PDO::FETCH_ASSOC);
        }
        catch (Exception $e) {
            echo $e;
            die("Impossible de se connecter à la base ". $e->getMessage());
            
        }
    }

     /**
     * 
     */
    function Inserte($sql){
        try{
            $query = $db->prepare($sql);
    
            $query->execute($data);
            return true;
        }
        catch (Exception $e) {
            echo $e;
            die("Impossible de se connecter à la base ". $e->getMessage());
           
            return false;
        }
    }
}