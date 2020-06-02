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
    require_once "views/fixed/head.php";
    require_once "views/fixed/header.php";
    if(isset($_GET["page"])){
        $page=$_GET["page"];
        require_once "views/$page.php";
    }
    else{
        require_once "views/indexContent.php";
    }
    require_once "views/fixed/footer.php";
?>
