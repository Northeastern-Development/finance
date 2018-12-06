<?php 
/**
 * Template Name: Forms
 */

    $fields = get_fields($post_id);
    get_header();
 ?>
<main class="main" id="forms">
    
    <?php 
        // get hero space if enabled
        if( $fields['use_hero'] == '1' ){
            include(locate_template('includes/pagehero.php'));
        }
     ?>
    
    <section>
        <?php 
            include(locate_template('loops/loop-forms.php'));
        ?>
    </section>
    
    
    <section>
        <?php 
            $fields = get_fields($post->ID);
            include(locate_template('includes/prefooter.php'));
         ?>
    </section>
    
    
</main>

<?php 

get_footer();

?>