<?php 

class CPTs
{
    function __construct(){
        add_action('init', array($this, 'register_cpts'));
    }
    function register_cpts(){
        // Task Categories
        $labels = array(
            'name' => __('Tasks Categories', 'nudev'), // Rename these to suit
            'singular_name' => __('Tasks Category', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Tasks Category', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Tasks Category', 'nudev'),
            'new_item' => __('New Tasks Category', 'nudev'),
            'view' => __('View Tasks Category', 'nudev'),
            'view_item' => __('View Tasks Category', 'nudev'),
            'search_items' => __('Search Tasks Categories', 'nudev'),
            'not_found' => __('No Tasks Categories found', 'nudev'),
            'not_found_in_trash' => __('No Tasks Categories found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('tasks_categories', $args);
        // Task Items
        $labels = array(
            'name' => __('Tasks', 'nudev'), // Rename these to suit
            'singular_name' => __('Task', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Task', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Task', 'nudev'),
            'new_item' => __('New Task', 'nudev'),
            'view' => __('View Tasks', 'nudev'),
            'view_item' => __('View Task', 'nudev'),
            'search_items' => __('Search Tasks', 'nudev'),
            'not_found' => __('No Tasks found', 'nudev'),
            'not_found_in_trash' => __('No Tasks found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('tasks', $args);

        $labels = array(
            'name' => __('Helpful Links', 'nudev'), // Rename these to suit
            'singular_name' => __('Helpful Links', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit', 'nudev'),
            'new_item' => __('New Helpful Links Item', 'nudev'),
            'view' => __('View Helpful Links Item', 'nudev'),
            'view_item' => __('View Helpful Links Item', 'nudev'),
            'search_items' => __('Search Helpful Links', 'nudev'),
            'not_found' => __('No Helpful Links found', 'nudev'),
            'not_found_in_trash' => __('No Helpful Links found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
        );
        register_taxonomy_for_object_type('category', 'Helpful Links'); // Register Taxonomies for Category
        register_taxonomy_for_object_type('post_tag', 'Helpful Links');
        register_post_type('helpful_links', $args);
    }
}
$cpts = new CPTs();
?>