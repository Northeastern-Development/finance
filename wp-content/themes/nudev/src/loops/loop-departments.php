<?php 
/**
 *  Loop: List Departments
 *  Description: iterate thru department posts and render a ul > li > a list of links
 */
    $args = array(
        'post_type' => 'departments',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    $res = get_posts($args);

    if( get_page_template_slug($post_id) == 'templates/template-about.php' ){
        $format_depts = '
            <li>
                <a href="%s" title="Click to view department">
                    <h3>%s</h3>
                    <img src="%s">
                </a>
            </li>
        ';
        foreach ($res as $rec) {
            $fields = get_fields($rec->ID);
            $content_depts .= sprintf(
                $format_depts,
                get_permalink($rec->ID),
                $rec->post_title,
                $fields['featured_image']
            );
        }
    }
    else if( get_page_template_slug($post_id) == 'templates/template-contact.php' ){

        $format_depts = '
            <li>
                <a class="neu__iconlink" href="%s" title="Click to view %s Department">
                    <i class="material-icons">arrow_forward</i><span>%s</span>
                </a>
            </li>
        ';

        foreach( $res as $rec ){
            $content_depts .= sprintf(
                $format_depts
                ,get_permalink($rec->ID)
                ,$rec->post_title
                ,$rec->post_title
            );
        }

    }
    
    
?>
<ul>
    <?= $content_depts; ?>
</ul>