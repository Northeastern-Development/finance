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
    $format_depts = '
        <li>
            <a href="%s" title="Click to view department">
                <i class="material-icons">arrow_forwards</i><h4>%s</h4>
            </a>
        </li>
    ';

    foreach( $res as $rec ){
        $content_depts .= sprintf(
            $format_depts
            ,get_permalink($rec->ID)
            ,$rec->post_title
        );
    }
?>
<ul>
    <?= $content_depts; ?>
</ul>