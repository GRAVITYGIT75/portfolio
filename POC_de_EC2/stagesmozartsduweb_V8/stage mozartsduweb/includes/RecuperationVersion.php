<?php

$LaVersion = "";

function recupVersionSite($page){
    $html = scraper($page);

    preg_match('/<meta name="generator" content="WordPress (.+?)" \/>/', $html, $matches);
    if(!empty($matches[1])){
        $current_version = $matches[1];
    }
    else{
        $current_version = "null";
    }
    return $current_version;

}
$LaVersion = recupVersionSite($_GET['url']);
?>