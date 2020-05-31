<?php
    function getNewsByTags($tagId){
        global $conn;
        $query="SELECT v.*,k.naziv AS category,CONCAT(kor.ime,' ',kor.prezime) AS author,s.src FROM tag_vest tv INNER JOIN vesti v ON tv.id_vest=v.id INNER JOIN tagovi t ON t.id=tv.id_tag INNER JOIN kategorije k ON v.kat_id=k.id INNER JOIN autori a ON v.autor_id=a.id INNER JOIN korisnici kor ON kor.id=a.kor_id INNER JOIN slike s ON s.vest_id=v.id INNER JOIN tip_slike ts ON ts.id=s.tip_id WHERE ts.naziv='thumbnail' AND tv.id_tag=:tag";
        $prepare=$conn->prepare($query);
        $prepare->bindParam(":tag",$tagId);
        try{
            $prepare->execute();
            $newsByTag=$prepare->fetchAll();
            $tagName=executeQuery("SELECT naziv FROM tagovi WHERE id=$tagId");
            return ["news"=>$newsByTag,"tag"=>$tagName];
        }
        catch(PDOException $e){
            return false;
        }
    }
?>