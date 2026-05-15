<?php
    if(isset($_GET['url']) && !empty($_GET['url']) && filter_var($_GET['url'], FILTER_VALIDATE_URL)){
        $Plugins = [];
        $url= $_GET['url'];
        $html = scraper($url);


        preg_match_all('/wp-content\/plugins\/(.*?)\//', $html, $matches1);
        preg_match_all('/wp-content\/app\/(.*?)\//', $html, $matches2);
        preg_match_all('/plugins\/(.*?)\//', $html, $matches3);
        preg_match_all('/app\/plugins\/(.*?)\//', $html, $matches4);


        // Si des commentaires sont trouvés, les ajouter à la liste
        if (!empty($matches1[1])) {
            foreach ($matches1[1] as $UnPLugin) {
                if(!in_array($UnPLugin,$Plugins)){
                $Plugins[] = trim($UnPLugin);
                }
            }
        }
        if (!empty($matches2[1])) {
            foreach ($matches2[1] as $UnPLugin) {
                if(!in_array($UnPLugin,$Plugins)){
                $Plugins[] = trim($UnPLugin);
                }
            }
        }
        if (!empty($matches3[1])) {
            foreach ($matches3[1] as $UnPLugin) {
                if(!in_array($UnPLugin,$Plugins)){
                $Plugins[] = trim($UnPLugin);
                }
            }
        }
        if (!empty($matches4[1])) {
            foreach ($matches4[1] as $UnPLugin) {
                if(!in_array($UnPLugin,$Plugins)){
                $Plugins[] = trim($UnPLugin);
                }
            }
        }
    }
?>