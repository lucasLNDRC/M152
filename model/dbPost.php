<?php
class Post{
    private $dataBase;

    function __construct($dbb){
        $this->dataBase = $dbb;
    }

    function InsertPost($commentaire, $creationDate){
        $sql = "INSERT INTO `post`(`commentaire`, `creationDate`, `modificationDate`) 
        VALUES (:commentaire, :creationDate, '0-0-0')";
        $data=[":commentaire"=> $commentaire, 
        ":creationDate"=> $creationDate];

        return $this->dataBase->Insert($sql, $data);;
    }

    function ReadAllPost(){
        $sql = "SELECT `idPost`, `commentaire`, `creationDate`, `modificationDate` FROM `post`";
        $data = [];
        return $this->dataBase->Select($sql, $data);
    }

    function ReadPostById($id){
        $sql = "SELECT `idPost`, `commentaire`, `creationDate`, `modificationDate` FROM `post` WHERE idPost = :id";
        $data = [":id" => $id];
        return $this->dataBase->Select($sql, $data);
    }
    
    function ReadPostByCommentaire($commentaire, $creationDate){
        $sql = "SELECT `idPost`, `commentaire`, `creationDate`, `modificationDate` FROM `post` WHERE commentaire = :commentaire and creationDate = :creationDate";
        $data = [":commentaire" => $commentaire, ":creationDate" => $creationDate];
        return $this->dataBase->Select($sql, $data);
    }

    function EditPostById($id, $commentaire, $creationDate){
        $sql = "UPDATE `facebook`.`post` SET `commentaire`=:commentaire, modificationDate=:creationDate WHERE `idPost`=:id;";
        $data = [":id" => $id,
        ":commentaire"=> $commentaire, 
        ":creationDate"=> $creationDate];
        return $this->dataBase->Insert($sql, $data);
    }

    function DeletePost($id){
        $sql = "DELETE FROM `facebook`.`post` WHERE `idPost`= :id;";
        $data=[":id"=> $id];

        return $this->dataBase->Insert($sql, $data);;
    }
}