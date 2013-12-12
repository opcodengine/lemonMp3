<?php

/*
 * lemonMp3 - simple php mp3 scraper based on lemonScrap.
 * by sphinxid
 * 01/25/2013
 */

include './lib/lemonScrap.php';
include './lemonUserAgent.php';

function lemonScrapMp3Wrapper($targetURL, $rules1, $rules2 = '') {
    
    global $myUserAgent;
    
    $ls = new LemonScrap();
    $ls->setFirstURL($targetURL);
    $ls->setUserAgent($myUserAgent[array_rand($myUserAgent)]);
    $ls->setRules($rules1);
    $ls->scrap();
    
    $data[0] = $ls->getResults();
    
    if(!empty($rules2)) {
        foreach($data1['url'] as $url) {    
            $ls2 = new LemonScrap();
            $ls2->setFirstURL($url);
            $ls2->setUserAgent($myUserAgent[array_rand($myUserAgent)]);
            $ls2->setRules($rules2);
            $ls2->scrap();
            
            $data[1][] = $ls2->getResults();
            unset($ls2);
        } 
    }
    unset($ls);
    return $data;
}

function json_js_php($string){

    $string = str_replace("{",'{"',$string);
    $string = str_replace(":'",'":"',$string);
    $string = str_replace("',",'","',$string);
    $string = str_replace("'}",'"}',$string);
    return $string;

}
