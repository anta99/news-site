<?php
    require_once "../../config/connection.php";
    $sliderNewsQuery="SELECT v.*,k.naziv as category,CONCAT(kor.ime,' ',kor.prezime) as author,(SELECT COUNT(*) 
    FROM komentari
    WHERE vest_id=v.id ) as commentCount,s.src as slikaSrc,s.alt as slikaAlt
    FROM vesti v INNER JOIN kategorije k ON v.kat_id=k.id INNER JOIN autori a ON a.id=v.autor_id INNER JOIN korisnici kor ON kor.id=a.kor_id INNER JOIN slike s ON s.vest_id=v.id INNER JOIN tip_slike ts ON ts.id=s.tip_id WHERE ts.naziv='cover' ORDER BY datum DESC LIMIT 0,3";
    header("Content-Type:application/json");
    try{
        $sliderNews=executeQuery($sliderNewsQuery);
        http_response_code(200);
        echo json_encode($sliderNews);
    }
    catch(PDOException $e){
        http_response_code(500);
        echo json_encode($e);
    }
?>