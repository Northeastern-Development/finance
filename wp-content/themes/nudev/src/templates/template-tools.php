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

if( $isPost && $theGrouping == 'null' ){
    wp_redirect( home_url('tools') );
    exit;
}
if( $isPost && $theGrouping ){
    include(locate_template('templates/template-tools-item.php'));
}
else {
    include(locate_template('templates/template-tools-index.php'));
}

?>