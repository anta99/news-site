<?php
    function filterNews($currentPage,$categoires){
        global $conn;
        $newsOnPage=8;
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
?>