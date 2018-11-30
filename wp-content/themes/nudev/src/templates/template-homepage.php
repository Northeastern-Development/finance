<?php 
/**
 * Template Name: Home Page
 */


    get_header();
?>
<div role="main" class="main">
    <section>
        <?php include(locate_template('loops/loop-deadlines.php')) ?>
    </section>
</div>
<?php 
    get_footer();
 ?>