<?php 
/**
 * Template Name: Overview
 * Description: The CFO Overview Page
 */
    $fields = get_fields($post_id);
    get_header();
?>
<main>


    <?php 
        $fields = get_fields($post_id);
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields);
     ?>

    <section>
        <h2>Our Mission</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia ex tenetur reiciendis magnam cupiditate, error fugit odio sit fuga totam aperiam numquam deleniti natus quod aliquam libero corrupti pariatur ut?</p>
    </section>

    <section class="overview-depts">
        <h2>Departments and Staff</h2>

        <?php include(locate_template('loops/loop-departments.php')); ?>
        
    </section>

    <section class="heretohelp">
        <?php 
            // heretohelp,
            if( !empty($fields['helpers']) ){
                include(locate_template('loops/reusable/loop-heretohelp.php'));
            }
         ?>
    </section>
    <section>
    <?php 
        // HelpfulLinks,
        if( $fields['use_pre-footer'] == '1' ){
            include(locate_template('includes/prefooter.php'));
        }
     ?>
    </section>
</main>
<?php 
    get_footer();
 ?>