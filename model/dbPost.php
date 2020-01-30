<?php
class Post{
    function InsertPost($commentaire, $creationDate){
        $sql = "INSERT INTO `post`(`commentaire`, `creationDate`, `modoficationDate`) 
        VALUES (:commentaire, :creationDate, '0-0-0')";
        $data=[":commentaire"=> $commentaire, 
        ":creationDate"=> $creationDate];
        return $db->Insert($sql, $data);
    }

    function ReadAllPost(){
        $sql = "SELECT `idPost`, `commentaire`, `creationDate`, `modoficationDate` FROM `post`";
        $data = [];
        return $db->Select($sql, $data);
    }

    function ReadPostById($id){
        $sql = "SELECT `idPost`, `commentaire`, `creationDate`, `modoficationDate` FROM `post` WHERE idPost = :id";
        $data = [":id" => $id];
        return $db->Select($sql, $data);
    }
    
    function ReadPostByCommentaire($commentaire){
        $sql = "SELECT `idPost`, `commentaire`, `creationDate`, `modoficationDate` FROM `post` WHERE commentaire = :commentaire";
        $data = [":commentaire" => $commentaire];
        return $db->Select($sql, $data);
    }

    function EditPostById($id, $commentaire, $creationDate){
        $sql = "UPDATE `facebook`.`post` SET `commentaire`=:commentaire, modoficationDate=:creationDate WHERE `idPost`=:id;";
        $data = [":id" => $id,
        ":commentaire"=> $commentaire, 
        ":creationDate"=> $creationDate];
        return $db->Insert($sql, $data);
    }
}