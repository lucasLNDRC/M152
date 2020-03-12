<?php

$idPost = filter_input(INPUT_POST, "mod");
Db::$db->beginTransaction();
$post = new Post($db);
$media = new Media($db);
$noError = true;

$medias = $media->ReadMediaByIdPost($idPost);
$afficherMedia = AfficheMedia($medias);

// if ($idPost){


//     if (!$media->DeleteMediaByIdPost($idPost)) $noError = false;

//     if (!$post->DeletePost($idPost)) $noError = false;

//     if ($noError)
//         Db::$db->commit();
//     else{
//         Db::$db->rollBack();
//         header('Location: index.php?action=home&supr=supr');
//         exit;
//     }  
    
//     foreach ($medias as $key => $value) {
//         if (!DeleteMedia($value["idMedia"], $value["nomFichierMedia"], $value["typeMedia"])) $noError = false;
//     }
    
     
// }

// header('Location: index.php?action=home');


function DeleteMedia($idMedia, $nameMedia, $typeMedia){
    $noError = true;
    if (in_array($typeMedia, ["image/png", "image/gif", "image/jpeg"])){
        $noError = unlink('media/img/'.$nameMedia);
    }
    elseif (in_array($typeMedia, ["video/mp4", "video/webm", "video/ogg"])) {
        $noError = unlink('media/video/'.$nameMedia);
    }
    elseif (in_array($typeMedia, ["audio/mpeg", "audio/ogg", "audio/wav"])) {
        $noError = unlink('media/sound/'.$nameMedia);
    }
    else{
        $noError = false;
    }
    
    return $noError;
}

function AfficheMedia($dataMedia){
    
    $htmlMedia ="";
    for ($i=0; $i < count($dataMedia) ; $i++) {
        if (in_array($dataMedia[$i]["typeMedia"], ["image/png", "image/gif", "image/jpeg"])){
            $htmlMedia .='<div class="panel-thumbnail"><img src="media/img/'.$dataMedia[$i]["nomFichierMedia"].'" class="img-responsive"></div>';
        }
        elseif (in_array($dataMedia[$i]["typeMedia"], ["video/mp4", "video/webm", "video/ogg"])) {
            $htmlMedia .='<div class="panel-thumbnail"><video id="'.$dataMedia[$i]["nomFichierMedia"].'" onload="videoPlay(\''.$dataMedia[$i]["nomFichierMedia"].'\')" width="98%" autoplay loop>
            <source src="media/video/'.$dataMedia[$i]["nomFichierMedia"].'" type="'.$dataMedia[$i]["typeMedia"].'">
            Your browser does not support the video tag.
             </video></div>';
        }
        elseif (in_array($dataMedia[$i]["typeMedia"], ["audio/mp3", "audio/ogg", "audio/wav"])) {
            $htmlMedia .='<div class="panel-thumbnail"><audio controls>
            <source src="media/sound/'.$dataMedia[$i]["nomFichierMedia"].'" type="'.$dataMedia[$i]["typeMedia"].'">
            Your browser does not support the audio element.
           </audio></div>';
        }
        else{
            $htmlMedia .='<div class="panel-thumbnail"><p>File not found<p></div>';
        }
    }
    return $htmlMedia;
}