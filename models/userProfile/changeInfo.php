<?php
    session_start();
    if(isset($_POST["changeInfo"])){
        require_once "../../config/connection.php";
        $userNameRegex="/^[A-zčžćšđČŽĆŠĐ0-9\?\!\.]{3,30}$/";
        $errors=[];
        if(isset($_POST["originalName"])){
            $original=$_POST["originalName"];
        }
        if(isset($_POST["userhidden"])){
            $id=$_POST["userhidden"];
        }
        if(isset($_POST["username"])){
            $newName=$_POST["username"];
            if(!preg_match($userNameRegex,$newName)){
                $errors[]="Korisničko ime nije u dobrom formatu";
            }
            else{
                if($newName==$original){
                    $errors[]="Novo korisničko ime mora biti drugačije od trentunog";
                }
                else{
                    $alereadyExistUser="SELECT * FROM korisnici WHERE username=:name";
                    $prepare=$conn->prepare($alereadyExistUser);
                    $prepare->bindParam(":name",$newName);
                    $prepare->execute();
                    if($prepare->rowCount()!=0){
                    $errors[]="Korisnik sa imenon $newName već postoji"; 
                    }
                }
            }
        }
        
        if(!count($errors)){
            $updateQuery="UPDATE korisnici SET username=:newUsrName WHERE id=:id";
            $prepareUpdate=$conn->prepare($updateQuery);
            $prepareUpdate->bindParam(":newUsrName",$newName);
            $prepareUpdate->bindParam(":id",$id);
            try{
                $prepareUpdate->execute();
                $newNameUser=executeQuery("SELECT k.*,u.naziv as role FROM korisnici k INNER JOIN uloge u ON k.uloga_id=u.id WHERE k.id=$id");
                $_SESSION["user"]=$newNameUser[0];
                //var_dump($newNameUser[0]);
                header("Location:../../index.php?page=userProfile");
            }
            catch(PDOException $e){
                $errors[]="Došlo je do greške.Molimo vas pokušajte kasnije.";
                $_SESSION["changeError"]=$errors;
                header("Location:../../index.php?page=userProfile");
            }
        }
        else{
            $_SESSION["changeError"]=$errors;
            header("Location:../../index.php?page=userProfile");
        }
    }
    else{
        header("Location:../../index.php?page=userProfile");
    }
?>