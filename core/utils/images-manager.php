<?php
 function createPictFromPict($pFile, $pId, $pW, $pH, $pBaseName){
    //1 Récupération de l'extention du fichier
    $ext = pathinfo($pFile['name'], PATHINFO_EXTENSION);
    //2 Creation d'une image à partir de l'original
    if(strtolower($ext)=="jpg" || strtolower($ext)=="jpeg"){
        $imageCopy = imagecreatefromjpeg($pFile['tmp_name']);
    }
    if(strtolower($ext)=="png"){
        $imageCopy = imagecreatefrompng($pFile['tmp_name']);
    }
    //3 Analyse du ratio de reduction/agrandissement à appliquer à l'image
    list($originalWidth, $originalHeight) = getimagesize($pFile['tmp_name']);
    $ratio = $originalWidth/$pW;
    if($originalHeight/$ratio>$pH){
        $ratio = $originalHeight/$pH;
    }
    $newWidth = floor($originalWidth/$ratio);
    $newHeight = floor($originalHeight/$ratio);
    echo "coucou";
    echo "je suis la GD";
    //4 Création d'une image "vide" dans laquelle coller l'originale redimensionnée
    $finalImg = imagecreatetruecolor($pW, $pH);
    //On rempli l'image de blanc
    $whiteBg = imagecolorallocate($finalImg,255,255,255);
    imagefill($finalImg,0,0,$whiteBg);
    //On colle l'original resizé
    imagecopyresampled($finalImg, $imageCopy, ($pW-$newWidth)/2,($pH-$newHeight)/2,0,0,$newWidth, $newHeight, $originalWidth, $originalHeight);
    //Sauvegarde en png
    imagepng($finalImg, '../../images/contents/'.$pBaseName.'_'.$pId.'.png');
    return $pBaseName.'_'.$pId.'.png';
 }
?>