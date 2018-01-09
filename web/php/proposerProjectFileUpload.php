<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 09/01/2018
 * Time: 14:51
 */

//Pour chaque donnée dans les imagesData retournée
foreach($_POST['imageDatas'] as $key => $oneImageData){
    if($oneImageData[0]=="image"){
        $isGIF = false;
        header('Content-Type: image/png');
        define('UPLOAD_DIR', '../uploads/project/img/');
        $img = $oneImageData[1];

        //test de l'extension de l'image pour enlenver une partie incomprise par base64_decode
        if(strpos($img, 'data:image/png;base64') !== false){
            $img = str_replace('data:image/png;base64,', '', $img);
        }elseif(strpos($img, 'data:image/jpeg;base64') !== false){
            $img = str_replace('data:image/jpeg;base64,', '', $img);
        }elseif(strpos($img, 'data:image/jpg;base64') !== false){
            $img = str_replace('data:image/jpg;base64,', '', $img);
        }elseif(strpos($img, 'data:image/gif;base64') !== false){
            $img = str_replace('data:image/gif;base64,', '', $img);
            $isGIF = true;
        }else{

        }

        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        //On écrit le chemin avec le nom de l'image.
        $oneImageData[1] = UPLOAD_DIR . $_POST['imageDatas'][1][1];

        file_put_contents($oneImageData[1], $data);
    }

}
