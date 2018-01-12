<?php
if(file_exists('./inc/protect.inc.php')){
    include('./inc/protect.inc.php');
}
?>
<!doctype html>
<html>
<head>
<?php
if(file_exists('./inc/head.inc.php')){
    include('./inc/head.inc.php');
}
?>
<script type="text/javascript" src="./js/forms.js"></script>
</head>
<body>
    <div class="container bg-white">
        <header class="row">ADMIN</header>
        <?php 
                if(file_exists('./inc/bande-log.inc.php')){
                    include('./inc/bande-log.inc.php');
                }
            ?>
        <div class="row mb50">
            <div class="col-xs-3">
            <?php 
                if(file_exists('./inc/nav.inc.php')){
                    include('./inc/nav.inc.php');
                }
            ?>
            </div>
            <div class="col-xs-9">
                <form action="" method="GET" id="filtre">
                   
                    <select onchange="filtre();" name="r">
                        <?php
                           if(empty($_GET['r'])){
                               echo '<option value="all">Tous</option>
                               <option value="1">Utilisateur</option>
                               <option value="2">Administrateur</option>';
                           }else{
                               if($_GET['r']=="1"){
                                   echo ' <option value="all">Tous</option>
                                   <option value="1" selected>Utilisateur</option>
                                   <option value="2">Administrateur</option>';
                               }
                               if($_GET['r']=="2"){
                                echo ' <option value="all">Tous</option>
                                <option value="1" >Utilisateur</option>
                                <option value="2" selected>Administrateur</option>';
                               } 
                               if($_GET['r']=="all"){
                                echo '<option value="all" selected>Tous</option>
                                <option value="1">Utilisateur</option>
                                <option value="2">Administrateur</option>';
                               }
                           }
                        ?>
                       
                    </select>
                </form>
            <?php
        //On vérifie s'il y a un message d'erreur stocké dans la session
        if(!empty($_SESSION['msg_error'])){
            //On écrit le message dans l'html de la page renvoyé à l'utilisateur
            echo '<div class="message-admin col-xs-12 bg-info">'.$_SESSION['msg_error'].'</div>';
            //
            //echo '<script type="text/javascript">alert("'.$_SESSION['msg_error'].'");</script>';
            //On supprime le message de la session
            unset($_SESSION['msg_error']);
        }
        ?>
                <h3>Administrer les utilisateurs :</h3>
                <?php
                //On récupère la liste des utilisateurs du site
                //1 Connexion
                require('../core/libs/connexion.php');
                //2 Ecrire la requète
                $sql = 'SELECT usr_id,usr_nom,usr_prenom FROM users ORDER BY usr_nom ASC';
                if(empty($_GET['r']) ){
                     $sql = 'SELECT usr_id,usr_nom,usr_prenom FROM users ORDER BY usr_nom ASC';
                }else{
                  if($_GET['r']=="all"){
                    $sql = 'SELECT usr_id,usr_nom,usr_prenom FROM users ORDER BY usr_nom ASC';
                  }else{
                       $sql = 'SELECT usr_id,usr_nom,usr_prenom FROM users WHERE usr_role='.($_GET['r']-1).' ORDER BY usr_nom ASC';
                  }
                   
                }
               
                //3 Executer la requête
                $req = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
                //4 Traitement des données
                if(mysqli_num_rows($req)==0){
                    echo 'Aucun utilisateur trouvé';
                }else{
                    $i=0;
                    while($user = mysqli_fetch_array($req)){
                       ($i%2==0) ? $class='bleue' : $class="grise";
                       echo '<div class="ligne-user '.$class.'">'.$user['usr_nom'].' '.$user['usr_prenom'].'
                        <div class="pull-right">
                            <a href="./edit-user.php?id='.$user['usr_id'].'"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="../core/libs/users-services.php?action=delete-user&id='.$user['usr_id'].'"><span class="glyphicon glyphicon-trash"></span></a>
                        </div>
                       </div>';
                       $i++;
                    }
                }
                ?>
               
            </div>
        </div>
     </div>
</body>
</html>