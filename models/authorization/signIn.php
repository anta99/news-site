<?php
    session_start();
    if(isset($_POST["signInBtn"])){
        require_once "../../config/connection.php";
        $userNameRegex="/^[A-zčžćšđČŽĆŠĐ0-9\?\!\.]{3,30}$/";
        $passwordRegex="/^[A-z0-9\.\?\,\s\!\@\#]{8,50}$/";
        $errors=[];
        if(isset($_POST["logName"])){
            $username=$_POST["logName"];
            if(!preg_match($userNameRegex,$username)){
                $errors[]="Korisnikčko ime nije u dobrom formatu";
            }
        }
        if(isset($_POST["logPass"])){
            $password=$_POST["logPass"];
            if(!preg_match($passwordRegex,$password)){
                $errors[]="Lozinka nije u dobrom formatu";
            }
        }
        if(!count($errors)){
            $findUser="SELECT k.*,u.naziv as role FROM korisnici k INNER JOIN uloge u ON k.uloga_id=u.id WHERE k.username=:username AND k.sifra=:password AND k.verifikacija=1";
            $prepare=$conn->prepare($findUser);
            $prepare->bindParam(":username",$username);
            $hasedPassword=md5($password);
            $prepare->bindParam(":password",$hasedPassword);
            try{
                $prepare->execute();
                if($prepare->rowCount()==1){
                    $user=$prepare->fetch();
                    $_SESSION["user"]=$user;
                    header("Location:../../index.php?page=userProfile");
                }
                else{
                     $_SESSION["logInFail"]="Korisničko ime ili lozinka su pogrešni";
                     header("Location:../../index.php?page=authorization");
                }
            }
            catch(PDOException $e){

            }
        }
        else{
            $_SESSION["logInFail"]=$errors;
        }
    }
    else{
        echo "Niste dobro dosli!";
    }
?>