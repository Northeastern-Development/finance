<?php 
/**
 * Template Name: Discounts
 */
$fields = get_fields($post_id);
get_header();
?>
<main role="main" id="discounts">
    <?php
        // get hero space if enabled
        if( $fields['use_hero'] == '1' ){
            include(locate_template('includes/pagehero.php'));
        }
     ?>
    <section>
        <?php include(locate_template('loops/loop-discounts.php')); ?>
    </section>
</main>
<?php 
get_footer();
 ?>