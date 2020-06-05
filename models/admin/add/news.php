<?php
    header("Content-Type:application/json");
    if(isset($_POST["add"])){
        require_once "../../../config/connection.php";
        require_once "../function.php";
        $errors=[];
        $newsParams=[];
        $messageRegex = "/^[A-zšđčćžŠĐČŽĆ0-9\s\?\.\,\!\"\']{2,}$/";
        $newsHeaderRegex="/^[A-ZŠĐČŽĆ][a-zšđčžć\s\?\!\.]{1,59}$/";
        $newsDescRegex = "/^[A-ZŠĐČŽĆ][a-zšđčžć\s\?\!\.]{1,199}$/";
        $imageRegex = "/^image\/(jpeg|jpg|png)$/";
        $allowImgFormats=["jpeg","png","jpg"];
        if(isset($_POST["header"])){
            $header=$_POST["header"];
            if(!preg_match($newsHeaderRegex,$header)){
                $errors[]="Naslov nije u dobrom formatu";
            }
            else{
                $newsParams[]=$header;
            }
        }
        else{
            $errors[]="Morate uneti naslov vesti";
        }
        if(isset($_POST["desc"])){
            $desc=$_POST["desc"];
            if(!preg_match($newsDescRegex,$desc)){
                $errors[]="Opis nije u dobrom formatu";
            }
            else{
                $newsParams[]=$desc;
            }
        }
        else{
            $errors[]="Morate uneti kratki opis vesti";
        }
        if(isset($_POST["text"])){
            $text=$_POST["text"];
            if(!preg_match($messageRegex,$text)){
                $errors[]="Tekst vesti ne sme biti prazan";
            }
            else{
                $newsParams[]=$text;
            }
        }
        else{
            $errors[]="Tekst vesti ne sme biti prazan";
        }
        if(isset($_POST["category"])){
            $category=$_POST["category"];
            $newsParams[]=$category;
        }
        else{
            $errors[]="Morate izabrati kategoriju";
        }
        if(isset($_POST["author"])){
            $author=$_POST["author"];
            $newsParams[]=$author;
        }
        else{
            $errors[]="Morate izabrati autora";
        }
        if(isset($_FILES["image"])){
            $fileType=explode("/",$_FILES["image"]["type"])[1];
            if(!in_array($fileType,$allowImgFormats)){
                $errors[]="Format slike nije dobar.Molimo vas izaberite drugi format.";
            }
            else{
                $tmpPath=$_FILES["image"]["tmp_name"];
                $originalName=explode(".",$_FILES["image"]["name"])[0];
                $uploadDir="../../../assets/images/";
                $newName=$originalName."_".time();
                $newPath=$uploadDir.$newName.".".$fileType;
            }
            //if(!preg_match())
            //$tmpPath=$_FILES["tmp_path"]
        }
        else{
            $errors[]="Morate izabrati sliku";
        }
        if(!count($errors)){
            $insertNewsQuery="INSERT INTO vesti(naslov,opis,tekst,kat_id,autor_id) VALUES(?,?,?,?,?)";
            $newsPrepare=$conn->prepare($insertNewsQuery);
            for($i=0;$i<count($newsParams);$i++){
                $newsPrepare->bindParam($i+1,$newsParams[$i]);
            }
            try{
                $newsPrepare->execute();
                $newsId=$conn->lastInsertId();
                $uploadImage=move_uploaded_file($tmpPath,$newPath);
                if(!$uploadImage){
                    $errors[]="DOšlo je do greške prilikom upload-a slike.";
                    echo json_encode($errors);
                }
                else{
                    $imagesResampled=makeImages($newPath,$fileType,$uploadDir);
                    $coverSrc=$imagesResampled["cover"];
                    $thumSrc=$imagesResampled["thumbnail"];
                    $imageInsert="INSERT INTO slike(src,alt,tip_id,vest_id) VALUES(:srcCover,:altCover,1,:newsId),(:srcThumb,:altThumb,2,:newsId)";
                    $imagePrepare=$conn->prepare($imageInsert);
                    $imagePrepare->bindParam(":srcCover",$coverSrc);
                    $imagePrepare->bindParam(":altCover",$coverSrc);
                    $imagePrepare->bindParam(":srcThumb",$thumSrc);
                    $imagePrepare->bindParam(":altThumb",$thumSrc);
                    $imagePrepare->bindParam(":newsId",$newsId);
                    $imagePrepare->execute();
                    http_response_code(200);
                    echo json_encode("index.php?page=singleNews&id=$newsId");
                }
            }
            catch(PDOException $e){
                http_response_code(500);
                echo json_encode($e);
            }
        }
        else{
            http_response_code(400);
            echo json_encode($errors);
        }
    }
    else{
        http_response_code(400);
        echo json_encode("Zahtev nije u dobrom formatu");
    }
?>