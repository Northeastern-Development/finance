<?php 
/**
 * Template Name: Home Page
 */


    get_header();
?>
<main role="main">
    <section>
        <?php include(locate_template('loops/loop-deadlines.php')) ?>
    </section>
</main>
<?php 
    get_footer();
 ?>