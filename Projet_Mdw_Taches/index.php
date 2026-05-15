<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="maphoto.webp" type="image/jpg">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7887BSMH9J"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-7887BSMH9J');
    </script>
    <title>Reunion MozartsduWeb</title>
</head>
<body>
    <header class="header1">
        <img class="logo" src="logo_MozartsDuWeb.png" >
        <a href="index.php?reunion=true"><button class="btn btn2"><span>Creer une reunion</span></button></a>
    </header>
    <?php
    $username = '116313_mdauguet';
    $password = 'DogMar0504_';
    $name = 'lyceestvincent_mdauguet';
    $pdo = new PDO("mysql:host=mysql-lyceestvincent.alwaysdata.net;dbname=$name", $username, $password);

    function getValue($pdo,$element){
        if(isset($_GET['modification']) && !empty($_GET['modification'])){
            $requete = "SELECT *  FROM taches_mdw where id=:id";
            $preparation = $pdo ->prepare($requete);
            $preparation -> bindParam(":id",$_GET['modification']);

            $preparation->execute();
            $ListeValeurs= $preparation->fetch();

            if($element === "titre"){
                return $ListeValeurs['name'];
            }
            else{
                return $ListeValeurs["description"];
            }
        }
        else{
            if(isset($_POST[$element]) && !empty($_POST[$element])){
                return $_POST[$element];
            }
            else{
                return '';
            }
        }
    }
    ?>
    <div class="conteneur">
        <div class="titreformu">Creer une nouvelle tâche</div>
        <form class="formulaire" method="post" >
            <input placeholder="titre de la tâche" id="titre" name="titre" type="text" class="input" value=""/>
            <?php if(!empty($erreurs["titre"])){
                echo '<p>'.$erreurs["titre"][0]."</p>";
            }
            ?>
            <textarea placeholder="Description de  la tâche" id="desc" name="desc" type="text" class="input"></textarea>
            <?php if(!empty($erreurs["desc"])){
                echo '<p>'.$erreurs["desc"][0]."</p>";
            }
            ?>
            <button class="btn"><span>Enregistrer</span></button>
            <?php if(isset($resultat) && !empty($resultat) && $resultat === true){
                echo '<span>Votre tâche a été enregistré.</span>';
            }
            ?>
        </form>
    </div>
    <div class="LesTaches">
        <table>
            <tbody>
                <tr class="LesTitresTab">
                    <th>Titre</th>
                    <th>Description</th>
                    <th colspan="2">Actions</th>
                </tr>
                <?php
                $requete="SELECT * FROM taches_mdw where id_reu is null ORDER BY id DESC;";
                $stmt= $pdo->prepare($requete);
                $stmt->execute();
                $lestaches = $stmt->fetchAll();

                for($i=0;$i<count($lestaches);$i++){

                    if(isset($_GET['modification']) && $_GET['modification'] === strval($lestaches[$i]['id'])){
                        $titreMod = getValue($pdo,'titre');
                        $descMod = getValue($pdo,'desc');
                        echo"<tr>";
                        echo '<form method="post">';
                        echo"<th class='titreTab'><input type='text' name='NewName' value='".$titreMod."'></th>";
                        echo"<th class='descTab'><textarea class='textarea_ajout' type='text' name='NewDesc'>$descMod</textarea></th>";
                        echo "<th><a href=''><button class='lesactions' type='submit'><img src='modifier.png'></button></a></th>";
                        echo '<th><a href="index.php?id='.$lestaches[$i]['id'].'"><button class="lesactions"><img src="effacer.png"></button></a></th>';
                        echo"</tr>";
                        echo '</form>';
                    }
                    else{
                    echo '<tr>';
                    echo"<th class='titreTab'><p>".$lestaches[$i]['name']."</p></th>";
                    echo"<th class='descTab'><p>".$lestaches[$i]['description']."</p></th>";
                    echo '<th><a href="index.php?modification='.$lestaches[$i]['id'].'"><button disabled class="lesactions"><img src="modifier.png"></button></a></th>';
                    echo '<th><a href="index.php?id='.$lestaches[$i]['id'].'"><button disabled class="lesactions"><img src="effacer.png"></button></a></th>';
                    echo"</tr>";
                    }
                }

                ?>

            </tbody>
        </table>
    </div>
    <div class="historique">
        <h1>Historique des reunions</h1>
        <table>
            <tbody>
                <tr class="LesTitresTab">
                    <th>N° reunion</th>
                    <th>Date</th>
                    <th>Détails</th>
                </tr>
                <?php
                $requete="SELECT * FROM reunions_mdw ORDER BY id DESC;";
                $stmt= $pdo->prepare($requete);
                $stmt->execute();
                $lesreunions = $stmt->fetchAll();
            
                for($i=0;$i<count($lesreunions);$i++){
                    
                    echo"<tr>";
                    echo"<th class='titreTab'><p>".$lesreunions[$i]['id']."</p></th>";
                    echo"<th class='date'><p>".date('d/m/Y', strtotime($lesreunions[$i]['created_at']))."</p></th>";
                    echo '<th><a href="reunion.php?id_reu='.$lesreunions[$i]['id'].'"><button class="lesactions"><img src="oeil.png"></button></a></th>';
                    
                    echo"</tr>";
                }

                ?>

            </tbody>
        </table>
    </div>
    
</body>
</html>