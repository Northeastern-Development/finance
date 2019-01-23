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

    // This Latest Update's Fields
    $the_fields = get_fields($posts[0]);

    $content_update = '';
    // This Latest Update is a EVENT
    if( $the_fields['type'] == 'event' ){
        $format_update = '<p>%s</p><p>%s</p><p>%s</p><p>%s</p>';
        $content_update .= sprintf(
            $format_update
            ,'Start Date: ' . $the_fields['start_date']
            ,'End Date: ' . $the_fields['end_date']
            ,'Start Time: ' . $the_fields['start_time']
            ,'End Time: ' . $the_fields['end_time']
        );   
    }

    // This Latest Update is a NEWS item
    else if( $the_fields['type'] == 'news') {
        $format_update = '
            <h1>%s</h1>
            <h3>%s</h3>
            <div class="neu__bgimg"><div style="background-image: url(%s)"></div></div>
            <div>%s</div>
        ';
        $content_update = sprintf(
            $format_update
            ,$posts[0]->post_title
            ,( get_fields($the_fields['category']->ID)['status'] == true )
                ? $the_fields['category']->post_title
                : null
            ,$the_fields['image']
            ,$the_fields['details']
        );   
    }
    get_header();
 ?>
 <main role="main">     
     <section>
         <?php echo $content_update; ?>
     </section>
 </main>
<?php 
    get_footer();
?>