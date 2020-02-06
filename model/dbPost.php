<?php
class Post{
    private $dataBase = 0;

    function __construct($db){
        echo "Construct";
        $this->$dataBase = $db;
    }

    function InsertPost($commentaire, $creationDate){
        $sql = "INSERT INTO `post`(`commentaire`, `creationDate`, `modificationDate`) 
        VALUES (:commentaire, :creationDate, '0-0-0')";
        $data=[":commentaire"=> $commentaire, 
        ":creationDate"=> $creationDate];
        return $dataBase->Insert($sql, $data);
    }

    function ReadAllPost(){
        $sql = "SELECT `idPost`, `commentaire`, `creationDate`, `modificationDate` FROM `post`";
        $data = [];
        return $dataBase->Select($sql, $data);
    }

    function ReadPostById($id){
        $sql = "SELECT `idPost`, `commentaire`, `creationDate`, `modificationDate` FROM `post` WHERE idPost = :id";
        $data = [":id" => $id];
        return $dataBase->Select($sql, $data);
    }
    
    function ReadPostByCommentaire($commentaire){
        $sql = "SELECT `idPost`, `commentaire`, `creationDate`, `modificationDate` FROM `post` WHERE commentaire = :commentaire";
        $data = [":commentaire" => $commentaire];
        return $dataBase->Select($sql, $data);
    }

    function EditPostById($id, $commentaire, $creationDate){
        $sql = "UPDATE `facebook`.`post` SET `commentaire`=:commentaire, modificationDate=:creationDate WHERE `idPost`=:id;";
        $data = [":id" => $id,
        ":commentaire"=> $commentaire, 
        ":creationDate"=> $creationDate];
        return $dataBase->Insert($sql, $data);
    }
}