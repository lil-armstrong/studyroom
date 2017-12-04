<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/6/17
 * Time: 6:41 AM
 */

function slug($string)
{
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/(&amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
    return strtolower(trim($string, '-'));
}

function quoteSlug($string){
    $string =str_replace("'", "\\'", $string);
    return strtolower(str_replace('\"', '\\"', $string));
}

function dateSlug($string){
    $string =str_replace("-", "/", $string);
    return $string;
}
function tagCorrection ($string){
    $tags = [
        '<ul'=>'</ul>',
        '<ol'=>'<ol>',
        '<p'=>'</p>',
        '<div'=>'</div>',
        '<li'=>'</li>',
        '<dl'=>'</dl>',
        '<font'=>'</font>',
        '<table'=>'</table>',
        '<td'=>'</td>',
        '<tr'=>'</tr>',
        '<span'=>'</span>',
        '"'=>'"',
        '\''=>'\'',
        '<img'=>'/>',
        '<h1'=>'<h1/>',
        '<h2'=>'<h2/>',
        '<h3'=>'<h3/>',
        '<h4'=>'<h4/>',
        '<h5'=>'<h5/>',
        '<h6'=>'<h6/>',
        '<header'=>'<header/>',
        '<section'=>'<section/>',
        '<details'=>'<details/>',
        '<aside'=>'<aside/>',
        '<nav'=>'<nav/>',
        '<blockquote>'=>'</blockquote>'];
    $correction='';
    foreach ($tags as $open => $close) {
        if(strripos( $string, $open) && (strripos( $string, $close)) < strripos( $string, $open) ){
            $correction = $close.$correction;
        }
    }
    $string .= "...".$correction;
    return $string;
}
function shortenTextWithLink($string, $cutOff, $link = NULL, $var = NULL, $id = NULL) { // Cut String
    if (strlen($string) > $cutOff) {
        // truncate string
        $stringCut = substr($string, 0, $cutOff);
        $end = readMore($link, $var, $id);
        // make sure it ends in a word so assassinate doesn't become ass...
        $correction = tagCorrection($stringCut);
        $string = $correction.$end;
    }
    return $string;
}

function readMore($link = NULL, $var = NULL, $id = NULL, $msg="Read more",$pointer=(0|1)){
    return $statement = "<a href='$link?$var=$id' class='font-md'>$msg".(($pointer===1)?"&nbsp;<i class='fa fa-chevron-circle-right'></i>" : '')."</a>";
}

function shorten($string, $len){
    if (strlen($string) > $len) {
        $stringCut = substr($string, 0, $len);
        $correction = tagCorrection($stringCut);
        $string = $correction;
    }
    return $string;
}