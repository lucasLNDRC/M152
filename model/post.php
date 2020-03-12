<?php
$btn= filter_input(INPUT_POST, "post");

$commentaire = filter_input(INPUT_POST, "commentaire");
$erreur = [];
if ($btn){
    Db::$db->beginTransaction();
    $post = new Post($db);

    $date = date("Y-m-d");
    
    if (!isset($post->ReadPostByCommentaire($commentaire, $date)["idPost"])){
        $work = true;
        $post->InsertPost($commentaire, $date);

        $newpost = $post->ReadPostByCommentaire($commentaire, $date);

        $media = new Media($db);
        $fichiers = $_FILES['fileToUpload'];
        try{
            if(isset($fichiers['name']))
            if(is_array($fichiers['name']) && count($fichiers['name'])>0) {
                // Boucle itérant sur chacun des fichiers
                for($i=0;$i<count($fichiers['name']);$i++){ 
                    // Nettoyage du nom de fichier
                    $nom_fichier = preg_replace('/[^a-z0-9\.\-]/
                    i','',$fichiers['name'][$i]);
                    
                    // Si le type MIME correspond à une image, Déplacement depuis le répertoire temporaire et on l’affiche
                    if(!in_array($fichiers['type'][$i], ["image/png", "image/gif", "image/jpeg", "video/mp4", "video/webm", "video/ogg", "audio/mp3", "audio/ogg", "audio/wav"])){
                        $work = false;
                        $erreur["type"] = "<span style='color:red;'>Le type n'est pas bon .</span>";
                        var_dump($fichiers);
                    }

                    if(in_array($fichiers['type'][$i], ["image/png", "image/gif", "image/jpeg"]))
                    if ($fichiers['size'][$i] > 24000000){
                        $work = false;
                        $erreur["size"] = "<span style='color:red;'>la taille est trop grande</span>";
                    }

                    if(isset($media->ReadMediaByNomFichierMedia($nom_fichier)["idMedia"])) {
                        $work = false;
                        $erreur["exist"] = "<span style='color:red;'>le fichier existe deja</span>";
                    } 

                    if ($work){
                        if (in_array($fichiers['type'][$i], ["image/png", "image/gif", "image/jpeg"])){
                            $work = move_uploaded_file($fichiers['tmp_name'][$i],'media/img/'.$nom_fichier);
                        }
                        elseif (in_array($fichiers['type'][$i], ["video/mp4", "video/webm", "video/ogg"])) {
                            $work = move_uploaded_file($fichiers['tmp_name'][$i],'media/video/'.$nom_fichier);
                        }
                        elseif (in_array($fichiers['type'][$i], ["audio/mp3", "audio/ogg", "audio/wav"])) {
                            $work = move_uploaded_file($fichiers['tmp_name'][$i],'media/sound/'.$nom_fichier);
                        }
                        else
                            throw new Exception("Error Processing Request", 1);
                            
                        $creationDate = $date;
                        $idPost = $newpost["idPost"];
                        $media->InsertMedia($nom_fichier, $fichiers['type'][$i], $creationDate, $idPost);
                    }                            
                }
                
            }
        }catch(Exception $e){
            die("imposible d'uplode ". $e->getMessage());
            $work = false;
        }
        if (!$work){
            Db::$db->rollBack();

            for ($i=0;$i<count($fichiers['name']);$i++){
                $nom_fichier = preg_replace('/[^a-z0-9\.\-]/
                i','',$fichiers['name'][$i]);
                unlink($nom_fichier);
            }
            $erreur["move"] = "<span style='color:red;'>Le fichier n'a pas peu etre déplacer</span>";
        }
        else{
            Db::$db->commit();
            header('Location: index.php?action=home');
        }
    }
}
