<?php
    header("Content-Type:application/json");
    if(isset($_POST["add"])){
        require_once "../../../config/connection.php";
        require_once "../function.php";
        $errors=[];
        $newsParams=[];
        $tagsNews=false;
        $tagTable=false;
        $messageRegex = "/^[A-zšđčćžŠĐČŽĆ0-9\s\?\.\,\!\"\'\-\)\(\:]{2,}$/";
        $newsHeaderRegex="/^[A-ZŠĐČŽĆ][A-zŠĐČŽĆšđčćž\s\,\.\!\?\-\-\)\(\:]{0,59}$/";
        $newsDescRegex = "/^[A-ZŠĐČŽĆ][A-zŠĐČŽĆšđčžć\s\?\!\.0-9\"\'\-\)\(\:]{1,199}$/";
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
        if(!isset($_POST["tags"]) && !isset($_POST["newTags"])){
            $errors[]="Morate izabrati tag";
        }
        else{
            if(isset($_POST["tags"])){
                $tag=json_decode($_POST["tags"]);
                $tagsNews=true;
            }
            if(isset($_POST["newTags"])){
                $newTags=json_decode($_POST["newTags"]);
                $tagTable=true;
            }
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
                $conn->beginTransaction();
                $newsPrepare->execute();
                $newsId=$conn->lastInsertId();
                $uploadImage=move_uploaded_file($tmpPath,$newPath);
                if(!$uploadImage){
                    $errors[]="Došlo je do greške prilikom upload-a slike.";
                    http_response_code(500);
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

                    //Insert tags
                    if($tagsNews){
                        $insertTags="INSERT INTO tag_vest(id_tag,id_vest) VALUES(:tagId,:newsId)";
                        $prepareTags=$conn->prepare($insertTags);
                        foreach($tag as $t){
                            $prepareTags->bindParam(":tagId",$t);
                            $prepareTags->bindParam(":newsId",$newsId);
                            $prepareTags->execute();
                        }
                    }
                    if($tagTable){
                        $newTagQuery="INSERT INTO tagovi(naziv) VALUES(:name)";
                        $newTagPrepare=$conn->prepare($newTagQuery);
                        foreach($newTags as $new){
                            $newTagPrepare->bindParam(":name",$new);
                            $newTagPrepare->execute();
                            $newTagId=$conn->lastInsertId();
                            $tagNewsTableInsert="INSERT INTO tag_vest(id_tag,id_vest) VALUES(:tag,:news)";
                            $tnti=$conn->prepare($tagNewsTableInsert);
                            $tnti->bindParam(":tag",$newTagId);
                            $tnti->bindParam(":news",$newsId);
                            $tnti->execute();
                        }
                    }
                    $conn->commit();
                    http_response_code(200);
                    echo json_encode("index.php?page=singleNews&id=$newsId");
                }
            }
            catch(PDOException $e){
                $conn->rollback();
                http_response_code(500);
                $errors[]="Došlo je do greške";
                echo json_encode($errors);
                //echo json_encode($e);
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