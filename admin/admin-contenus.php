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
        <div class="row">
            <div class="col-xs-3">
            <?php 
                if(file_exists('./inc/nav.inc.php')){
                    include('./inc/nav.inc.php');
                }
            ?>
            </div>
            <div class="col-xs-9">
            <h3>Administrer les categories</h3>
            <div>
                <select id="change-cat" onchange="filtreCat();">
                    <option value="all">Toutes</option>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                </select>
            </div>
            <?php
            //1
            require("../core/libs/connexion.php");
            //2
            $sql= "SELECT * FROM contenus ORDER BY cont_title ASC";
            //3
            $req = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
            //
            echo '<div>Vous avez '.mysqli_num_rows($req).' contenus administrables</div>';
            //
            if(mysqli_num_rows($req)>0){
               //Boucle sur les entrées remontées de la BDD
               while($cont = mysqli_fetch_array($req)){
                   //Avec un if on vérifie si la catégorie est active ou non
                   //en fonction de cela on détermine une variable $class à la active ou
                   //no-active, ces valeurs servirons au filtre javascript :)
                    if($cont['cont_active']==1){
                        $class="active";
                    }else{
                        $class="no-active";
                    }
                    echo '<div class="div-cat '.$class.'">
                    <img src="../images/categories/'.$cont['cont_visuel1'].'" alt="" onload="checkSize('.$cont['cont_id'].');"
                     id="img'.$cont['cont_id'].'">'.$cont['cont_title'].'<div class="pull-right">
                     <a href="./edit-contenu.php?id='.$cont['cont_id'].'"><span class="glyphicon glyphicon-pencil"></span></a>
                     <a href="../core/libs/categories-services.php?action=delete-cat&id='.$cont['cont_id'].'"><span class="glyphicon glyphicon-trash"></span></a>
                    </div></div>';
               }
            }
            
            ?>
            </div>
        </div>
     </div>
     
</body>
</html>