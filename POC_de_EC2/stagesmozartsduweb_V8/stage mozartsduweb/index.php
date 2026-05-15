<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>versions WP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" />
</head>
<?php
if(isset($_GET['url']) && !empty($_GET['url'])){
    if(filter_var($_GET['url'], FILTER_VALIDATE_URL)){
        include_once 'includes/GenerationTableauVersion.php';
        include_once 'includes/RecuperationVersion.php';
    }
}
function recupValue(){
    if(isset($_GET['url']) && !empty($_GET['url'])){
        return $_GET['url'];
    }
    else{
        return '';
    }
}
function recupValueVersSaisie(){
    if(isset($_GET['VersionSaisie']) && !empty($_GET['VersionSaisie'])){
        return $_GET['VersionSaisie'];
    }
    else{
        return '';
    }
}
function recupValueEmail(){
    if(isset($_GET['email']) && !empty($_GET['email'])){
        return $_GET['email'];
    }
    else{
        return '';
    }
}
?>
<body>
    <div class='fond'>
        <div class="conteneur">
            <div class='conteneurform'>
                <img class="photo">
                <h1 class="titre">Vérifier la version de sites sous WordPress</h1>
                <p>Ce site vous permet de connaitre le retard de la version et les plugins de sites sous WordPress.</p>
                <div class="formulaire">
                    <form action='' method='get'>
                        <input type="text" name="url" placeholder="veuillez saisir l'url de votre site." value=<?php echo recupValue(); ?>></input>
                        <?php
                        if(isset($LaVersion) && $LaVersion === 'null' && !empty($LaVersion)){
                            echo "<input type='text' name='VersionSaisie' placeholder='veuillez saisir la version de votre site.' value=".recupValueVersSaisie()."></input>";
                        }
                        
                        ?>
                        <button> <span>Tester</span> </button>
                    </form>
                </div>
            </div>
            <div class="lesinfos">
                <?php
                if(isset($_GET['url']) && !filter_var($_GET['url'], FILTER_VALIDATE_URL) && !empty($_GET['url'])){
                    echo "<p> Votre saisie n'est pas une url. </p>";
                }
                ?>
                <div class='lesResponces'>
                    <div class='reponse'>
                        <?php 
                        if(isset($_GET['url']) && !empty($_GET['url'])){
                            if(filter_var($_GET['url'], FILTER_VALIDATE_URL)){
                                include_once 'includes/GenerationTableauVersion.php';
                                include_once 'includes/RecuperationVersion.php';
                                if(!empty($_GET['VersionSaisie'])){
                                    $LaVersion = $_GET['VersionSaisie'];
                                }
                                if(!empty($LaVersion) && in_array($LaVersion,$tabVersion)){
                                    $listeVersionBrancheActuelle = [];
                                    $listeVersionsMajeures = [];
                                    foreach($tabVersion as $elem){
                                        $UnElem = $elem[0].$elem[1].$elem[2];
                                        $brancheActuelle = $LaVersion[0].$LaVersion[1].$LaVersion[2];
                                        if(!in_array($UnElem,$listeVersionsMajeures)){
                                            $listeVersionsMajeures[] = $UnElem;
                                        }
                                        if($brancheActuelle === $UnElem){
                                            $listeVersionBrancheActuelle[] = $elem;
                                        }
                                    }
                                    for($i=0; $i < count($listeVersionsMajeures);$i++){
                                        if($listeVersionsMajeures[$i] === $brancheActuelle ){
                                            $majeures = $i;
                                        }
                                    }
                                    for($i=0; $i < count($tabVersion);$i++){
                                        if($tabVersion[$i] === $LaVersion){
                                            if($i === 0){
                                                echo "<p>Version Actuelle : ".$LaVersion."</p>";
                                                echo "<p>Version la plus recente : ".$tabVersion[0]."</p>";
                                                echo "<p>Votre site est à jour.</p>";
                                            }
                                            else{
                                                if($i === 1){
                                                    echo "<p>Version Actuelle : ".$LaVersion."</p>";
                                                    echo "<p>Version la plus récente : ".$tabVersion[0]."</p>";
                                                    echo "<p>Votre site a ".$i." version de retard sur la version la plus récente.</p>";
                                                    echo "<p> Détails du retard : </p>";
                                                    echo "<ul><li>".$majeures." version(s) Majeure(s)</li>";
                                                    echo "<li>".($i)." version(s) Mineure(s)</li></ul>";
                                                }
                                                else{
                                                    echo "<p>Version Actuelle : ".$LaVersion." .</p>";
                                                    echo "<p>Version la plus récente : ".$tabVersion[0]." .</p>";
                                                    if($listeVersionBrancheActuelle[0] === $LaVersion){
                                                        echo "<p> Votre site est sécurisé sur la branche ".$brancheActuelle." (dernière version de la branche).</p>";
                                                    }
                                                    echo "<p>Votre site a ".$i." version(s) de retard sur la version la plus récente.</p>";
                                                    echo "<p> Détails du retard : </p>";
                                                    echo "<ul><li>".$majeures." version(s) Majeure(s)</li>";
                                                    echo "<li>".($i)." version(s) Mineure(s)</li></ul>";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        ?>
                    </div>
                    <div class=reponse>
                        <?php
                        if(isset($_GET['url']) && !empty($_GET['url'])){
                            include_once 'includes/RecuperationPlugins.php';
                            include_once 'includes/RecuperationSeo.php';
                            
                            $ListePluginsLesPlusUstilise = [
                                "seo test" => 'seo',
                                "Yoast SEO" => 'Yoast SEO',
                                "W3 Toltal Cache" => 'W3 Toltal Cache',
                                "Ultimate Member"=> 'Ultimate Member',
                                "Contact Form 7" => "contact-form-7",
                                "Jetpack"=> 'Jetpack',
                                "Wordfence"=> 'Wordfence',
                                "Antispam Bee"=> 'Antispam Bee',
                                "WP Rocket"=> 'WP Rocket',
                                "Elementor"=> 'elementor',
                                "Elementor Pro"=> 'elementor-pro',
                                "Akismet"=> 'Akismet',
                            ];
                            if(isset($Plugins) && !empty($Plugins)){
                                echo '<p> Liste des Plugins : </p>';
                                $PluginsSiteLesPlusUse = [];
                                $PluginsSiteSpecifiques = [];
                                foreach($Plugins as $UnPlugin){
                                    if($UnPlugin === "seo"){
                                        $UnPlugin = $LesSeo[0]." SEO";
                                    }
                                    if(in_array($UnPlugin,$ListePluginsLesPlusUstilise)){
                                        $val = array_search($UnPlugin,$ListePluginsLesPlusUstilise, $strict = false);
                                        $PluginsSiteLesPlusUse[] = $val;
                                    }
                                    else{
                                        $PluginsSiteSpecifiques[] = $UnPlugin;
                                    }
                                }
                                echo '<p> Liste des Plugins connus : </p>';
                                echo '<ul>';
                                if(count($PluginsSiteLesPlusUse) !==0){
                                    foreach($PluginsSiteLesPlusUse as $UnPlugin){
                                        echo '<li>'.$UnPlugin.'</li>';
                                    }
                                }
                                else{
                                    echo '<li> Aucun Plugin dans cette categorie</li>';
                                }
                                echo '</ul>';

                                echo '<p> Liste des Plugins spécifiques : </p>';
                                echo '<ul>';
                                if(count($PluginsSiteSpecifiques) !== 0){
                                    foreach($PluginsSiteSpecifiques as $UnPlugin){
                                        echo '<li>'.$UnPlugin.'</li>';
                                    }
                                }
                                else{
                                    echo '<li> Aucun Plugin dans cette categorie</li>';
                                }
                                echo '</ul>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class='lesResponcess'>
                    <div class='reponsedeux'>
                    <?php 
                        if(isset($_GET['url']) && !empty($_GET['url'])){
                            if(in_array($LaVersion,$tabVersion)){
                            include_once 'includes/Score.php';
                            }
                            else{
                                echo '<p> Version en avance ou innexistante. merci de resaisir la version.</p>';
                            }  
                        }
                                            
                    ?>
                    </div>
                    <div class='reponsedeuxx'>
                        <?php
                        if(isset($score)){
                            if ($score <=10){
                                echo "<h1 class='score'>A (0-10) </h1>";
                                echo "<h1 class='score'>Votre score est excelent! </h1>";
                            } 
                            if ($score <=25 && $score >=11){
                                echo "<h1 class='score'>B (11-25) </h1>";
                                echo "<h1 class='score'>Votre score est correct! </h1>";
                            } 
                            if ($score <=50 && $score>=26){
                                echo "<h1 class='score'>C (26-50) </h1>";
                                echo "<h1 class='score'>Votre score est bon , mise à jour conseillée! </h1>";
                            } 
                            if ($score <=80 && $score>=51){
                                echo "<h1 class='score'>D (51-80) </h1>";
                                echo "<h1 class='score'>Votre score est passable,  mise à jour conseillée! </h1>";
                            } 
                            if ($score <=100 && $score>=81){
                                echo "<h1 class='score'>E (81-100) </h1>";
                                echo "<h1 class='score'>Votre score est mauvais , mise à jour fortement conseillée! </h1>";
                            } 
                            if ($score >100){
                                echo "<h1 class='score'>F (100 et plus) </h1>";
                                echo "<h1 class='score'>Votre score est extrement mauvais , une mise à jour doit être rapidement realisée!</h1>";
                            } 
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="InvisibleFooter"></div>
        <div class="footer">
            <p> Site créé par Mathis Dauguet et Emmanuel Rogue |  Tous droits réservés &copy</p>
        </div>
    </div>
    </body>
</html>