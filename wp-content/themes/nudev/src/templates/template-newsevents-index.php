<?php 
/**
 * Template Name: News and Events Index
 */  
    get_header(); 
 ?>
<main>
    <?php 
        $fields = get_fields($post_id);
        echo PageHero::return_pagehero($fields);
     ?>
    
    <section class="fullwidth nobg">
        
        <ul class="newsandevents">
            <?php 
                include(locate_template('loops/loop-newsevents.php'));
            ?>
        </ul>

    </section>
</main>
<?php 
    get_footer();
 ?>