<?php 
/**
 * Template Name: News and Events Index
 * Description: This page displays a single news or event item that is categorized
 */  
    get_header();
 ?>
<main role="main" >
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