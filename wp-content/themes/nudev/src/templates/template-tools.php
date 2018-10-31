<?php 
/**
 * Template Name: Tools
 */
function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

$isPost = $wp_query->query_vars['toolname'];
$theGrouping = $wp_query->query_vars['toolgroup'];

if( $isPost ){
    include(locate_template('templates/partials/partial-tools-single.php'));
}
else {
    include(locate_template('templates/partials/partial-tools-archive.php'));
}



?>