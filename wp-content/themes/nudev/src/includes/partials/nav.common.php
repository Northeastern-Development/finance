<?php 
/**
 *  Logic / Vars etc. shared between mobile/desktop nav
 */


// get task categories
$args = array(
    'post_type'         =>  'tasks_categories',
    'posts_per_page'    =>  -1,
    'meta_query'        => array(
        array(
            'key'       => 'task-category-status', // (we can always just set this to 'status', but need to verify change everywhere)
            'value'     => '1',
            'compare'   => '='
        )
    )
);
$cats = get_posts($args);

// get task items
$args = array(
    'post_type'         =>  'tasks',
    'posts_per_page'    =>  -1,
    'meta_query'        => array(
        array(
            'key'       => 'task-status', // (we can always just set this to 'status', but need to verify change everywhere)
            'value'     => '1',
            'compare'   => '='
        )
    )
);
$tasks = get_posts($args);

// prep filtering tasks into categories
$filter_cats = array();
foreach ($tasks as $task) {
    $task_fields = get_fields($task);
    $filter_cats[$task_fields['category'][0]->post_name][] = $task;
}

?>