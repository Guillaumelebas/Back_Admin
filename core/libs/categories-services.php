<?php
session_start();
//
$action="";
if(!empty($_GET['action'])){
    $action = $_GET['action'];
}
if(!empty($_POST['action'])){
    $action = $_POST['action'];
}
switch($action){
    case 'add-cat':
    addCat();
    break;
    case 'delete-cat':
    deleteCat();
    break;
    case 'modify-cat':
    modifyCat();
    break;
    default:
    header('Location:../../index.php');
}
/* METHODES DU SERVICE */
function modifyCat(){
     //
     require('connexion.php');
     //
     $active = 0;
     if(!empty($_POST['active'])){
        $active = 1;
     }
     $nom = mb_convert_case(htmlspecialchars(addslashes($_POST['nom'])), MB_CASE_TITLE, 'utf-8');
     $sql = 'UPDATE categories SET cat_nom="'.$nom.'", cat_active='.$active.' WHERE cat_id='.$_POST['id'];
     mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
     //Gestion de l'image si nécessaire
     if(!empty($_FILES['visuel']['tmp_name'])){
        //Suppression de l'ancienne.
        if($_POST['old-visuel']!="default-categorie.png"){
            if(file_exists('../images/categories/'.$_POST['old-visuel'])){
                 unlink('../images/categories/'.$_POST['old-visuel']);
            }
           
        }
        //
        $ext = pathinfo($_FILES['visuel']['name'], PATHINFO_EXTENSION);
        //Déplacement de l'image
        $nom = 'categorie_'.$_POST['id'].'.'.$ext;
        move_uploaded_file($_FILES['visuel']['tmp_name'], '../../images/categories/'.$nom);
        $sql = 'UPDATE categories SET cat_visuel="'.$nom.'" WHERE cat_id='.$_POST['id'];
        mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
     }
     //
     $_SESSION['msg_error'] = "Categorie modifiée";
     header('Location:'.$_SERVER['HTTP_REFERER']);
}
function deleteCat(){
    //
    require('connexion.php');
    //
    $sql = 'SELECT cat_visuel FROM categories WHERE cat_id='.$_GET['id'];
    $req = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    $cat = mysqli_fetch_array($req);
    if($cat['cat_visuel']!="default-categorie.png"){
        unlink('../../images/categories/'.$cat['cat_visuel']);
    }
    //
    $sql = 'DELETE FROM categories WHERE cat_id='.$_GET['id'];
    mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    //
    $_SESSION['Categorie supprimée!'];
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
function addCat(){
    //1
    require("connexion.php");
    //2
    $nom = mb_convert_case(htmlspecialchars(addslashes($_POST['nom'])), MB_CASE_TITLE, 'utf-8');
    if(empty($_POST['active'])){
        $sql='INSERT INTO categories (cat_nom, cat_active) VALUES ("'.$nom.'", 0)';
    }else{
        $sql='INSERT INTO categories (cat_nom) VALUES ("'.$nom.'")';
    }
    //3
    mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    //4 traitement de l'image
    if(!empty($_FILES['visuel']['tmp_name'])){
        $id = mysqli_insert_id($connexion);
        $ext = pathinfo($_FILES['visuel']['name'], PATHINFO_EXTENSION);
        //Déplacement de l'image
        $nom = 'categorie_'.$id.'.'.$ext;
        move_uploaded_file($_FILES['visuel']['tmp_name'], '../../images/categories/'.$nom);
        $sql = 'UPDATE categories SET cat_visuel="'.$nom.'" WHERE cat_id='.$id;
        mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    }
    //5 Message et redirection
    $_SESSION['msg_error']="Categorie ajoutée!";
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
?>