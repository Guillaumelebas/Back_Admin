<div class="row" id="bande-log">
            <div class="col-xs-12 text-right">
                <?php
                  //  $toto = "marie-thérèse";
                  //  echo ucfirst(strtolower($toto));
                 //  echo mb_convert_case($toto, MB_CASE_TITLE, 'utf-8');
                ?>
                Bienvenue <?php
                //Conversion des noms et prénoms en minuscule (strtolower)
                //et première lettre en majuscule (ucfirst)
                //!!! Ne fonctionne pas pour les noms composés
                //$prenom = ucfirst(strtolower($_SESSION['user']['prenom']));
                //$nom = ucfirst(strtolower($_SESSION['user']['nom']));
                //Pour les composés utilise MB CONVERT CASE
                $prenom = mb_convert_case($_SESSION['user']['prenom'], MB_CASE_TITLE, 'utf-8');
                $nom = mb_convert_case($_SESSION['user']['nom'], MB_CASE_TITLE, 'utf-8');
                echo $prenom.' '.$nom; ?>
                <a href="../core/libs/users-services.php?action=unlog-admin"><span class="glyphicon glyphicon-lock"></span></a>
            </div>
        </div>
