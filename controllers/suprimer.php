<?php
require_once "model/dbPost.php";
require_once "model/dbMedia.php";

$idPost = filter_input(INPUT_POST, "supr");

if ($idPost){
    Db::$db->beginTransaction();
    $post = new Post($db);
    $media = new Media($db);
    $noError = true;

    $medias = $media->ReadMediaByIdPost($idPost);

    if (!$media->DeleteMediaByIdPost($idPost)) $noError = false;

    if (!$post->DeletePost($idPost)) $noError = false;

    if ($noError)
        Db::$db->commit();
    else{
        Db::$db->rollBack();
        header('Location: index.php?action=home&supr=supr');
        exit;
    }  
    
    foreach ($medias as $key => $value) {
        if (!DeleteMedia($value["idMedia"], $value["nomFichierMedia"], $value["typeMedia"])) $noError = false;
    }
    
     
}

header('Location: index.php?action=home');


function DeleteMedia($idMedia, $nameMedia, $typeMedia){
    $noError = true;
    if (in_array($typeMedia, ["image/png", "image/gif", "image/jpeg"])){
        $noError = unlink('media/img/'.$nameMedia);
    }
    elseif (in_array($typeMedia, ["video/mp4", "video/webm", "video/ogg"])) {
        $noError = unlink('media/video/'.$nameMedia);
    }
    elseif (in_array($typeMedia, ["audio/mp3", "audio/ogg", "audio/wav"])) {
        $noError = unlink('media/sound/'.$nameMedia);
    }
    else{
        $noError = false;
    }
    
    return $noError;
}