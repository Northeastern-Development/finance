<?php 

    $testForm = get_post('4866');

    get_header();
?>
<main>
    <section>
        <h2><?= $testForm->post_title; ?></h2>
    <?php 
        echo do_shortcode('[wpforms id="'.$testForm->ID.'" title="false" description="false"]');
     ?>
    </section>
</main>
<?php
    get_footer();
?>