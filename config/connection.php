<?php
    require_once "config.php";
    writeLog();
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
    function getMenuItems(){
        //global $navQuery;
        $navQuery="SELECT * FROM navigacija ORDER BY prioritet";
        return executeQuery($navQuery);
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
    function filterNews($currentPage,$categoires){
        global $conn;
        $newsOnPage=1;
        $startIndex=$newsOnPage*($currentPage-1);
        $filterQuery="SELECT v.*,k.naziv as category,CONCAT(kor.ime,' ',kor.prezime) as author,s.src as src,s.alt as alt
        FROM vesti v INNER JOIN kategorije k ON v.kat_id=k.id INNER JOIN autori a ON a.id=v.autor_id INNER JOIN korisnici kor ON kor.id=a.kor_id INNER JOIN slike s ON s.vest_id=v.id INNER JOIN tip_slike tp ON tp.id=s.tip_id WHERE tp.naziv='thumbnail' ";
        if(count($categoires)){
            $categoiresBind=implode($categoires,",");
            $filterQuery.="AND v.kat_id IN ($categoiresBind) ORDER BY datum DESC";
            $prepare=$conn->prepare($filterQuery);
            //$prepare->bindParam(":cat",$categoiresBind);
            try{
                $prepare->execute();
                $newsCount=$prepare->rowCount();
                $filterQuery.=" LIMIT $startIndex,$newsOnPage";
                $prepare2=$conn->prepare($filterQuery);
                //$prepare2->bindParam(":cat",$categoiresBind);
                $prepare2->execute();
                $news=$prepare2->fetchAll();
            }
            catch(PDOException $e){
                return false;
            }
        }
        else{
            $filterQuery.=" ORDER BY datum DESC";
            $newsCount=count(executeQuery($filterQuery));
            $filterQuery.=" LIMIT $startIndex,$newsOnPage";
            $news=executeQuery($filterQuery);
        }
        #$newsCount=count($news);
        $pagesNumber=ceil($newsCount/$newsOnPage);
        return ["news"=>$news,"pagesNumber"=>$pagesNumber,"newsNumber"=>$newsCount];
    }
    function writeLog(){
        $logFile=fopen(LOG_FILE,"a");
        $date=date('d/m/Y H:i:s');
        // $log="{$_SERVER['PHP_SELF']}?{$_SERVER["QUERY_STRING"]}\t$date\t{$_SERVER["REMOTE_ADDR"]}\n";
        $log="{$_SERVER['PHP_SELF']}\t$date\t{$_SERVER["REMOTE_ADDR"]}\n";
        fwrite($logFile,$log);
        fclose($logFile);
    }
?>