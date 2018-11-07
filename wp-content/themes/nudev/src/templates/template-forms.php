<?php 
/**
 * Template Name: Forms
 */
    get_header();

 ?>
<main id="forms" role="main">
<section class="forms">
    <?php 
        include(locate_template('loops/loop-forms.php'));
     ?>
    <?php 
        $fields = get_fields($post->ID);
        include(locate_template('includes/prefooter.php'));
     ?>
</section>
</main>

<?php 

get_footer();

?>