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

    
    <section>
        <h2>One Centralized Department</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quibusdam sed iusto. Accusamus vero, delectus suscipit quas, vel fuga sint magni ab eaque, placeat illo ipsam sequi aut ullam iste.</p>
        <a href="mailto:test@replacethis.com">
            <i class="material-icons">mail</i><span>email</span>
        </a>
    </section>

    <section>
        <h2>EthicsPoint</h2>
        <p>Northeastern University uses and independent, third-part company, EthisPoint, to provide an anonymous and confidential tool for all members of the university community to TK.</p>
        <a href="tel:855-350-9390">
            <i class="material-icons">phone</i><span>855.350.9390</span>
        </a>
        <a href="http://dummycontent.com">
            <i class="material-icons">arrow_forward</i><span>EthicsPoint Online</span>
        </a>
    </section>
    
    
    
    <section class="overview-depts">
        <h2>Contact Staff</h2>
        <?php include(locate_template('loops/loop-departments.php')); ?>
    </section>



    <?php 
    /**
     *      Conditionally Enabled Sections Below
     */
     ?>
    <section class="heretohelp">
        <?php if( !empty($fields['helpers']) ){ include(locate_template('loops/reusable/loop-heretohelp.php')); } ?>
    </section>
    <section>
        <?php if( !empty($fields['faqs']) ){ include(locate_template('loops/reusable/loop-faqs.php')); } ?>
    </section>
     

</main>
<?php 
    get_footer();
 ?>