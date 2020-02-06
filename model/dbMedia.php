<?php
class Media{
    private $dataBase;

    function __construct($dbb){
        $this->dataBase = $dbb;
    }

    function InsertMedia( $nomFichierMedia, $typeMedia, $creationDate, $idPost){
        $sql = "INSERT INTO `facebook`.`Media` (`nomFichierMedia`, `typeMedia`, `creationDate`, `idPost`) 
        VALUES (:nomFichierMedia, :typeMedia, :creationDate, :idPost);";
        $data=[":idPost"=> $idPost, 
        ":creationDate"=> $creationDate, 
        ":nomFichierMedia"=> $nomFichierMedia, 
        ":typeMedia"=> $typeMedia];
        echo "good";
        return $this->dataBase->Insert($sql, $data);
    }

    function ReadAllMedia(){
        $sql = "SELECT `idMedia`, `nomFichierMedia`, `typeMedia`, `creationDate`, 'modoficationDate',`idPost` FROM `media`";
        $data = [];
        return $this->dataBase->Select($sql, $data);
    }

    function ReadMediaByIdMedia($id){
        $sql = "SELECT `idMedia`, `nomFichierMedia`, `typeMedia`, `creationDate`, 'modoficationDate',`idPost` FROM `media` WHERE idMedia = :id";
        $data = [":id" => $id];
        return $this->dataBase->Select($sql, $data);
    }

    function ReadMediaByIdPost($idPost){
        $sql = "SELECT `idMedia`, `nomFichierMedia`, `typeMedia`, `creationDate`, 'modoficationDate',`idPost` FROM `media` WHERE idPost = :id";
        $data = [":id" => $idPost];
        return $this->dataBase->Select($sql, $data);
    }

    function ReadMediaByNomFichierMedia($nomFichierMedia){
        $sql = "SELECT `idMedia`, `nomFichierMedia`, `typeMedia`, `creationDate`, 'modoficationDate',`idPost` FROM `media` WHERE nomFichierMedia = :nomFichierMedia";
        $data = [":nomFichierMedia" => $nomFichierMedia];
        return $this->dataBase->Select($sql, $data);
    }

    function EditMediaByIdMedia($idMedia, $idPost, $modoficationDate){
        $sql = "UPDATE `facebook`.`media` 
        SET `idPost`=:idPost, modoficationDate=:modoficationDate, nomFichierMedia=:nomFichierMedia, typeMedia=:typeMedia
        WHERE `idMedia`=:idMedia;";
        $data=[":idPost"=> $idPost,
        ":nomFichierMedia"=> $nomFichierMedia,
        ":typeMedia"=> $typeMedia,
        ":idMedia" => $idMedia];
        return $this->dataBase->Insert($sql, $data);;
    }
}