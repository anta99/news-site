<?php
    header("Content-Type:application/json");
    $errors=[];
    if(isset($_POST["addComment"])){
        
        require_once "../../config/connection.php";
        require_once "function.php";
        
        if(isset($_POST["reply"]) && !empty($_POST["reply"])){
            $reply=$_POST["reply"];
        }
        else{
            $errors=["Komentar ne sme biti prazan"];
        }
        if(isset($_POST["user"])){
            $userId=$_POST["user"];
        }
        else{
            $errors[]="Morate biti ulogovani";
        }
        if(isset($_POST["newsId"])){
            $newsId=$_POST["newsId"];
        }
        else{
            $errors[]="Vest ne psotojhi";
        }
        if(isset($_POST["parentComment"])){
            $parentComment=$_POST["parentComment"];
        }
        else{
            $parentComment=NULL;
        }
        if(!count($errors)){
            $query="INSERT INTO komentari(vest_id,tekst,kor_id,roditelj_id) VALUES(:newsId,:reply,:userId,:parent)";
            $prepare=$conn->prepare($query);
            $prepare->bindParam(":newsId",$newsId);
            $prepare->bindParam(":reply",$reply);
            $prepare->bindParam(":userId",$userId);
            $prepare->bindParam(":parent",$parentComment);
            try{
                $prepare->execute();
                $allComments=getComments($newsId);
                $allReplies=getAllReplies($newsId);
                $commentCounts=countComments($newsId);
                http_response_code(200);
                echo json_encode(["comments"=>$allComments,"replies"=>$allReplies,"commentsCount"=>$commentCounts]);
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
        $errors[]="Zahtev nije u dobarom formatu";
        echo json_encode($errors);
    }
?>