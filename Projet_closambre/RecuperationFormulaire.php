<?php

function RecuperationValSaisie($val){
    if(isset($_POST[$val]) && !empty($_POST[$val])){
        return $_POST[$val];
    }
    return '';

}
function IsChecked($value,$laVal){
    if(isset($_POST[$value]) && $_POST[$value]===$laVal){
        echo 'checked';
    }

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $erreurs = [];
    /* verifications champs obligatoires */
    if(isset($_POST['nom'] ) && empty($_POST['nom'])){
        $erreurs['nom'][] = "Champ obligatoire";
    }
    if(isset($_POST['prenom'] ) && empty($_POST['prenom'])){
        $erreurs['prenom'][] = "Champ obligatoire";
    }
    if(isset($_POST['email'] ) && empty($_POST['email'])){
        $erreurs['email'][] = "Champ obligatoire";
    }
    if(isset($_POST['orga_entrep'] ) && empty($_POST['orga_entrep'])){
        $erreurs['orga_entrep'][] = "Champ obligatoire";
    }
    if(isset($_POST['fonction'] ) && empty($_POST['fonction'])){
        $erreurs['fonction'][] = "Champ obligatoire";
    }
    if(!isset($_POST['presence'])){
        $erreurs['presence'][] = "Champ obligatoire";
    }
    if(isset($_POST['accompagnement']) && $_POST['accompagnement'] === "oui" && isset($_POST['accompagnateur']) && empty($_POST['accompagnateur'])){
        $erreurs['accompagnateur'][] = "Champ obligatoire";
    }

    /* verification champ format */
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
        $erreurs['email'][] = "Format email incorrect.";
    }
    if(!preg_match('/^[0-9]{10}+$/', $_POST['telephone'])){
        $erreurs['telephone'][] = "Format téléphone incorrect.";
    }
    if(!preg_match('/^[0-9]{5}+$/', $_POST['codepostale'])){
        $erreurs['codepostale'][] = "Format code postal incorrect.";
    }
}


