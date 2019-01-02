<?php 
/**
 * Template Name: News and Events Item
 */

    // get the query vars
    $the_item = $wp_query->query_vars['newsitem'];

    // get the (item) posts
    $args = array(
        'name' => $the_item,
        'posts_per_page' => 1,
        'post_type' => 'newsevents-items',
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    $posts = get_posts($args);

    // if no post name matches url structure, redirect to home page
    if( empty($posts[0]) ){
        wp_redirect( home_url() );
    }

    $the_fields = get_fields($posts[0]);


    // check news/event type (is event)
    if( $the_fields['type'] == 'event' ){
        $format_event = '<p>%s</p><p>%s</p><p>%s</p><p>%s</p>';
        $content_event = '';
        $content_event .= sprintf(
            $format_event
            ,'Start Date: ' . $the_fields['start_date']
            ,'End Date: ' . $the_fields['end_date']
            ,'Start Time: ' . $the_fields['start_time']
            ,'End Time: ' . $the_fields['end_time']
        );   
    }

    $content_item = '';
    $format_item = '
        <div>
            <p>Type: %s</p>
            <p>Category: %s</p>
            <p>Details: </p>
            <p>%s</p>
            <div>
                %s
            </div>
        </div>
    ';
    $content_item .= sprintf(
        $format_item
        ,$the_fields['type']
        ,$the_fields['category']->post_title
        ,str_replace( ['<p>', '</p>'], ['<span>', '</span>'], $the_fields['details'])
        ,( $the_fields['type'] == 'event' ) ? $content_event : null

    );

    get_header();
 ?>
 <main role="main">

    <?php 
        $fields = get_fields($post_id);
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields, $posts[0]->post_title);
     ?>
     
     <section>
         <?php echo $content_item; ?>
     </section>
 </main>
<?php 
    get_footer();
?>