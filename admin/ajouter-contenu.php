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
            <h3>Ajouter un contenu</h3>
            <form action="../core/libs/contents-services.php" method="post" enctype="multipart/form-data">
           <input type="hidden" name="action" value="add-content">
            <div class="form-group">
            <label>Titre de l'article</label>
            <input type="text" name="titre"  class="form-control">
            </div>
            <div class="form-group">
            <label>Sous titre de l'article</label>
            <textarea name="sous-titre"  class="form-control"></textarea>
            </div>
            <div class="form-group">
            <label>Text court</label>
            <textarea name="text-court"  class="form-control"></textarea>
            </div>
            <div class="form-group">
            <label>Text long</label>
            <textarea name="text-long"  class="form-control"></textarea>
            </div>
            <div  class="form-group checkbox">
            <label><input type="checkbox" name="active">Publié</label>
            </div>
            <div class="form-group">
            <label>Catégorie</label>
            <select name="categorie">
            <?php
                require('../core/libs/connexion.php');
                $sql = 'SELECT * FROM categories WHERE cat_active=1 ORDER BY cat_nom ASC';
                $req = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
                while($cat = mysqli_fetch_array($req)){
                    echo '<option value="'.$cat['cat_id'].'">'.$cat['cat_nom'].'</option>';
                }
            ?>
            </select>
            </div>
            <div class="form-group">
            <label>Image 1</label>
            <input name="visuel1" type="file"  class="form-control">
            </div>
            <div class="form-group">
            <label>Image 2</label>
            <input name="visuel2" type="file"  class="form-control">
            </div>
            <div class="form-group">
        
            <input  type="submit"  class="btn btn-danger" value="Ajouter">
            </div>
            </form>
            </div>
        </div>
     </div>
</body>
</html>