<?php 
/**
 * Template Name: Forms
 */

    $fields = get_fields($post_id);
    get_header();
 ?>
<main class="main" id="forms">
    
    <?php 
        echo PageHero::return_pagehero($fields);
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