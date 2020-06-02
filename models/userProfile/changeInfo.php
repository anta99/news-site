<?php
    if(isset($_POST["changeInfo"])){
        require_once "../../connection.php";
        
    }
    else{
        header("Location:../../index.php?page=userProfile");
    }
?>