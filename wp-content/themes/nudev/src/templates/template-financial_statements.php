<?php
/**
 * Template Name: Financial Statements
 */

    // get fields for this page
    $fields = get_fields($post->ID);
    
    // get the hero
    $hero = PageHero::return_pagehero($fields);

    // get financial statements posts
    $args = array(
        'post_type' => 'financial_statements'
        ,'posts_per_page' => -1
        ,'meta_query'   => array(
            array(
                'key'       => 'status',
                'value'     => '1',
                'compare'   => '='
                )
            )
    );
    $res = get_posts($args);

    if( !empty($res) ){
        
        $content_fstate = '<section>';
        
        // format string financial statement
        $format_fstate = '
            <a target="_blank" title="Download %s (opens in a new window)" aria-label="Download %s" href="%s">
                <span>%s</span>
            </a>
        ';

        foreach( $res as $rec ){

            $fields = get_fields($rec);

            $content_fstate .= sprintf(
                $format_fstate
                ,$rec->post_title
                ,$rec->post_title
                ,$fields['file']['url']
                ,$rec->post_title
            );
        }

        $content_fstate .= '</section>';

    }

    get_header();
?>
<main id="financialstatements" role="main">

    <?php 
        // echo the page hero
        echo $hero;

        echo $content_fstate;
    ?>

    <section>
        <?php 
            // FAQ,
            if( !empty($fields['faqs']) ){
                include(locate_template('loops/reusable/loop-faqs.php'));
            }
         ?>
    </section>
    <section class="fullwidth nobg">
        <?php 
            // HelpfulLinks,
            if( $fields['use_pre-footer'] == '1' ){
                include(locate_template('includes/prefooter.php'));
            }
         ?>
    </section>
    <section class="nu__team-list">
        <?php 
            if( !empty($fields['helpers']) ){
                include(locate_template('loops/reusable/loop-heretohelp.php'));
            }
        ?>
    </section>
    
</main>

<?php
get_footer();
 ?>
