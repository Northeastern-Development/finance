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


        $this->reg_glossary_post_type();
        $this->reg_forms_post_types();
    }

    function reg_forms_post_types(){
        $labels = array(
            'name' => __('Forms', 'nudev'), // Rename these to suit
            'singular_name' => __('Form', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Form', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Form', 'nudev'),
            'new_item' => __('New Form', 'nudev'),
            'view' => __('View Form', 'nudev'),
            'view_item' => __('View Form', 'nudev'),
            'search_items' => __('Search Forms', 'nudev'),
            'not_found' => __('No Forms found', 'nudev'),
            'not_found_in_trash' => __('No Forms found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('forms', $args);

        $labels = array(
            'name' => __('Form Categories', 'nudev'), // Rename these to suit
            'singular_name' => __('Form Category', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Form Category', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Form Category', 'nudev'),
            'new_item' => __('New Form Category', 'nudev'),
            'view' => __('View Form Categories', 'nudev'),
            'view_item' => __('View Form Category', 'nudev'),
            'search_items' => __('Search Form Categories', 'nudev'),
            'not_found' => __('No Form Categories found', 'nudev'),
            'not_found_in_trash' => __('No Form Categories found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('forms_categories', $args);
    }

    function reg_glossary_post_type(){
        // Task Categories
        $labels = array(
            'name' => __('Glossary Items', 'nudev'), // Rename these to suit
            'singular_name' => __('Glossary Item', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Glossary Item', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Glossary Item', 'nudev'),
            'new_item' => __('New Glossary Item', 'nudev'),
            'view' => __('View Glossary Item', 'nudev'),
            'view_item' => __('View Glossary Item', 'nudev'),
            'search_items' => __('Search Glossary Items', 'nudev'),
            'not_found' => __('No Glossary Items found', 'nudev'),
            'not_found_in_trash' => __('No Glossary Items found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('glossary_items', $args);
    }
}
$cpts = new CPTs();
?>