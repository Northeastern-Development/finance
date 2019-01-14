<?php 
/**
 * Template Name: Contact Us
 */
    get_header();
 ?>
<main>
    <?php 
        $fields = get_fields($post_id);
        echo PageHero::return_pagehero($fields, $toolpost['post_title'], null);
     ?>

    
    <section>
        <h2>One Centralized Department</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quibusdam sed iusto. Accusamus vero, delectus suscipit quas, vel fuga sint magni ab eaque, placeat illo ipsam sequi aut ullam iste.</p>
        <a class="neu__iconlink" href="mailto:test@replacethis.com">
            <i class="material-icons">mail</i><span>email</span>
        </a>
    </section>

    <section>
    
    
        <h2>EthicsPoint</h2>
        <p>Northeastern University uses and independent, third-part company, EthisPoint, to provide an anonymous and confidential tool for all members of the university community to TK.</p>
        <a class="neu__iconlink" href="tel:855-350-9390">
            <i class="material-icons">phone</i><span>855.350.9390</span>
        </a>
        <a class="neu__iconlink" href="http://dummycontent.com">
            <i class="material-icons">arrow_forward</i><span>EthicsPoint Online</span>
        </a>
    </section>
    
    
    
    <section>
        <h2>Contact Staff</h2>
        <?php include(locate_template('loops/loop-departments.php')); ?>
    </section>

</main>
<?php 
    get_footer();
 ?>