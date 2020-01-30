<?php

$btn= filter_input(INPUT_POST, "post");

$commentaire = filter_input(INPUT_POST, "commentaire");
//$filesToUploads = filter_input(INPUT_POST, "fileToUpload[]");
$btn = filter_input(INPUT_POST, "post");

if ($btn == "post"){
    $post = new post;
    $post->InsertPost($commentaire, "Now()");
    $newpost = $post->ReadPostByCommentaire($commentaire);

    if(isset($_FILES) && is_array($_FILES) && count($_FILES)>0) {
        // Raccourci d'écriture pour le tableau reçu
        $fichiers = $_FILES['fileToUpload[]"'];
        // Boucle itérant sur chacun des fichiers
        for($i=0;$i<count($fichiers['name']);$i++){
            // Affichage d’informations diverses
            echo '<p>';
            echo 'Fichier '.$fichiers['name'][$i].' reçu';
            echo '<br>';
            echo 'Type '.$fichiers['type'][$i];
            echo '<br>';
            echo 'Taille '.$fichiers['size'][$i].' octets';
            // Nettoyage du nom de fichier
            $nom_fichier = preg_replace('/[^a-z0-9\.\-]/
            i','',$fichiers['name'][$i]);
            // Déplacement depuis le répertoire temporaire
            move_uploaded_file($fichiers['tmp_name'][$i],'uploads/
            '.$nom_fichier);
            
            // Si le type MIME correspond à une image, on l’affiche
            if(preg_match('/image/',$fichiers['type'][$i])) {
                echo '<br><img src="uploads/'.$nom_fichier.'">';
            }
            echo '</p>';
        }
    }
    
/*
    if($imageFileType != "png" && $imageFileType != "jpg" ) {
        echo "Sorry, only png, jpg files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // file upload
            header("Location: index.php");
        } 
        else {
            $erreur["upload"] = "Desolé le fichier n'a pas peut etre upload réessayez maintenent ou plus tard.";
        }
    }

*/
}