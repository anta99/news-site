<?php
    header("Content-Type:application/json");
    if(isset($_POST["register"])){
        require_once "../../config/connection.php";
        $errors=[];
        $unique=true;
        $firstNameRegex ="/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/";
        $lastNameRegex = "/^[A-Z][a-z]{2,24}(\s[A-Z][a-z]{2,24})*$/";
        $userNameRegex="/^[A-zčžćšđČŽĆŠĐ0-9\?\!\.]{3,30}$/";
        $emailRegex = "/^[a-z\.\!\?0-9]{4,40}\@[a-z0-9]{3,15}(\.[a-z0-9]{3,15})*\.[a-z]{2,3}$/";
        $passwordRegex="/^[A-z0-9\.\?\,\s\!\@\#]{8,50}$/";
        if(isset($_POST["firstName"])){
            $firstName=$_POST["firstName"];
            if(!preg_match($firstNameRegex,$firstName)){
                $errors[]="Ime nije u dobrom formatu";
            }
        }
        if(isset($_POST["lastName"])){
            $lastName=$_POST["lastName"];
            if(!preg_match($lastNameRegex,$lastName)){
                $errors[]="Prezime nije u dobrom formatu";
            }
        }
        if(isset($_POST["username"])){
            $username=$_POST["username"];
            if(!preg_match($userNameRegex,$username)){
                $errors[]="Korisničko ime nije u dobrom formatu";
            }
        }
        if(isset($_POST["mail"])){
            $mail=$_POST["mail"];
            if(!preg_match($emailRegex,$mail)){
                $errors[]="Mail nije u dobrom formatu";
            }
        }
        if(isset($_POST["password"])){
            $password=$_POST["password"];
            if(!preg_match($passwordRegex,$password)){
                $errors[]="Lozinka nije u dobrom formatu";
            }
        }
        if(isset($_POST["terms"])){
            $terms=$_POST["terms"];
            if(!filter_var($terms,FILTER_VALIDATE_BOOLEAN)){
                $errors[]="Prihvatite uslove korišćenja";
            }
        }
        if(!count($errors)){
            $uniqueUsername=executeQuery("SELECT * FROM korisnici WHERE username='$username'");
            $uniqueMail=executeQuery("SELECT * FROM korisnici WHERE mail='$mail'");
            if(count($uniqueUsername)){
                $unique=false;
                $errors[]="Korisnik sa takvim imenom već postoji";
            }
            if(count($uniqueMail)){
                $unique=false;
                $errors[]="Korisnik sa takvom e-mail adresom već postoji";
            }
            if($unique){
                $insertQuery="INSERT INTO korisnici(ime,prezime,mail,username,sifra,verifikacija_kod,verifikacija,uloga_id) VALUES(:firstName,:lastName,:mail,:username,:password,:kod,0,2)";
                $verificationCode=md5(time().$username);
                $hasedPassword=md5($password);
                $prepare=$conn->prepare($insertQuery);
                $prepare->bindParam(":firstName",$firstName);
                $prepare->bindParam(":lastName",$lastName);
                $prepare->bindParam(":mail",$mail);
                $prepare->bindParam(":username",$username);
                $prepare->bindParam(":password",$hasedPassword);
                $prepare->bindParam(":kod",$verificationCode);
                try{
                    $prepare->execute();
                    http_response_code(200);
                    echo json_encode($verificationCode);
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
            echo json_encode($errors);
        }
    }
    else{
        http_response_code(400);
        echo json_encode("Zahtev nije u dobrom formatu");
    }
?>