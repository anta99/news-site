<?php
    header("Content-Type:application/json");
    if(isset($_POST["search"])){
        require_once "../config/connection.php";
        if(isset($_POST["searchQuery"])){
            $search=$_POST["searchQuery"];
            $tags=explode(" ",$search);
            $tagsString="";
            foreach($tags as $tag){
                $tagsString.="$tag,";
            }
            $tagsString=substr($tagsString,0,-1);
        }
        $searchQuery="SELECT v.* FROM vesti v INNER JOIN tag_vest tv ON v.id=tv.id_vest INNER JOIN tagovi t ON t.id=tv.id_tag WHERE v.naslov LIKE :search OR (t.naziv IN (:tags) OR t.naziv LIKE :search) GROUP BY v.id";
        $like="%$search%";
        $prepare=$conn->prepare($searchQuery);
        $prepare->bindParam(":search",$like);
        $prepare->bindParam(":tags",$tagsString);
        try{
            $prepare->execute();
            $results=$prepare->fetchAll();
            http_response_code(200);
            echo json_encode($results);
        }
        catch(PDOException $e){
            http_response_code(500);
            echo json_encode($e);
        }
        
    }
    else{
        header("Content-Type:application/json");
        http_response_code(400);
        echo json_encode("Greska rodjace");
    }
?>