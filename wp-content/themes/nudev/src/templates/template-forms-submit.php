<?php 
/**
 * Template Name: Forms Submit
 */
    $fields = get_fields(get_the_ID());
    $return['form'] = '';
    // data check
    if( !empty($_GET['form_id']) ){
        // try to get a post
        if( !empty( get_post( $_GET['form_id'] ) ) ){
    
            // we found a wpform post
            // continue,
            $guide['form'] = '%s';
            $return['form'] .= sprintf(
                $guide['form']
                ,do_shortcode('[wpforms id="'.$_GET['form_id'].'" title="false" description="false"]')
            );
        }
    }
    get_header();
 ?>
<main class="main" id="forms-submit">
    
    <?php 
        // lets not use the hero space on this
        //    echo PageHero::return_pagehero($fields);
     ?>
    
    <section>
        <?php 
            echo $return['form'];
        ?>
    </section>
 
</main>

<?php 

get_footer();

?>