<?php
    header("Content-Type:application/json");
    if(isset($_POST["moreTags"])){
        require_once "../../../config/connection.php";
        if(isset($_POST["selectedTags"])){
            $tags=$_POST["selectedTags"];
            $tagsString=implode($tags,",");
        }
        else{
            http_response_code(400);
            echo json_encode("Morate izabrati neki tag");
        }
        $tagsQuery="SELECT * FROM tagovi WHERE id NOT IN ($tagsString)";
        // $prepare=$conn->prepare($tagsQuery);
        // $prepare->bindParam(":tags",$tagsString);
        try{
            $moreTags=executeQuery($tagsQuery);
            http_response_code(200);
            echo json_encode($moreTags);
        }
        catch(PDOException $e){
            http_response_code(500);
            echo json_encode("Došlo je do greške.Molimo vas pokušajte kasnije");
        }
    }
    else{
        http_response_code(400);
        echo json_encode("Zahtev nije u dobrom formatu");
    }
?>