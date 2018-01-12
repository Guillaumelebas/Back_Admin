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
            <?php
            //1
            require('../core/libs/connexion.php');
            //2
            $sql = 'SELECT * FROM categories WHERE cat_id='.$_GET['id'];
            //3
            $req = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
            $cat = mysqli_fetch_array($req);
            ?>
            <form action="../core/libs/categories-services.php" method="post" enctype="multipart/form-data">
           <input type="hidden" name="action" value="modify-cat">
           <input type="hidden" name="id" value="<?php echo $cat['cat_id']; ?>">
           <input type="hidden" name="old-visuel" value="<?php echo $cat['cat_visuel']; ?>">
          <?php if(file_exists('../')){

           }
           ?>
            <div class="form-group">
            <label>Nom :</label>
            <input name="nom" type="text" class="form-control" value="<?php echo $cat['cat_nom']; ?>">
            </div>
            <div class="form-group">
            <label>Visuel :</label>
            <input name="visuel" type="file" class="form-control">
            </div>
            <div class="form-group checkbox">
                <?php
                $checked="";
                if($cat['cat_active']==1) $checked='checked';
                ?>
            <label><input name="active" type="checkbox" <?php echo $checked; ?>>Active</label>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-danger" value="Modifier">
            </div>
            </form>
            </div>
        </div>
     </div>
</body>
</html>