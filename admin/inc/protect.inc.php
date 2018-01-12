<?php
session_start();
//On protège le fichier en accès en vérifiant 
//Que la variable islog a bien la valeur true
//Si islog n'a pas la valeur true on renvoie à l'index
//de l'admin, a vous de jouer.... :) DROLE
if(empty($_SESSION['user']['islog'])){
   //Redirection 
   header('Location:index.php');
}else{
    if($_SESSION['user']['islog']!=true){
        //redirection
        header('Location:index.php');
    }
}
?>