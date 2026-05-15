<?php
if(isset($_GET['url']) && !empty($_GET['url'])){
    include_once 'includes/GenerationTableauVersion.php';
    include_once 'includes/RecuperationVersion.php';
    function calculerScore($LaVersion, $listeVersionBrancheActuelle, $listeVersionsMajeures, $tabVersion) {
        $score = 0;
        

        // Vérifier si la version actuelle est différente de la dernière version de la branche actuelle

        if ($listeVersionBrancheActuelle !== $LaVersion) {
            $score += 2;
            
        }
        
        // Vérifier si la version majeure est supérieure de plus de 2 versions par rapport à la version actuelle
        $brancheActuelle = substr($LaVersion, 0, 3); // Exemple: "5.3" pour "5.3.1"
        $versionsMajeuresCount = count($listeVersionsMajeures);
        $positionBrancheActuelle = array_search($brancheActuelle, $listeVersionsMajeures);

        if ($positionBrancheActuelle !== false && ($positionBrancheActuelle) > 0) {
            $score += $positionBrancheActuelle*3;
            
            
        }

        // Vérifier si la version mineure est supérieure ou égale à 10 par rapport à l'indice de version actuel
    
        $versionIndex = array_search($LaVersion, $tabVersion);
        if ($versionIndex !== false || $versionIndex >= 10) {
            
            $score += $versionIndex; 
            
        }

        return $score;
    }
    $score = calculerScore($LaVersion,$listeVersionBrancheActuelle[0],$listeVersionsMajeures, $tabVersion);
    // Afficher le score
    echo "<h1 class='score'>Votre site a un score de " . $score . " point(s).</h1>";


}
