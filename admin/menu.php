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
            
            </div>
        </div>
     </div>
</body>
</html>