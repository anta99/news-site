<?php
    header("Content-Type:application/json");
    if(isset($_POST["contact"])){
        require_once "../../config/connection.php";
        $contactNameRegex ="/^[A-ZŠĐČŽĆ][a-zšđčćž]{2,19}(\s[A-ZŠĐČŽĆ][a-zšđčćž]{2,19})*$/";
        $messageRegex = "/^[A-zšđčćžŠĐČŽĆ0-9\s\?\.\,\!\"\']{2,}$/";
        $emailRegex = "/^[a-z\.\!\?0-9]{4,40}\@[a-z0-9]{3,15}(\.[a-z0-9]{3,15})*\.[a-z]{2,3}$/";
        $errors=[];
        if(isset($_POST["name"])){
            $name=$_POST["name"];
            if(!preg_match($contactNameRegex,$name)){
                $errors[]="Ime nije u dobrom formatu";
            }
        }
        else{
             $errors[]="Morate uneti ime";
        }
        if(isset($_POST["email"])){
            $email=$_POST["email"];
            if(!preg_match($emailRegex,$email)){
                $errors[]="Email adresa nije u dobrom formatu";
            }
        }
        else{
             $errors[]="Morate uneti email adresu";
        }
        if(isset($_POST["message"])){
            $message=$_POST["message"];
            if(!preg_match($messageRegex,$message)){
                $errors[]="Poruka nije u dobrom formatu";
            }
        }
        else{
             $errors[]="Morate uneti poruku";
        }
        if(count($errors)){
            http_response_code(400);
            echo json_encode($errors);
        }
        else{
            $insertQuery="INSERT INTO mejlovi(ime_korisnika,mail,poruka) VALUES(:name,:mail,:message)";
            $prepare=$conn->prepare($insertQuery);
            $prepare->bindParam(":name",$name);
            $prepare->bindParam(":mail",$email);
            $prepare->bindParam(":message",$message);
            try{
                $prepare->execute();
                http_response_code(201);
                echo json_encode(["Vaša poruka je uspešno poslata"]);
            }
            catch(PDOException $e){
                http_response_code(500);
                echo json_encode(["Došlo je do greške"]);
            }
        }

    }
    else{
        http_response_code(400);
        echo json_encode("Zahtev nije u dobrom formatu");
    }
?>