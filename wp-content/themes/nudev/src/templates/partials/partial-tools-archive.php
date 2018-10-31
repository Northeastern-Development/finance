<?php 


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

    $content = '<ul class="tools-grid">';


    $guide ='
        <li class="tools-grid-tool">
            <a href="%s" target="_blank">
                <figure>
                    <img src="%s" alt="">
                </figure>
                <h5>%s</h5>
                <h6>%s</h6>
                <p>%s</p>
                <p>Learn More</p>
            </a>
        </li>
    ';

    foreach( $tools as $post ){

        
        $fields = get_fields($post);

        $content .= sprintf(
            $guide
            ,get_permalink($post) . seoUrl($fields['groupings'][0]['title'])
            ,wp_get_attachment_image_src($fields['image'])[0]
            ,$post->post_title
            ,$fields['sub_title']
            ,$fields['short_description']
        );

    }
    $content .= '</ul>';




    get_header();
 ?>
<main id="tools">
    <section>
        <?php 
            echo '<h1>' . $post->post_title . '</h1>';
            echo $content;
         ?>
        <?php 
            $fields = get_fields($post->ID);
            
            // FAQ,
            if( !empty($fields['faqs']) ){
                include(locate_template('loops/reusable/loop-faqs.php'));
            }

            // Here2Help,
            if( !empty($fields['helpers']) ){
                include(locate_template('loops/reusable/loop-heretohelp.php'));
            }

            // HelpfulLinks,
            if( $fields['use_pre-footer'] == '1' ){
                include(locate_template('includes/prefooter.php'));
            }
        
         ?>
    </section>
</main>
<?php 
    get_footer();
 ?>