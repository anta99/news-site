<?php
    function getAllAuthors(){
        global $conn;
        $query="SELECT CONCAT(k.ime,' ',k.prezime) as name,a.* FROM autori a INNER JOIN korisnici k ON a.kor_id=k.id";
        return executeQuery($query);
    }
    function makeImages($imageSrc,$imgType,$uploadDir){
        $canvasCover=imagecreatetruecolor(1800,600);
        $canvasThumbnail=imagecreatetruecolor(420,280);
        if($imgType=="png"){
            $uploadedImage=imagecreatefrompng($imageSrc);
        }
        else{
            $uploadedImage=imagecreatefromjpeg($imageSrc);
        }
        $imageSize=getimagesize($imageSrc);
        $width=$imageSize[0];
        $height=$imageSize[1];
        $imagePathArr=explode("/",$imageSrc);
        $oldName=explode(".",end($imagePathArr));
        $newNameCover=$oldName[0]."_cover".".".$oldName[1];
        $newNameThumbnail=$oldName[0]."thumbnail".".".$oldName[1];
        imagecopyresampled($canvasCover,$uploadedImage,0,0,0,0,1800,600,$width,$height);
        imagecopyresampled($canvasThumbnail,$uploadedImage,0,0,0,0,420,280,$width,$height);
        if($imgType=="png"){
            imagepng($canvasCover,$uploadDir.$newNameCover);
            imagepng($canvasThumbnail,$uploadDir.$newNameThumbnail);
        }
        else{
            imagejpeg($canvasCover,$uploadDir.$newNameCover);
            imagejpeg($canvasThumbnail,$uploadDir.$newNameThumbnail);
        }
        return ["cover"=>$newNameCover,"thumbnail"=>$newNameThumbnail];
    }
    function getAllTags(){
        return executeQuery("SELECT * FROM tagovi");
    }
?>