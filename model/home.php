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
        for ($y=0; $y < count($lsmedia); $y++){
            $affichage .='    <div class="panel-thumbnail"><img src="media/img/'.$lsmedia[$y]["nomFichierMedia"].'" class="img-responsive"></div>';
        }
        $affichage .='    <div class="panel-body">';
        $affichage .='        <p class="lead">'.$lsPost[$i]["modificationDate"].'</p>';
        $affichage .='        <p>'.$lsPost[$i]["commentaire"].'</p>';
        $affichage .='        <p>';
        $affichage .='        <img src="css/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">';
        $affichage .='        </p>';
        $affichage .='    </div>';
        $affichage .='</div>';
    }
    
    return $affichage;
}