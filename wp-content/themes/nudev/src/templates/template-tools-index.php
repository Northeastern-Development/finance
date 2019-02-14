<?php 
/**
 * Template Name: Tools Index
 */
    // Get Active Tool Posts
    $args = array(
        'post_type' => 'tools',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        ),
    );
    $tools = get_posts($args);

    // Wrapper:
    $content = '<ul class="tools-grid">';

    $guide ='
        <li class="tools-grid-tool">
            <a href="%s" title="%s" aria-label="%s">
                <div class="neu__bgimg"><div style="background-image: url(%s)"></div></div>
                <h5>%s</h5>
                <h6>%s</h6>
                <p>%s</p>
            </a>
        </li>
    ';


    $tools = array_filter($tools, function($tool){
        $fields = get_fields($tool);
        // check that we have a grouping with active status and a title
        foreach( $fields['groupings'] as $grouping ){
            if( $grouping['status'] == 1 && !empty($grouping['title']) ){
                return $tool;
            }
        }
    });

    foreach( $tools as $tool ){
        $fields = get_fields($tool);

        $content .= sprintf(
            $guide
            ,get_permalink($tool) . seoUrl($fields['groupings'][0]['title'])
            ,'View more information about ' . $tool->post_title
            ,'View more information about ' . $tool->post_title
            ,$fields['image']
            ,$tool->post_title
            ,$fields['sub_title']
            ,$fields['short_description']
        );
    }
    $content .= '</ul>';

    get_header();
?>
<main role="main">

    <?php 
        $fields = get_fields($post_id);
        echo PageHero::return_pagehero($fields);
     ?>
    
    
    <section class="fullwidth nobg">
        <?= $content ?>
    </section>
    
    <section>
        <?php 
            // FAQ,
            if( !empty($fields['faqs']) ){
                include(locate_template('loops/reusable/loop-faqs.php'));
            }
         ?>
    </section>

    <section>
        <?php
            // HelpfulLinks,
            if( $fields['use_pre-footer'] == '1' ){
                include(locate_template('includes/prefooter.php'));
            }
         ?>
    </section>

    <section class="heretohelp">
        <?php 
             // heretohelp,
             if( !empty($fields['helpers']) ){
                include(locate_template('loops/reusable/loop-heretohelp.php'));
            }
         ?>
    </section>

    
</main>
<?php 
    get_footer();
 ?>

