<?php
    function verification($code){
        global $conn;
        $updateQuery="UPDATE korisnici SET verifikacija=1 WHERE verifikacija_kod=:code";
        $prepare=$conn->prepare($updateQuery);
        $prepare->bindParam(":code",$code);
        try{
            $prepare->execute();
            if($prepare->rowCount()==1){
                return true;
            }
            return false;
        }
        catch(PDOException $e){
            return false;
        }
    }
?>