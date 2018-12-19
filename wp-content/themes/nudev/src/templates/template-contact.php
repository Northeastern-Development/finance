<?php 
/**
 * Template Name: Contact Us
 */
    get_header();
 ?>
<main>
    <?php 
        $fields = get_fields($post_id);
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields, $toolpost['post_title'], null);
     ?>

    <section class="heretohelp">
        <?php 
             // heretohelp,
             if( !empty($fields['helpers']) ){
                include(locate_template('loops/reusable/loop-heretohelp.php'));
            }
         ?>
    </section>
    <section class="overview-depts">
        <h2>Departments and Staff</h2>
        <?php include(locate_template('loops/loop-departments.php')); ?>
    </section>

    <section>
        <?php 
            include(locate_template('loops/reusable/loop-faqs.php'));
         ?>
    </section>
     

</main>
<?php 
    get_footer();
 ?>