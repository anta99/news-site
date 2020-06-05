<?php
    session_start();
    ob_start();
    $logged=false;
    $admin=false;
    $author=false;
    if(isset($_SESSION["user"])){
        $logged=true;
        $user=$_SESSION["user"];
        if($user["role"]=="admin"){
            $admin=true;
        }
        else if($user["role"]=="autor"){
            $author=true;
        }
    }
    require_once "config/connection.php";
    if(isset($_GET["page"])){
        $page=$_GET["page"];
        switch($page){
            case "news":case "contact":case "authorization":case "singleNews":case "userProfile":case "notFound":case "adminPanel":case "verificationPage":case "addNews":break;
            default: $page="notFound";break;
            
        }
    }
    else{
        $page="indexContent";
    }
    require_once "views/fixed/head.php";
    require_once "views/fixed/header.php";
    require_once "views/$page.php";
    require_once "views/fixed/footer.php";
?>
