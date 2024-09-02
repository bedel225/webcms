<?php
$dsn = 'mysql: host=localhost;dbname=webcms' ;
$user = 'root';
$password = '';


try{
    $BDDpdo = new PDO($dsn, $user , $password);
    $BDDpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
}catch(PDOException $e){
    echo "probleme de connexion".$e->getMessage();
}

