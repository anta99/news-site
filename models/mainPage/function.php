<?php
    function getFreshNews(){
        $newsQuery="SELECT v.*,k.naziv as category,CONCAT(kor.ime,' ',kor.prezime) as author,s.src as src,s.alt as alt
        FROM vesti v INNER JOIN kategorije k ON v.kat_id=k.id INNER JOIN autori a ON a.id=v.autor_id INNER JOIN korisnici kor ON kor.id=a.kor_id INNER JOIN slike s ON s.vest_id=v.id INNER JOIN tip_slike tp ON tp.id=s.tip_id WHERE tp.naziv='thumbnail' ORDER BY datum DESC LIMIT 0,6";
        return executeQuery($newsQuery);
    }
    function popularNews(){
        $popularNewsQuery="SELECT v.*,COUNT(k.id) AS comCount FROM vesti v LEFT OUTER JOIN komentari k ON v.id=k.vest_id GROUP BY v.id ORDER BY comCount DESC,v.datum DESC LIMIT 0,4";
        return executeQuery($popularNewsQuery);
    }
?>