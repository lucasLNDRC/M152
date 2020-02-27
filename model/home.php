<?php
/**
 * 
 */

/**
 * 
 */
function AfficherPost($limit, $offset=0){
    global $db;
    $affichage = "";
    $post = new Post($db);
    $media = new Media($db);
    $lsPost = $post->ReadPost($limit, $offset);
    for ($i=0; $i < count($lsPost); $i++) {
        $lsmedia = $media->ReadMediaByIdPost($lsPost[$i]["idPost"]);
        $affichage .='<div class="panel panel-default">';
        $affichage .= AfficheMedia($lsmedia);
        $affichage .='    <div class="panel-body">';
        $affichage .='        <p class="lead">'.$lsPost[$i]["modificationDate"].'</p>';
        $affichage .='        <p>'.$lsPost[$i]["commentaire"].'</p>';
        $affichage .='        <p>';
        $affichage .='        <img src="css/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">';
        $affichage .='        </p>';
        $affichage .='<form action="?action=Mod" method="post"><button name="mod" value="mod">Modifier</button> </form>
                      <form action="?action=Supr" method="post"><button name="supr" value="supr">Suprimer</button></form>';
        $affichage .='    </div>';
        $affichage .='</div>';
    }
    
    return $affichage;
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
        elseif (in_array($dataMedia[$i]["typeMedia"], ["audio/mpeg", "audio/ogg", "audio/wav"])) {
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