<?php 
/**
 *  Theme Setup / Config
 *  Load JS, CSS and so on...
 */
class SetupTheme
{
    function __construct(){
        // code
        $this->_init();
    }
    function _init(){
        add_action('wp_enqueue_scripts', array($this, 'do_wp_enqueue_scripts'));
    }

    function do_wp_enqueue_scripts(){
        // enqueue:
        $this->enqueue_styles();
        $this->enqueue_scripts();
    }

    function enqueue_scripts(){


        if( is_page_template('templates/template-departments-detail.php') || is_page_template('templates/template-tasks.php') ){
            wp_enqueue_script('magnificjs', get_template_directory_uri() . '/js/lib/jquery.magnific-popup-min.js', array('jquery'), '1.0.0', true);
        }

        wp_enqueue_script('theme', get_template_directory_uri() . '/js/scripts-min.js',  array('jquery'), '1.0.0', true);
        

        if(is_page_template('templates/template-tasks.php')){ wp_enqueue_script('taskspage', get_template_directory_uri() . '/js/tasks-min.js', array('theme'), '1.0.0'); }
        
        if( is_page_template( 'templates/template-glossary.php') ){ wp_enqueue_script('glossary', get_template_directory_uri() . '/js/glossary-min.js', array('theme'), '1.0.0');}
        
        
        if( is_page_template( 'templates/template-departments-detail.php') || is_page_template('templates/template-tasks.php')){ 
            wp_enqueue_script('department', get_template_directory_uri() . '/js/department-min.js', array('theme'), '1.0.0');
        }

        
        if( is_page_template( 'templates/template-tool-detail.php') ){ wp_enqueue_script('tooldetail', get_template_directory_uri() . '/js/tool-detail-min.js', array('theme'), '1.0.0');}



    }
    function enqueue_styles(){

        if( is_page_template('templates/template-departments-detail.php') || is_page_template('templates/template-tasks.php') ){
            wp_enqueue_style('magnific', get_template_directory_uri() . '/css/lib/magnific-popup-min.css', array(), '1.0');
        }
        
        // Always Loaded
        
        // wp_enqueue_style('hover', get_template_directory_uri() . '/css/lib/hover-min.css', array(), '1.0');
        
        wp_enqueue_style('theme', get_template_directory_uri() . '/css/style.css', array(), '1.0');


        // Home Page
        if( is_page_template('templates/template-homepage.php') ){
            wp_enqueue_style('homepage', get_template_directory_uri() . '/css/homepage.css', 'theme', '1.0.0');
        }
        // Tools Page
        if( is_page_template('templates/template-tools-index.php') || is_page_template('templates/template-tool-detail.php') ){
            wp_enqueue_style('tools', get_template_directory_uri() . '/css/tools.css', array('theme'), '1.0.0');
        }
        // Tasks Page
        if( is_page_template('templates/template-tasks.php') ){
            wp_enqueue_style('tasks', get_template_directory_uri() . '/css/tasks.css', array('theme'), '1.0.0');
        }
        // Glossary Page
        if( is_page_template('templates/template-glossary.php') ){
            wp_enqueue_style('glossary', get_template_directory_uri() . '/css/glossary.css', array('theme'), '1.0.0');
        }
        // Forms Page
        if( is_page_template('templates/template-forms.php') ){
            wp_enqueue_style('forms-page', get_template_directory_uri() . '/css/forms-page.css', array('theme'), '1.0.0');
        }
        // Departments Index/Detail Pages
        if( is_page_template('templates/template-departments-detail.php') || is_page_template('templates/template-departments-index.php') ){
            wp_enqueue_style('departments', get_template_directory_uri() . '/css/departments.css', array('theme'), '1.0.0');
        }
        // News and Events Page
        if( is_page_template('templates/template-newsevents-index.php') || is_page_template('templates/template-newsevents-item.php') ){
            wp_enqueue_style('newsevents', get_template_directory_uri() . '/css/news-events.css', array('theme'), '1.0.0');
        }
        // Discounts
        if( is_page_template('templates/template-discounts.php') ){
            wp_enqueue_style('discounts', get_template_directory_uri() . '/css/discounts.css', array('theme'), '1.0.0');
        }
        // About
        if ( is_page_template('templates/template-about.php') ) {
            wp_enqueue_style('about-us', get_template_directory_uri() . '/css/about.css', array('theme'), '1.0.0');
        }
        // Contact
        if (is_page_template('templates/template-contact.php')) {
            wp_enqueue_style('contact', get_template_directory_uri() . '/css/contact.css', array('theme'), '1.0.0');
        }
        // Financial Statements
        if( is_page_template('templates/template-financial_statements.php') ){
            wp_enqueue_style('financialstatements', get_template_directory_uri() . '/css/financial-statements.css', array('theme'), '1.0.0');
        }
        // Deadlines
        if ( is_page_template('templates/template-deadlines.php') ) {
            wp_enqueue_style('deadlines', get_template_directory_uri() . '/css/deadlines.css', array('theme'), '1.0.0');
        }
        // Site Search
        if ( is_page_template('templates/template-search.php') ) {
            wp_enqueue_style('sitesearch', get_template_directory_uri() . '/css/search.css', array('theme'), '1.0.0');
        }
        
    }
}
new SetupTheme();
?>