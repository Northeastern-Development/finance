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
        // Always Loaded
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), '2.2.0', false);
        wp_enqueue_script('magnificjs', get_template_directory_uri() . '/js/lib/jquery.magnific-popup.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('theme', get_template_directory_uri() . '/js/scripts-min.js',  array('jquery'), '1.0.0', true);


        // Conditionally Loaded
        if( is_page_template( 'templates/template-tasks.php') ){
            wp_enqueue_script('taskspage', get_template_directory_uri() . '/js/tasks.js', array('jquery'), '1.0.0');
        }
        if( is_page_template( 'templates/template-forms.php') ){
            wp_enqueue_script('formspage', get_template_directory_uri() . '/js/formpage.js', array('jquery'), '1.0.0');
        }
        if( is_page_template( 'templates/template-homepage.php') ){
            wp_enqueue_script('deadlines', get_template_directory_uri() . '/js/deadlines.js', array('jquery'), '1.0.0');
        }
        if( 
            is_page_template('templates/template-financial_statements.php')
            || is_page_template('templates/template-tools-index.php')
            || is_page_template('templates/template-tool-detail.php')
            || is_page_template('templates/template-discounts.php')
            || is_page_template('templates/template-forms.php')
            || is_page_template('templates/template-departments-detail.php')
            || is_page_template('templates/template-tasks.php')
         ){
            wp_enqueue_script('reusables', get_template_directory_uri() . '/js/reusables.js', array('jquery'), '1.0.0');
        }
    }
    function enqueue_styles(){
        // Always Loaded
        wp_enqueue_style('magnific', get_template_directory_uri() . '/css/lib/magnific-popup.css', array(), '1.0');
        wp_enqueue_style('hover', get_template_directory_uri() . '/css/lib/hover-min.css', array(), '1.0');
        wp_enqueue_style('theme', get_template_directory_uri() . '/css/style.css', array(), '1.0');

        // Conditionally Loaded
        // (example below)
        // if( is_page_template('templates/template-name.php') ){
        //     wp_enqueue_style($handle, $src, $deps, $ver, $media);
        // }
        // add any conditional stylesheets below:


        // Home Page
        if( is_page_template('templates/template-homepage.php') ){
            wp_enqueue_style('homepage', get_template_directory_uri() . '/css/conditionals/css/homepage.css', 'theme', '1.0.0');
        }
        // Tools Page
        if( is_page_template('templates/template-tools-index.php') || is_page_template('templates/template-tool-detail.php') ){
            wp_enqueue_style('tools', get_template_directory_uri() . '/css/conditionals/css/tools.css', array('theme'), '1.0.0');
        }
        // Tasks Page
        if( is_page_template('templates/template-tasks.php') ){
            wp_enqueue_style('tasks', get_template_directory_uri() . '/css/conditionals/css/tasks.css', array('theme'), '1.0.0');
        }
        // Here 2 Help Feature ( loaded on tasks page, and others )
        if( is_page_template('templates/template-tasks.php') ){
            wp_enqueue_style('here2help', get_template_directory_uri() . '/css/conditionals/css/here2help.css', array('theme'), '1.0.0');
        }
        // Glossary Page
        if( is_page_template('templates/template-glossary.php') ){
            wp_enqueue_style('glossary', get_template_directory_uri() . '/css/conditionals/css/glossary.css', array('theme'), '1.0.0');
        }
        // Forms Page
        if( is_page_template('templates/template-forms.php') ){
            wp_enqueue_style('forms-page', get_template_directory_uri() . '/css/conditionals/css/forms-page.css', array('theme'), '1.0.0');
        }
        // Departments Index/Detail Pages
        if( is_page_template('templates/template-departments-detail.php') || is_page_template('templates/template-departments-index.php') ){
            wp_enqueue_style('departments', get_template_directory_uri() . '/css/conditionals/css/departments.css', array('theme'), '1.0.0');
        }
        // News and Events Page
        if( is_page_template('templates/template-newsandevents-index.php') ){
            wp_enqueue_style('newsevents', get_template_directory_uri() . '/css/conditionals/css/news-events.css', array('theme'), '1.0.0');
        }
        // Discounts
        if( is_page_template('templates/template-discounts.php') ){
            wp_enqueue_style('discounts', get_template_directory_uri() . '/css/conditionals/css/discounts.css', array('theme'), '1.0.0');
        }
        // Financial Statements
        if( is_page_template('templates/template-financial_statements.php') ){
            wp_enqueue_style('financialstatements', get_template_directory_uri() . '/css/conditionals/css/financial-statements.css', array('theme'), '1.0.0');
        }
    }
}
new SetupTheme();
?>