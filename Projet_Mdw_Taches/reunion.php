<!DOCTYPE html>
<html lang="fr">
<?php 
$username = '116313_mdauguet';
$password = 'DogMar0504_';
$name = 'lyceestvincent_mdauguet';
$pdo = new PDO("mysql:host=mysql-lyceestvincent.alwaysdata.net;dbname=$name", $username, $password);
$requete ="SELECT COUNT(*) FROM taches_mdw WHERE id_reu=:id";
$preparation = $pdo ->prepare($requete);
$preparation -> bindParam(":id", $_GET["id_reu"]);

$preparation->execute();
$nbtachesreunion = $preparation->fetch();

    

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="maphoto.webp" type="image/jpg">
    <title>Reunion n°<?php echo $_GET["id_reu"]; echo " (".$nbtachesreunion[0].")"; ?></title>
</head>
<body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('.task-checkbox');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var taskId = this.getAttribute('data-id');
                var checked = this.checked;

                // Envoyer l'état de la case à cocher via AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_checkbox.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status !== 200) {
                        alert('Une erreur est survenue lors de la mise à jour de la case à cocher.');
                    }
                };
                xhr.send('id=' + taskId + '&checked=' + (checked ? 1 : 0));
            });
        });
    });
    </script>

    <?php
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
    
    $id = intval($_GET["id_reu"]);

    $requete = "SELECT * FROM reunions_mdw WHERE id=:id_reu;";
    $preparation = $pdo ->prepare($requete);
    $preparation -> bindParam(":id_reu", $id);

    $preparation->execute();
    $InfoReunion = $preparation->fetchAll();
    ?>
    <header>
        <a href="index.php"><button class="btn btn3"><span>Retour aux tâches</span></button></a>
        <h1 class="titrereu">Reunion n°<?php echo $id." crée le ".date('d/m/Y', strtotime($InfoReunion[0]["created_at"])); ?></h1>
        
    </header>
    <div class="LesTaches">
        <table>
            <tbody>
                <tr class="LesTitresTab">
                    <th>Titre</th>
                    <th>Description</th>
                    <th colspan="2">Actions</th>
                </tr>
                <?php
                $requete = "SELECT * FROM taches_mdw WHERE id_reu=:id_reu ORDER BY id DESC;";
                $preparation = $pdo ->prepare($requete);
                $preparation -> bindParam(":id_reu", $id);
        
                $preparation->execute();
                $lestaches = $preparation->fetchAll();
                for($i=0;$i<count($lestaches);$i++){
                    if($lestaches[$i]['checked']=== "1"){
                        $check = "checked";
                    }
                    else{
                        $check="";
                    }
                    if(isset($_GET['modification']) && $_GET['modification'] === strval($lestaches[$i]['id'])){
                        $titreMod = getValue($pdo,'titre');

                        $descMod = getValue($pdo,'desc');

                        echo"<tr>";
                        echo '<form method="post">';
                        echo"<th class='titreTab'><input type='text' name='NewName' value='".$titreMod."'></th>";
                        echo"<th class='descTab'><textarea class='textarea_ajout' type='text' name='NewDesc'>$descMod</textarea></th>";
                        echo '<th><input class="checkbox task-checkbox" type="checkbox" data-id="'.$lestaches[$i]['id'].'" '.($lestaches[$i]['checked'] ? 'checked' : '').'></th>';
                        echo "<th><a href=''><button class='lesactions' type='submit'><img src='modifier.png'></button></a></th>";
                        echo"</tr>";
                        echo '</form>';
                    }
                    else{
                    
                        echo"<tr>";
                        echo"<th class='titreTab'><p>".$lestaches[$i]['name']."</p></th>";
                        echo"<th class='descTab'><p>".$lestaches[$i]['description']."</p></th>";
                        echo '<th><input class="checkbox task-checkbox" type="checkbox"'.$check.' data-id="'.$lestaches[$i]['id'].'" '.($lestaches[$i]['checked'] ? 'checked' : '').'></th>';
                        echo '<th><a href="reunion.php?id_reu='.$_GET['id_reu'].'&modification='.$lestaches[$i]['id'].'"><button class="lesactions"><img src="modifier.png"></button></a></th>';
                        echo"</tr>";
                    }
                }

                ?>

            </tbody>
        </table>
        <?php
        $date = date("y-m-d");
        $requete ="SELECT id FROM reunions_mdw WHERE created_at=:date";
        $preparation = $pdo ->prepare($requete);
        $preparation -> bindParam(":date", $date);

        $preparation->execute();
        $IdReunionDate = $preparation->fetch();
        if(!empty($IdReunionDate) && $_GET['id_reu'] === $IdReunionDate[0]){
            echo '<h1 class="titrereu">Ajouter une tâche à la reunion</h1>';
            echo '<table>';
            echo '<tr class="LesTitresTab">
                    <th>Titre</th>
                    <th>Description</th>
                    <th colspan="1">Action</th>
                </tr>';
            echo"<tr>";
            echo '<form method="post">';
            echo"<th class='titreTab'><input type='text' name='LeTitre'></th>";
            echo"<th class='descTab'><textarea class='textarea_ajout' type='text' name='LaDescription'></textarea></th>";
            echo '<th><a href="reunion.php?id_reu="><button class="lesactions"><img src="ajouter.webp"></button></a></th>';
            echo '</form>';
            echo"</tr>";
            
            echo '</table>';
        }
        
        ?>
    </div>
</body>
</html>