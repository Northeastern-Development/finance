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
        <h2>Finance Division</h2>
        <div>
            <p>How can we better serve you? Contact us at <a title="Email the Finance Division" aria-label="Email the Finance Division" href="mailto:financehelp@northeastern.edu">financehelp@northeastern.edu</a> with questions and comments</p>

        </div>
    </section>

    <section>
    
    
        <h2>EthicsPoint</h2>
        <p>Northeastern University contracts with the company EthicsPoint to provide an anonymous and confidential reporting tool to all members of the university community. To report potentially unethical or inappropriate activities or behaviors that may violate Northeastern’s policies and procedures, go to <a title="View EthicsPoint [will open in a new tab/window]" target="_blank" href="https://secure.ethicspoint.com/domain/media/en/gui/32115/index.html">EthicsPoint</a> or call <a title="Call EthicsPoint" href="tel:8553509390">855.350.9390</a></p>
        
    </section>
    
    
    
    <section class="related-items">
        <h2>Contact Staff</h2>
        <?php include(locate_template('loops/loop-departments.php')); ?>
    </section>

</main>
<?php 
    get_footer();
 ?>