<?php
$btn= filter_input(INPUT_POST, "post");

$commentaire = filter_input(INPUT_POST, "commentaire");
$erreur = [];
if ($btn == "post"){
    $post = new Post($db);

    $date = date("Y-m-d");
    
    if (!isset($post->ReadPostByCommentaire($commentaire, $date)["idPost"])){
  
        $post->InsertPost($commentaire, $date);

        $newpost = $post->ReadPostByCommentaire($commentaire, $date);

        $media = new Media($db);
        var_dump($media);
        $fichiers = $_FILES['fileToUpload'];
        if(isset($fichiers['name']) && is_array($fichiers['name']) && count($fichiers['name'])>0) {
            try{
            // Boucle itérant sur chacun des fichiers
            for($i=0;$i<count($fichiers['name']);$i++){
                // Nettoyage du nom de fichier
                $nom_fichier = preg_replace('/[^a-z0-9\.\-]/
                i','',$fichiers['name'][$i]);
                
                // Si le type MIME correspond à une image, Déplacement depuis le répertoire temporaire et on l’affiche
                if(in_array($fichiers['type'][$i], ["image/png", "image/gif", "image/jpeg"]) && $fichiers['size'][$i] < 24000000 && !isset(ReadMediaByNomFichierMedia($nom_fichier)["idMedia"])) {              
                    move_uploaded_file($fichiers['tmp_name'][$i],'media/img/'.$nom_fichier);
                    echo "ok";
                    $nomFichierMedia = $nom_fichier;
                    $typeMedia = "img";
                    $creationDate = $date;
                    $idPost = $newpost["idPost"];
                    $media->InsertMedia( $nomFichierMedia, $typeMedia, $creationDate, $idPost);
                }
                else
                {
                    $erreur["size"] = "<span style='color:red;'>la taille est trop grande</span>";
                    $post->DeletePost($newpost["idPost"]);
                }
                
            }
            }
            catch(Exception $e){echo "doesn't work ".$e;}
        }
    }
}
