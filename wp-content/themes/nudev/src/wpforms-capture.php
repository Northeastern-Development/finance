<?php 
/**
 *  Name:           WPForms Capture Template
 * 
 *  This template will serve WPForms to the user.
 *  The ideal flow would be a click-thru from the /forms/ page; clicking something like 'fill this form out online'
 *  That would open in a new tab/window (arguably, in an overlay or MFP situation?)
 *      This template should then parse the URL for which form it wants to load; and load it.
 * 
*/
    

    // this page is purposefully kept OUT of the page editor in the CMS to prevent accidental issues
    require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');	// call in WP core

	// this will get the name of the staff member we are after form the URL
    $pageQuery = explode("/",$_SERVER['REQUEST_URI']);
    $formName = $pageQuery[3];

    unset($pageQuery);	// clean up
    
    get_header();
    
?>
<main>
<?php 

    print_r($formName);


?>
</main>
<?php 
get_footer();
 ?>