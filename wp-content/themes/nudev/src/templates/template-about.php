<?php 
/**
 * Template Name: About
 */

    $fields = get_fields($post_id);
    get_header();
?>
<main role="main">
    <?php 
        $fields = get_fields($post_id);
        echo PageHero::return_pagehero($fields);
    ?>


    <?php include(locate_template('loops/loop-staff-president.php')); ?>


    <section class="fullwidth nobg">
        <h2>Our Departments</h2>

        <?php include(locate_template('loops/loop-departments.php')); ?>
        
    </section>


    
</main>
<?php 
    get_footer();
 ?>