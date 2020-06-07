<?php
    //Thumbmail slicica 420X280
    define("ABSOLUTE_PATH",$_SERVER["DOCUMENT_ROOT"]."/praktikumsajt/");
    define("ENV_FILE",ABSOLUTE_PATH."config/.env");
    define("HOST",env("HOST"));
    define("DBNAME",env("DBNAME"));
    define("USERNAME",env("USERNAME"));
    define("PASSWORD",env("PASSWORD"));

    define("LOG_FILE",ABSOLUTE_PATH."data/logfile.txt");
    function env($flag){
        //$envFile=fopen(ENV_FILE);
        $envRows=file(ENV_FILE);
        $returnFlag="";
        foreach($envRows as $row){
            $explodeRow=explode("=",$row);
            if($flag==$explodeRow[0]){
                $returnFlag=trim($explodeRow[1]);
                break;
            }
        }
        return $returnFlag;
    }
    
?>