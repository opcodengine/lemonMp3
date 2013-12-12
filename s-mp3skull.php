<?php

/*
 * lemonMp3 - simple php mp3 scraper based on lemonScrap.
 * by sphinxid
 * 01/25/2013
 */

include_once 'lemonScrapWrapper.php';

//$key = 'lighters';
$key = urlencode($key);

$targetURL = "http://www.mp3skull.me";
$targetPath = "/search.html?q=[STRING]";

$newURL = $targetURL.$targetPath;
$newURL = str_replace('[STRING]', $key, $newURL);

$rules1 = array();

$rules1[] = array(
    'startFrom' => '<ul class="list_song">',
    'max' => 20,
    'key' => 'title',

    'regex' => array(
                '%<h3><a href=".+?" title="(.+?)">%s',
    ),
    'filters' => array('trim' => TRUE)        
);

$rules1[] = array(
    'startFrom' => '<ul class="list_song">',
    'max' => 20,
    'key' => 'url',
    'regex' => array(
                '%<a title="Download.+?" href="(.+?)" >Download</a>%s',
    ),
    'filters' => array('trim' => TRUE)        
);


// ----------------------------------------------------------------------------- //

$tmpData = lemonScrapMp3Wrapper($newURL, $rules1);
//print_r($tmpData);
$n = 0;
foreach($tmpData[0]['title'] as &$t) {
    $t = trim(str_replace('  ',' ', $t));
    $str['title'][$n] = $t;
    $t = trim(str_replace(' ','_', $t));
    $str['url'][$n] = $tmpData[0]['url'][$n].'/'.urlencode($t);
    $n++;
}
$data[] = $str;

unset($str);
unset($tmpData);

//print_r($data);
// ----------------------------------------------------------------------------- //
