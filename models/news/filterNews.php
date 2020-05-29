<?php
    header("Content-Type:application/json");
    if(isset($_POST["filter"])){
        require_once "../../config/connection.php";
        require_once "function.php";
        $errors=[];
        if(isset($_POST["page"])){
            $page=$_POST["page"];
        }
        else{
            $page=1;
        }
        if(isset($_POST["categoriesIds"])){
            $categories=$_POST["categoriesIds"];
            $filteredNews=filterNews($page,$categories);
        }
        else{
            $filteredNews=filterNews($page,[]);
        }
        if($filteredNews){
            http_response_code(200);
            echo json_encode($filteredNews);
        }

    }
    else{
        http_response_code(400);
        echo json_encode("Zahtev nije dobar");
    }
?>