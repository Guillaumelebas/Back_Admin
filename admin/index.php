<?php
session_start();
?>
<!doctype html>
<html>
    <head>
       <?php
        include './inc/head.inc.php';
       ?>
    </head>
    <body>
    <div class="container">
        <div class="block-log col-xs-12">
            <?php

?>
        <form action="../core/libs/users-services.php" method="POST">
        <input type="hidden" name="action" value="log-admin">
        <div class="form-group">
            <?php echo '<label for="log">Identifiant :</label>'; ?>
            <input type="text" name="identifiant" id="log" autocomplete="off" class="form-control" placeholder="Entrez votre identifiant" value="coucou">
        </div>
        <div class="form-group">
            <label for="pass">Mot de passe :</label>
            <input type="password" name="password" id="pass"  class="form-control">
        </div>
            <div class="form-group">
            <input type="submit" value="Se connecter" class="btn btn-default btn-danger">
        </div>
        </form>
        <?php
        //On vérifie s'il y a un message d'erreur stocké dans la session
        if(!empty($_SESSION['msg_error'])){
            //On écrit le message dans l'html de la page renvoyé à l'utilisateur
            echo $_SESSION['msg_error'];
            //
            //echo '<script type="text/javascript">alert("'.$_SESSION['msg_error'].'");</script>';
            //On supprime le message de la session
            unset($_SESSION['msg_error']);
        }
        ?>



        </div>
    </div>
    <script type="text/javascript">
    document.getElementById("log").value="";
    document.getElementById("pass").value="";
    </script>
    </body>
</html>

