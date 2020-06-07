<?php
    //require_once "config/connection.php";
    function getTags($id){
        global $conn;
        $query="SELECT t.* FROM tagovi t INNER JOIN tag_vest tv ON tv.id_tag=t.id WHERE tv.id_vest=:id";
        $prepare=$conn->prepare($query);
        $prepare->bindParam(":id",$id);
        try{
            $prepare->execute();
            $tags=$prepare->fetchAll();
            return $tags;
        }
        catch(PDOException $e){
            return false;
        }
    }
    function getComments($id){
        global $conn;
        $query="SELECT kom.*,kor.username FROM komentari kom INNER JOIN korisnici kor ON kor.id=kom.kor_id WHERE vest_id=:id AND roditelj_id IS NULL";
        $prepare=$conn->prepare($query);
        $prepare->bindParam(":id",$id);
        try{
            $prepare->execute();
            $comments=$prepare->fetchAll();
            return $comments;
        }
        catch(PDOException $e){
            return false;
        }
    }
    //Funkcija namenjena da ajax-om za JS vrati sve odgvore na komentare 
    function getAllReplies($id){
        global $conn;
        $query="SELECT kom.*,kor.username FROM komentari kom INNER JOIN korisnici kor ON kor.id=kom.kor_id WHERE vest_id=:id AND roditelj_id IS NOT NULL";
        $prepare=$conn->prepare($query);
        $prepare->bindParam(":id",$id);
        try{
            $prepare->execute();
            $comments=$prepare->fetchAll();
            return $comments;
        }
        catch(PDOException $e){
            return false;
        }
    }
    function getReplies($id){
        global $conn;
        $query="SELECT kom.*,kor.username FROM komentari kom INNER JOIN korisnici kor ON kor.id=kom.kor_id WHERE roditelj_id=:id";
        $prepare=$conn->prepare($query);
        $prepare->bindParam(":id",$id);
        try{
            $prepare->execute();
            $comments=$prepare->fetchAll();
            return $comments;
        }
        catch(PDOException $e){
            return false;
        }
    }
    
    function countComments($id){
        $query="SELECT COUNT(*) AS count FROM komentari WHERE vest_id=$id";
        return executeQuery($query);
    }
?>