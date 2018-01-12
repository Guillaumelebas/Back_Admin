<?php
session_start();
//
$action="";
if(!empty($_GET['action'])){
    $action=$_GET['action'];
}
if(!empty($_POST['action'])){
    $action=$_POST['action'];
}
//
switch($action){
    case 'add-content':
    addContent();
    break;
    case 'modify-content':
    modifyContent();
    break;
    default:
    header('Location:../../index.php');
}
// METHODES DU SERVICES
function modifyContent(){
    //1 Connexion
    require('connexion.php');
    //2 Ecritue de la requête
    $title = htmlspecialchars(addslashes($_POST['titre']));
    $subtitle = htmlspecialchars(addslashes($_POST['sous-titre']));
    $short = htmlspecialchars(addslashes($_POST['text-court']));
    $long = htmlspecialchars(addslashes($_POST['text-long']));
    //
    if(empty($_POST['active'])){
        $active = 0;
    }else{
        $active = 1;
    }
    //
    $sql = 'UPDATE contenus SET cont_title="'.$title.'", cont_subtitle="'.$subtitle.'", cont_shorttext="'.$short.'"
    , cont_longtext="'.$long.'" ,cont_active="'.$active.'", cont_cat_id="'.$_POST['categorie'].'" WHERE cont_id='.$_POST['id'];
    //echo $sql;
    //Execution de la requete
    $req = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    $id = $_POST['id'];
    //Gestion des images
    require('../utils/images-manager.php');
    if(!empty($_FILES['visuel1']['tmp_name'])){
        $imgName = createPictFromPict($_FILES['visuel1'], $id, 300, 200, 'content');
        $sql = 'UPDATE contenus SET cont_visuel1="'.$imgName.'" WHERE cont_id='.$id;
        mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    }
    if(!empty($_FILES['visuel2']['tmp_name'])){
        $imgName = createPictFromPict($_FILES['visuel2'], $id, 600, 300, 'content2');
        $sql = 'UPDATE contenus SET cont_visuel2="'.$imgName.'" WHERE cont_id='.$id;
        mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    }
    //
    $_SESSION["msg_error"] = "Contenu modifié";
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
// METHODES DU SERVICES
function addContent(){
    //1 Connexion
    require('connexion.php');
    //2 Ecritue de la requête
    $title = htmlspecialchars(addslashes($_POST['titre']));
    $subtitle = htmlspecialchars(addslashes($_POST['sous-titre']));
    $short = htmlspecialchars(addslashes($_POST['text-court']));
    $long = htmlspecialchars(addslashes($_POST['text-long']));
    //
    if(empty($_POST['active'])){
        $active = 0;
    }else{
        $active = 1;
    }
    //
    $sql = 'INSERT INTO contenus (cont_title, cont_subtitle, cont_shorttext, cont_longtext, 
    cont_active, cont_cat_id) VALUES ("'.$title.'", "'.$subtitle.'", "'.$short.'", "'.$long.'"
    ,'.$active.', '.$_POST['categorie'].')';
    //echo $sql;
    //Execution de la requete
    $req = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    $id = mysqli_insert_id($connexion);
    //Gestion des images
    require('../utils/images-manager.php');
    if(!empty($_FILES['visuel1']['tmp_name'])){
        $imgName = createPictFromPict($_FILES['visuel1'], $id, 300, 200, 'content');
        $sql = 'UPDATE contenus SET cont_visuel1="'.$imgName.'" WHERE cont_id='.$id;
        mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    }
    if(!empty($_FILES['visuel2']['tmp_name'])){
        $imgName = createPictFromPict($_FILES['visuel2'], $id, 600, 300, 'content2');
        $sql = 'UPDATE contenus SET cont_visuel2="'.$imgName.'" WHERE cont_id='.$id;
        mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    }
    //
    $_SESSION["msg_error"] = "Contenu ajouté";
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
?>