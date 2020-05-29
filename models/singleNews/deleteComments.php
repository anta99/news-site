<?php
    if(isset($_POST["deleteComm"])){
        require_once "../../config/connection.php";
        require_once "function.php";
        header("Content-Type:application/json");
        if(isset($_POST["deleteId"])){
            $deleteId=$_POST["deleteId"];
            $deleteQuery="DELETE FROM komentari WHERE id=:id";
            $prepare=$conn->prepare($deleteQuery);
            $prepare->bindParam(":id",$deleteId);
            try{
                $prepare->execute();
                http_response_code(200);
                echo json_encode("Uspelo je sve");
            }
            catch(PDOException $e){
                http_response_code(500);
                echo json_encode($e);
            }
        }
        else{
            http_response_code(400);
            echo json_encode("Poslat zahtev nije u dobrom formatu!");
        }

    }
?>