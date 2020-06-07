<?php
    header("Content-Type:application/json");
    if(isset($_POST["deleteNews"])){
        require_once "../../../config/connection.php";
        if(isset($_POST["deleteId"])){
            $deleteId=$_POST["deleteId"];
        }
        else{
            http_response_code(400);
            echo json_encode("Zahtev nije u dobrom formatu");
        }
        if(isset($_POST["page"])){
            $page=$_POST["page"];
        }
        else{
            http_response_code(400);
            echo json_encode("Zahtev nije u dobrom formatu");
        }
        $deleteQuery="DELETE FROM vesti WHERE id=:id";
            $prepare=$conn->prepare($deleteQuery);
            $prepare->bindParam(":id",$deleteId);
            try{
                $prepare->execute();
                http_response_code(200);
                $newNews=filterNews($page,[]);
                if(!count($newNews["news"])){
                    $newNews2=filterNews($page-1,[]);
                    echo json_encode($newNews2);
                }
                else{
                    echo json_encode($newNews);
                }
            }
            catch(PDOException $e){
                http_response_code(500);

                echo json_encode(["err"=>"Došlo je do greške","baza"=>$e]);
            }
    }
    else{
        http_response_code(400);
        echo json_encode("Zahtev nije u dobrom formatu");
    }
?>