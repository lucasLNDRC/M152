<?php
class Media{
    function InsertMedia($idPost, $creationDate){
        $sql = "INSERT INTO `media`(`idPost`, `creationDate`, `modoficationDate`) 
        VALUES (:idPost, :creationDate, '0-0-0')";
        $data=[":idPost"=> $idPost, 
        ":creationDate"=> $creationDate];
        return $db->Insert($sql, $data);
    }

    function ReadAllMedia(){
        $sql = "SELECT `idMedia`, `commentaire`, `creationDate`, `modoficationDate`,idPost FROM `media`";
        $data = [];
        return $db->Select($sql, $data);
    }

    function ReadMediaByIdMedia($id){
        $sql = "SELECT `idMedia`, `commentaire`, `creationDate`, `modoficationDate`,idPost FROM `media` WHERE idMedia = :id";
        $data = [":id" => $id];
        return $db->Select($sql, $data);
    }

    function EditMediaByIdMedia($idMedia, $idPost, $modoficationDate){
        $sql = "UPDATE `facebook`.`media` SET `idPost`=:idPost, modoficationDate=:modoficationDate WHERE `idMedia`=:idMedia;";
        $data = [":idMedia" => $idMedia,
        ":idPost"=> $idPost, 
        ":modoficationDate"=> $modoficationDate];
        return $db->Insert($sql, $data);
    }
}