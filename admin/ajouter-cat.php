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
            <?php
            if(!empty($_SESSION['msg_error'])){
                echo $_SESSION['msg_error'];
                unset($_SESSION['msg_error']);
            }
            ?>
            <h3>Ajouter une categorie</h3>
            <form action="../core/libs/categories-services.php" method="post" enctype="multipart/form-data">
           <input type="hidden" name="action" value="add-cat">
            <div class="form-group">
            <label>Nom :</label>
            <input name="nom" type="text" class="form-control">
            </div>
            <div class="form-group">
            <label>Visuel :</label>
            <input name="visuel" type="file" class="form-control">
            </div>
            <div class="form-group checkbox">
            <label><input name="active" type="checkbox" checked>Active</label>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-danger" value="Ajouter">
            </div>
            </form>
            </div>
        </div>
     </div>
</body>
</html>