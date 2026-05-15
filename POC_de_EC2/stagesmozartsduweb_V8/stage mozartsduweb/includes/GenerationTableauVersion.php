<?php

$tabVersion = [];

function scraper ($url) {
    //permet de récupérer le contenu d'une page
        // User Agent
        $ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:97.0) Gecko/20100101 Firefox/97.0';
        $ch = curl_init();
        if (preg_match('`^https://`i', $url))
        {//pour les URLs en HTTPS
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        // le scraper suit les redirections
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $resultats = curl_exec($ch);
        curl_close ( $ch );
        return $resultats;
    }
    $resultat = scraper("https://fr.wordpress.org/download/releases/");

    function recupVersion($resultat){
        $tabVersion = [];
        $delimiteurs = ['<','>'];
        $leNouveauDelimiteur ="µ";
        $LeCodeSource = $resultat;
        $ListeElementsCodeSource = str_replace($delimiteurs, $leNouveauDelimiteur, $LeCodeSource);
        $ElementsDeLaPage = explode($leNouveauDelimiteur, $ListeElementsCodeSource);
        foreach($ElementsDeLaPage as $element){
            if( strlen($element) > 3 && strlen($element) < 7 && str_contains($element, ".") && (str_contains($element, "2") || str_contains($element, "3") || str_contains($element, "4") || str_contains($element, "5") || str_contains($element, "6") || str_contains($element, "7") || str_contains($element, "8") || str_contains($element, "9") || str_contains($element, "1") || str_contains($element, "0"))){
                if(!in_array($element,$tabVersion)){
                    $tabVersion[] = $element;
                }
            }
        }

        return $tabVersion;
    }
    $tabVersion = recupVersion($resultat);
    
?>
