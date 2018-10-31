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

    $content = '';
    $guide = '<p><a href="%s" title="More Information about (toolname)" target="_blank">%s</a></p>';

    foreach( $tools as $post ){
        $fields = get_fields($post);

        $content .= sprintf(
            $guide
            ,get_permalink($post) . seoUrl($fields['groupings'][0]['title'])
            ,$post->post_title
        );
        
    }


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