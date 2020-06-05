<?php
    require_once "config.php";
    try{
        $conn=new PDO("mysql:host=".HOST.";dbname=".DBNAME.";",USERNAME,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'"));
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Veza sa bazom nije moguca";
        exit;
    }
    function executeQuery($query){
        global $conn;
        $result=$conn->query($query)->fetchAll();
        return $result;
    }
    function getCategories(){
        $catQuery="SELECT * FROM kategorije";
        return executeQuery($catQuery);
    }
    function getNews($id){
        global $conn;
        $query="SELECT v.*,k.naziv as category,s.src as src,s.alt as alt,CONCAT(kor.ime,' ',kor.prezime) AS author FROM vesti v INNER JOIN kategorije k ON v.kat_id=k.id INNER JOIN autori a ON v.autor_id=a.id INNER JOIN korisnici kor ON a.kor_id=kor.id INNER JOIN slike s ON s.vest_id=v.id INNER JOIN tip_slike ts ON ts.id=s.tip_id WHERE v.id=:id AND ts.naziv='cover'";
        $prepare=$conn->prepare($query);
        $prepare->bindParam(":id",$id);
        try{
            $prepare->execute();
            if($prepare->rowCount()==1){
                $news=$prepare->fetch();
                return $news;
            }
            else{
                return header("Location:index.php?page=notFound");
            }
        }
        catch(PDOException $e){
            return false;
        }
    }
?>