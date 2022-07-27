<?php
    
    $servname = "localhost"; 
    $port = 3306; 
    $dbname = "colnet"; 
    $user = "root"; 
    $pass = "";
    
    try {
        $dbco = new PDO("mysql:host=$servname;port=3306;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
        
?>