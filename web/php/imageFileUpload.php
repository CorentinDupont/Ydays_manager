<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 09/01/2018
 * Time: 14:51
 */



$isGIF = false;
$uploadDir = $_POST['imageDatas'][0][1];
$img = $_POST['imageDatas'][1][1];
$imgName = $_POST['imageDatas'][2][1];

header('Content-Type: image/png');

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
$completePath = $uploadDir . $imgName;

file_put_contents($completePath, $data);



