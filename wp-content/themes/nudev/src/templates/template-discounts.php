<?php 
/**
 * Template Name: Discounts
 */

get_header();
?>
<main role="main" id="discounts">
    <section>
        <?php include(locate_template('loops/loop-discounts.php')); ?>
    </section>
</main>
<?php 
get_footer();
 ?>