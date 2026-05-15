<?php
if(isset($_GET['url']) && !empty($_GET['url']) && filter_var($_GET['url'], FILTER_VALIDATE_URL)){
    $LesSeo = [];
    $url= $_GET['url'];
    $html = scraper($url);

    preg_match_all('/<!--(.*?) SEO/', $html, $matches1);

    if (!empty($matches1[1])) {
        foreach ($matches1[1] as $UnSeo) {
            if(!in_array($UnSeo,$LesSeo) && strlen($UnSeo) < 15){
                $UnSeo = str_replace("/", "", $UnSeo);
                $LesSeo[] = trim($UnSeo);
            }
        }
    }
}