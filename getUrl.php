<?php 
require "vendor/autoload.php";
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Tag;


function getUrl($url)
{
    if(empty($url) OR $url == null){
       echo "Error";
    }
    $dom = new Dom;
    $dom->load($url);
    $html = $dom->outerHtml;
    $contents = $dom->find('meta');
    foreach ($contents as $content)
    {
        $propriedade = $content->getAttribute('property');
        if($propriedade == "og:video"){
            echo $content->getAttribute('content');
        }
    }
}