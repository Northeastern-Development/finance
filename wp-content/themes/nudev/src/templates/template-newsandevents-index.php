<?php 
/**
 * Template Name: News and Events Index
 */  
    get_header();
 ?>
<main>
    <?php 
    // get hero space if enabled
        $fields = get_fields($post_id);
        if( $fields['use_hero'] == '1' ){
            include(locate_template('includes/pagehero.php'));
        }
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