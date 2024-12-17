<?php

if(isset($_GET['email']) && !empty($_GET['email'])  && isset($_GET['token']) && !empty($_GET['token'])){
    $email = $_GET['email'];
    $token = $_GET['token'];

    require_once "includes/bdd.php";

    $requet = $BDDpdo->prepare('SELECT * FROM utilisateurs WHERE email_utilisateur = :email');
    $requet->bindvalue(':email', $email);
    $requet->execute();
    $result = $requet->fetchAll();
    
    if(count($result)==1){
        $update = $BDDpdo->prepare('UPDATE utilisateurs SET verification_email_utilisateur = :validate WHERE email_utilisateur = :email');

        $update->bindvalue(':email', $email);
        $update->bindvalue(':validate',1);
        $update->execute();
    }
}


