<?php
//Démarage de la session (tableau de mémorisation de données pour 
//les rendres accessibles de page en page). Le démarage de session
//doit toujours être la première commande executée.
session_start();
// $_POST['nom de la variable'], $_GET['nom de la variable'],
// $_SESSION['nom de la variable']
//echo $_POST['action'];
//
//Analyse de la variable action pouvant être reçue en POST ou en GET
$action="";
if(isset($_POST['action'])){
    $action = $_POST['action'];
}
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
//
switch($action){
    case 'log-admin':
    logAdmin();
    break;
    case 'unlog-admin':
    unlogAdmin();
    break;
    case 'add-user':
    addUser();
    break;
    case 'delete-user':
    deleteUser();
    break;
    case 'modify-user':
    modifyUser();
    break;
    default:
    //Aucune valeur de la variable action identifiée, on 
    //renvoit à la home page du site
    header('Location:../../index.php');
}
/* METHODES DU SERVICE */
function modifyUser(){
    //1
    require('connexion.php');
    //2
    $nom = mb_convert_case(htmlspecialchars(addslashes($_POST['lastname'])), MB_CASE_TITLE, 'utf-8');
    $prenom = mb_convert_case(htmlspecialchars(addslashes($_POST['prenom'])), MB_CASE_TITLE, 'utf-8');
    $login = htmlspecialchars(addslashes($_POST['login']));
    $email = htmlspecialchars($_POST['email']);
    $role = $_POST['role'];
    $sql = 'UPDATE users SET usr_nom="'.$nom.'", usr_prenom="'.$prenom.'", usr_log="'.$login.'", 
    usr_mail="'.$email.'", usr_role="'.$role.'" WHERE usr_id='.$_POST['id'];
    //3
    mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    //Gestion du password
    if(!empty($_POST['password'])){
        $password = md5($_POST['password']);
        $sql = 'UPDATE users SET usr_pass="'.$password.'" WHERE usr_id='.$_POST['id'];
        mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    }
    //Gestion de l'avatar
    if(!empty($_FILES['avatar']['tmp_name'])){
        removeAvatar($_POST['id']);
          //echo 'image trouvée';
        //On déplace et on renomme à la volée le fichier pour éviter tous doublons de nom
        //On récupère l'extention
        generateAvatar($_POST['id']);
    }
    //4
    $_SESSION['msg_error'] = "Utilisateur modifié";
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
function generateAvatar($pId){
    require('connexion.php');
    $ext = pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
    $nom = 'usr_avatar_'.$pId.'.'.$ext;
    move_uploaded_file($_FILES['avatar']['tmp_name'], '../../images/avatars/'.$nom);
     //5 Mise à jour du nom de l'image dans la BDD pour l'utilisateur que l'on vient de créer
    $sql = 'UPDATE users SET usr_avatar="'.$nom.'" WHERE usr_id='.$pId;
    mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
}
function removeAvatar($pId){
    if(file_exists('../../images/avatars/usr_avatar_'.$pId.'.jpg')){
        unlink('../../images/avatars/usr_avatar_'.$pId.'.jpg');
    }
    if(file_exists('../../images/avatars/usr_avatar_'.$pId.'.png')){
        unlink('../../images/avatars/usr_avatar_'.$pId.'.png');
    }
}
function deleteUser(){
    //1
    require('connexion.php');
    //2
    $sql = 'DELETE FROM users WHERE usr_id='.$_GET['id'];
    //3
    mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    //3bis suppression de l'avatar si l'utilisateur à un avatar personnalisé
    removeAvatar($_GET['id']);
    //4
    $_SESSION['msg_error']="Utilisateur supprimé";
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
function addUser(){
    //1 Connexion
    require('connexion.php');
    //2 Requête
    $nom =mb_convert_case(htmlspecialchars(addslashes($_POST['lastname'])), MB_CASE_TITLE, 'utf-8');
    $prenom = mb_convert_case(htmlspecialchars(addslashes($_POST['prenom'])), MB_CASE_TITLE, 'utf-8');
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $role = $_POST['role'];
    $sql = 'INSERT INTO users (usr_nom, usr_prenom, usr_log, usr_pass, usr_mail, usr_role)
    VALUES ("'.$nom.'", "'.$prenom.'", "'.$login.'", "'.$password.'", "'.$email.'", '.$role.')';
    //3 Execution de la requête
    mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    //On récupère le dernier id inséré dans la table suite à la requète une ligne au dessus
    $id = mysqli_insert_id($connexion);
    //4 Traitement du fichier joint
    //On vérifie s'il y a eu un fichier d'uploadé
    if(!empty($_FILES['avatar']['tmp_name'])){
        //echo 'image trouvée';
        //On déplace et on renomme à la volée le fichier pour éviter tous doublons de nom
        //On récupère l'extention
        generateAvatar($id);
       /* $ext = pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
        $nom = 'usr_avatar_'.$id.'.'.$ext;
        move_uploaded_file($_FILES['avatar']['tmp_name'], '../../images/avatars/'.$nom);
         //5 Mise à jour du nom de l'image dans la BDD pour l'utilisateur que l'on vient de créer
        $sql = 'UPDATE users SET usr_avatar="'.$nom.'" WHERE usr_id='.$id;
        mysqli_query($connexion, $sql) or die(mysqli_error($connexion));*/
    }
    //X Redirection
    $_SESSION['msg_error'] = "Utilisateur ajouté!";
   header('Location:'.$_SERVER['HTTP_REFERER']);
}
function unlogAdmin(){
    //On detruit la session
    session_destroy();
    //On redémarre la session
    session_start();
    //On crée un message
    $_SESSION['msg_error'] = "Vous êtes bien déconnecté.";
    //Redirection
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
function logAdmin(){
    //1 connexion
    require('connexion.php');
    //2 Selectionner les utilisateurs ayant le log le md5 du password
    //et un rôle à 1 dans la bdd
    $sql ='SELECT * FROM users WHERE usr_log="'.$_POST['identifiant'].'" AND usr_pass="'.md5($_POST['password']).'" AND usr_role=1';
    //3 Execution de la requête
    $req = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
    //4 Traitement des données reçues de la base
    //On analyse le nombre de ligne(s) de données renvoyée(s) par la base
    if(mysqli_num_rows($req)==0){
        //Si 0 on est pas connecté
        //Création d'un message d'erreur
        $_SESSION['msg_error'] = "Erreur d'identifiant et/ou de mot de passe";
        //Redirection vers la page de login
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }else{
        //Sinon on est connecté et on mémorise les données dans une 
        //variable de session
        //On agence les données remontées de la base.
        $user = mysqli_fetch_array($req);
        //On mémorise le nom et le prenom dans la session dans 
        //une entrée nommée 'user' on crée un sous tableau.
        $_SESSION['user']['prenom'] = $user['usr_prenom'];
        $_SESSION['user']['nom'] = $user['usr_nom'];
        $_SESSION['user']['log'] = $user['usr_log'];
        $_SESSION['user']['islog'] = true;
        //Redirection vers la page menu.php du BO
        header('Location:../../admin/menu.php');
    }
}
?>