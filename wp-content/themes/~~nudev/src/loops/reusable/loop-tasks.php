<?php 
/**
 * Reusable Loop: Tasks
 * Basic Tasks Query by Department
 * 
 *  Not expressed in the theme
 * 
 */
// get all active task categories
$args = array(
    'post_type'         =>  'tasks_categories',
    'posts_per_page'    =>  -1,
    'meta_query'        => array(
        array(
            'key'       => 'status',
            'value'     => '1',
            'compare'   => '='
        )
    )
);
$cats = get_posts($args);
// Set : wrapper around loop, format strings
$content_cats = '';
$format_tasks = '<li><a href="%s" title="%s" aria-label="%s">%s</a></li>';
$format_cats = '<ul><h2>%s</h2>%s</ul>';
// loop thru each task category
foreach( $cats as $cat )
{
    // Get : all tasks that are assigned to the current department, are active, and in 'this' category, 
    $args = array(
        'post_type' => 'tasks',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            ),
            array(
                'key' => 'category',
                'value' => $cat->ID,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'department',
                'value' => get_page_by_path($filter, OBJECT, 'departments')->ID,
                'compare' => 'LIKE'
            )
        )
    );
    $tasks = get_posts($args);
    // (re)Set: string of all tasks in this category as line items 
    $content_tasks = '';

    foreach( $tasks as $task ){
        $content_tasks .= sprintf(
            $format_tasks
            ,site_url('/tasks/') . $cat->post_name.'/'.$task->post_name
            ,$task->post_title
            ,$task->post_title
            ,$task->post_title
        );
    }
    // Set : merge the entire tasks string into the category string
    $content_cats .= sprintf(
        $format_cats
        ,$cat->post_title
        ,$content_tasks
    );
}
// Write: each category and its tasks
echo $content_cats;
?>