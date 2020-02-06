<?php
$btn= filter_input(INPUT_POST, "post");

$commentaire = filter_input(INPUT_POST, "commentaire");
$filesToUploads = filter_input(INPUT_POST, "fileToUpload[]");
$erreur = [];

if ($btn == "post"){
    $post = new Post($db);
    $date = date("Y-m-d");
    $post->InsertPost($commentaire, $date);
    $newpost = $post->ReadPostByCommentaire($commentaire, $date);
    
    if(isset($_FILES) && is_array($_FILES) && count($_FILES)>0) {
        try{
        // Raccourci d'écriture pour le tableau reçu
        $fichiers = $_FILES['fileToUpload'];

        // Boucle itérant sur chacun des fichiers
        for($i=0;$i<count($fichiers['name']);$i++){
            // Nettoyage du nom de fichier
            $nom_fichier = preg_replace('/[^a-z0-9\.\-]/
            i','',$fichiers['name'][$i]);
            
            // Si le type MIME correspond à une image, Déplacement depuis le répertoire temporaire et on l’affiche
            if(in_array($fichiers['type'][$i], ["image/png", "image/gif", "image/jpeg"]) && $fichiers['size'][$i] < 24000000) {              
                move_uploaded_file($fichiers['tmp_name'][$i],'media/img/'.$nom_fichier);

            }
            else{
                $erreur["size"] = "<span style='color:red;'>la taille est trop grande</span>";
                $post->DeletePost($newpost["idPost"]);
            }
            
        }
    }
    catch(Exception $e){echo "doesn't work ".$e;}
    }
}