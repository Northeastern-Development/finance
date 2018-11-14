<?php 

class CPTs
{
    function __construct(){
        add_action('init', array($this, 'register_cpts'));
    }
    function register_cpts(){
        $this->reg_helpful_links_post_type();
        $this->reg_tasks_post_types();
        $this->reg_glossary_post_type();
        $this->reg_forms_post_types();
        $this->reg_tools_post_type();
        $this->reg_discounts_post_types();
        $this->reg_newsandevents_post_types();
        $this->reg_departments_post_type();
    }

    function reg_departments_post_type(){
        $labels = array(
            'name' => __('Departments', 'nudev'), // Rename these to suit
            'singular_name' => __('Department', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Department', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Department', 'nudev'),
            'new_item' => __('New Department', 'nudev'),
            'view' => __('View Department', 'nudev'),
            'view_item' => __('View Department', 'nudev'),
            'search_items' => __('Search Departments', 'nudev'),
            'not_found' => __('No Departments found', 'nudev'),
            'not_found_in_trash' => __('No Departments found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('departments', $args);
    }

    function reg_newsandevents_post_types(){
        $labels = array(
            'name' => __('News & Events Categories', 'nudev'), // Rename these to suit
            'singular_name' => __('News & Events Categories', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New News & Events Category', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit News & Events Category', 'nudev'),
            'new_item' => __('New News & Events Category', 'nudev'),
            'view' => __('View News & Events Categories', 'nudev'),
            'view_item' => __('View News & Events Category', 'nudev'),
            'search_items' => __('Search News & Events Categories', 'nudev'),
            'not_found' => __('No News & Events Categories found', 'nudev'),
            'not_found_in_trash' => __('No News & Events Categories found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('newsevents-cats', $args);

        $labels = array(
            'name' => __('News & Events Items', 'nudev'), // Rename these to suit
            'singular_name' => __('News & Events Item', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New News & Events Item', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit News & Events Item', 'nudev'),
            'new_item' => __('New News & Events Item', 'nudev'),
            'view' => __('View News & Events Item', 'nudev'),
            'view_item' => __('View News & Events Item', 'nudev'),
            'search_items' => __('Search News & Events Items', 'nudev'),
            'not_found' => __('No News & Events Items found', 'nudev'),
            'not_found_in_trash' => __('No News & Events Items found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('newsevents-items', $args);
    }
    
    function reg_tasks_post_types(){
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
    }

    function reg_helpful_links_post_type(){
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
        register_post_type('helpful_links', $args);
        register_taxonomy_for_object_type('category', 'Helpful Links'); // Register Taxonomies for Category
        register_taxonomy_for_object_type('post_tag', 'Helpful Links');
    }

    function reg_discounts_post_types(){
        $labels = array(
            'name' => __('Discount Categories', 'nudev'), // Rename these to suit
            'singular_name' => __('Discount Category', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Discount Category', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Discount Category', 'nudev'),
            'new_item' => __('New Discount Category', 'nudev'),
            'view' => __('View Discount Category', 'nudev'),
            'view_item' => __('View Discount Category', 'nudev'),
            'search_items' => __('Search Discount Categories', 'nudev'),
            'not_found' => __('No Discount Categories found', 'nudev'),
            'not_found_in_trash' => __('No Discount Categories found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('discount-categories', $args);

        $labels = array(
            'name' => __('Discount Items', 'nudev'), // Rename these to suit
            'singular_name' => __('Discount Item', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Discount Item', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Discount Item', 'nudev'),
            'new_item' => __('New Discount Item', 'nudev'),
            'view' => __('View Discount Item', 'nudev'),
            'view_item' => __('View Discount Item', 'nudev'),
            'search_items' => __('Search Discount Items', 'nudev'),
            'not_found' => __('No Discount Items found', 'nudev'),
            'not_found_in_trash' => __('No Discount Items found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('discount-items', $args);
    }

    function reg_tools_post_type(){
        $labels = array(
            'name' => __('Tools', 'nudev'), // Rename these to suit
            'singular_name' => __('Tool', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Tool', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Tool', 'nudev'),
            'new_item' => __('New Tool', 'nudev'),
            'view' => __('View Tool', 'nudev'),
            'view_item' => __('View Tool', 'nudev'),
            'search_items' => __('Search Tools', 'nudev'),
            'not_found' => __('No Tools found', 'nudev'),
            'not_found_in_trash' => __('No Tools found in Trash', 'nudev')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_position' => null,
        );
        register_post_type('tools', $args);
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