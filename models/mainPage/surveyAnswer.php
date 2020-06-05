<?php
    header("Content-Type:application/json");
    if(isset($_POST["vote"])){
        require_once "../../config/connection.php";
        $errors=[];
        if(isset($_POST["answer"])){
            $answer=$_POST["answer"];
        }
        else{
            $errors[]="Morate izabrati neki odgovor";
        }
        if(isset($_POST["userId"])){
            $userId=$_POST["userId"];
        }
        else{
            $errors[]="Morate biti prijavljeni da biste glasali";
        }
        if(!count($errors)){
            $alreadyVoted="SELECT * FROM korisnik_odgovor ko INNER JOIN odgovori o ON o.id=ko.odg_id WHERE kor_id=:user AND o.anketa_id=(SELECT id FROM anketa WHERE aktivna=1)";
            $prepare=$conn->prepare($alreadyVoted);
            $prepare->bindParam(":user",$userId);
            $prepare->execute();
            if($prepare->rowCount()!=0){
                http_response_code(400);
                $errors[]="Već ste učestvovali u ovoj anketi";
                echo json_encode($errors);
            }
            else{
                $insertQuery="INSERT INTO korisnik_odgovor(kor_id,odg_id) VALUES(:user,:answer)";
                $prepareInsert=$conn->prepare($insertQuery);
                $prepareInsert->bindParam(":user",$userId);
                $prepareInsert->bindParam(":answer",$answer);
                try{
                    $prepareInsert->execute();
                    http_response_code(201);
                    echo json_encode("Hvala za učešće u anketi");
                }
                catch(PDOException $e){
                    http_response_code(500);
                    $errors[]="Došlo je do greške";
                    $errors[]=$e;
                    echo json_encode($errors);
                }
            }
        }
        else{
            http_response_code(400);
            echo json_encode($errors);
        }
    }
    else{
        http_response_code(400);
        echo json_encode("Morate biti prijavljeni");
    }
?>