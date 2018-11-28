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
        add_action('wp_footer', array($this, 'do_wp_footer'));
    }

    function do_wp_footer(){
        // wp_enqueue_script('magnificjs');
        // wp_enqueue_script('theme');
    }

    function do_wp_enqueue_scripts(){
        // register:
        $this->register_scripts();
        $this->register_styles();
        
        // enqueue:
        $this->enqueue_scripts();
        $this->enqueue_styles();

        // localize:
        // $this->localize_scripts();
    }
    function register_scripts(){
        // dereg. jquery
        wp_deregister_script('jquery');
        // reg. custom jquery version
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), '2.2.0', false);
        // reg. magnific
        wp_register_script('magnificjs', get_template_directory_uri() . '/js/lib/jquery.magnific-popup.min.js', array('jquery'), '1.0.0', true);
        // reg. main scripts file
        wp_register_script('theme', get_template_directory_uri() . '/js/scripts-min.js',  array('jquery'), '1.0.0', true);

        // also, conditionally reg.
        // see about reducing / compiling this together
            // tasks page
            if( get_page_template_slug($post_id) == 'templates/template-tasks.php' ){
                wp_register_script('taskspage', get_template_directory_uri() . '/js/tasks.js', array('jquery'), '1.0.0');
            }
            // forms page
            if( get_page_template_slug($post_id) == 'templates/template-forms.php' ){
                wp_register_script('formspage', get_template_directory_uri() . '/js/formpage.js', array('jquery'), '1.0.0');
            }
            // deadlines
            if( get_page_template_slug($post_id) == 'templates/template-homepage.php' ){
                wp_register_script('deadlines', get_template_directory_uri() . '/js/deadlines.js', array('jquery'), '1.0.0');
            }
            // reusables
            if( 
                get_page_template_slug($post_id) === 'templates/template-financial_statements.php'
                || get_page_template_slug($post_id) === 'templates/template-tools-index.php'
                || get_page_template_slug($post_id) === 'templates/template-tools-detail.php'
                || get_page_template_slug($post_id) === 'templates/template-discounts.php'
                || get_page_template_slug($post_id) === 'templates/template-forms.php'
                || get_page_template_slug($post_id) === 'templates/template-departments-detail.php'
       
             ){
                wp_register_script('reusables', get_template_directory_uri() . '/js/reusables.js', array('jquery'), '1.0.0');
            }
    }
    function register_styles(){
        // reg. magnific
        wp_register_style('magnific', get_template_directory_uri() . '/css/lib/magnific-popup.css', array(), '1.0');
        // reg. hover
        wp_register_style('hover', get_template_directory_uri() . '/css/lib/hover-min.css', array(), '1.0');
        // reg. style.css
        wp_register_style('theme', get_template_directory_uri() . '/css/style.css', array(), '1.0');
    }
    function enqueue_scripts(){
        wp_enqueue_script('jquery');
        wp_enqueue_script('magnificjs');
        wp_enqueue_script('theme');
        wp_enqueue_script('taskspage');
        wp_enqueue_script('formspage');
        wp_enqueue_script('deadlines');
        wp_enqueue_script('reusables');
    }
    function enqueue_styles(){
        wp_enqueue_style('magnific');
        wp_enqueue_style('hover');
        wp_enqueue_style('theme');
    }
}
new SetupTheme();
?>