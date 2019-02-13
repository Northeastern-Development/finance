<?php
/**
 *  Conditional Partial : Staff Page
 *  Render the "Filter" Nav
 *      lists all departments
 */


// get all active departments
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
$departments = get_posts($args);


// write each department title ( with exceptions ) into the switch-department filter
$return = '';
if( !empty($departments) ){
    $format_dept = '
        <li>
            <a class="%s" href="%s" title="%s">%s <span>&#xE313;</span></a>
        </li>
    ';
    foreach ($departments as $dept) {
        // ignore 'president' section
        if( $dept->post_name != 'president' ){
            $return .= sprintf(
                $format_dept
                ,( $filter == $dept->post_name ) ? 'active' : null
                ,site_url('/staff/' . $dept->post_name)
                ,'Filter to show ' . $dept->post_title . ' team'
                ,$dept->post_title
            );
        }
    }
}
echo $return;
?>
