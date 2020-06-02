<?php
    header("Content-Type:applicaition/json");
    if(isset($_POST["change"])){
        require_once "../../config/connection.php";
        $passwordRegex="/^[A-z0-9\.\?\,\s\!\@\#]{8,50}$/";
        $errors=[];
        if(isset($_POST["userId"])){
            $id=$_POST["userId"];
            $getOldPassword="SELECT sifra FROM korisnici WHERE id=:id";
            $prepare=$conn->prepare($getOldPassword);
            $prepare->bindParam(":id",$id);
            $prepare->execute();
            $existPassword=$prepare->fetch();
        }
        if(isset($_POST["oldPassword"])){
            $oldPassword=$_POST["oldPassword"];
            if(!preg_match($passwordRegex,$oldPassword) || $existPassword[0]!=md5($oldPassword)){
                $errors["old"]="Lozinka nije ispravna";
            }
        }
        if(isset($_POST["newPassword"])){
            $newPassword=$_POST["newPassword"];
            if(!preg_match($passwordRegex,$newPassword)){
                $errors["new"]="Molimo vas ispravo popunite ovo polje";
            }
        }
        if(isset($_POST["confirmPass"])){
            $confirm=$_POST["confirmPass"];
            if($confirm!=$newPassword || !preg_match($passwordRegex,$confirm)){
                $errors["confirm"]="Molimo vas ispravo popunite ovo polje";
            }
        }
        if(!count($errors)){
            $updateQuery="UPDATE korisnici SET sifra=:newPassword WHERE id=:id";
            $prepareUpdate=$conn->prepare($updateQuery);
            $hasedPassword=md5($newPassword);
            $prepareUpdate->bindParam(":newPassword",$hasedPassword);
            $prepareUpdate->bindParam(":id",$id);
            try{
                $prepareUpdate->execute();
                if($prepareUpdate->rowCount()==1){
                    http_response_code(204);
                }
                else{
                    http_response_code(400);
                    $errors["updateErr"]="Došlo je do greške";
                    echo json_encode($errors);
                }
            }
            catch(PDOException $e){
                http_response_code(500);
                $errors["updateErr"]="Došlo je do greške";
                echo json_encode($errors);
            }
        }
        else{
            http_response_code(400);
            echo json_encode($errors);
        }
    }
    else{
        http_response_code(400);
        echo json_encode("Zahtev nije dobar");
    }
?>