<?php 
/**
 * Template Name: News and Events Index
 */  
    get_header();
 ?>
<main>
    <?php 
        $fields = get_fields($post_id);
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields);
     ?>
    
    <section>
        
        <ul class="newsandevents">
            <?php 
                include(locate_template('loops/loop-news-archive-refactored.php'));
            ?>
        </ul>

    </section>
</main>
<?php 
    get_footer();
 ?>