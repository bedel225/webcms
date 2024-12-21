<?php

session_start();

if($_SESSION){
    session_unset();
    session_destroy();
    header('location:index.php');
}else{
    echo 'Vous n\'etes pas connecté';
}