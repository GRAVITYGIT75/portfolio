<?php
$username = '116313_mdauguet';
$password = 'DogMar0504_';
$name = 'lyceestvincent_mdauguet';
$pdo = new PDO("mysql:host=mysql-lyceestvincent.alwaysdata.net;dbname=$name", $username, $password);
if (isset($_POST['id']) && isset($_POST['checked'])) {
    $id = intval($_POST['id']);
    $checked = boolval($_POST['checked']);

    $requete = "UPDATE taches_mdw SET checked = :checked WHERE id = :id";
    $preparation = $pdo->prepare($requete);
    $preparation->bindParam(':id', $id);
    $preparation->bindParam(':checked', $checked, PDO::PARAM_BOOL);

    if ($preparation->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>