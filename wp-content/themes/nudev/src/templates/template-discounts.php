<?php 
/**
 * Template Name: Discounts
 */
$fields = get_fields($post_id);
get_header();
?>
<main role="main" id="discounts">
    
    <?php 
        $fields = get_fields($post_id);
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields);
     ?>
    

    <section>
        <?php include(locate_template('loops/loop-discounts.php')); ?>
    </section>
</main>
<?php 
get_footer();
 ?>