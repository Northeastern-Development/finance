<?php 


    $args = array(
        'post_type' => 'tools',
        'posts_per_page' => -1,
        'meta_query' => array(
            'key' => 'status',
            'value' => '1',
            'compare' => '='
            
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

    // [0] => status [1] => categories [2] => image [3] => sub_title [4] => short_description [5] => full_description [6] => custom_link [7] => external_link [8] => groupings 
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
        <?php echo $content; ?>
    </section>
</main>
<?php 
    get_footer();
 ?>