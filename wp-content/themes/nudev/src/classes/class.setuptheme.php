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
        if( get_page_template_slug($post_id) == 'templates/template-tasks.php' ){
            wp_enqueue_script('taskspage', get_template_directory_uri() . '/js/tasks.js', array('jquery'), '1.0.0');
        }
        if( get_page_template_slug($post_id) == 'templates/template-forms.php' ){
            wp_enqueue_script('formspage', get_template_directory_uri() . '/js/formpage.js', array('jquery'), '1.0.0');
        }
        if( get_page_template_slug($post_id) == 'templates/template-homepage.php' ){
            wp_enqueue_script('deadlines', get_template_directory_uri() . '/js/deadlines.js', array('jquery'), '1.0.0');
        }
        if( 
            get_page_template_slug($post_id) === 'templates/template-financial_statements.php'
            || get_page_template_slug($post_id) === 'templates/template-tools-index.php'
            || get_page_template_slug($post_id) === 'templates/template-tools-detail.php'
            || get_page_template_slug($post_id) === 'templates/template-discounts.php'
            || get_page_template_slug($post_id) === 'templates/template-forms.php'
            || get_page_template_slug($post_id) === 'templates/template-departments-detail.php'
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
        if( is_page_template('templates/template-homepage.php') ){
            wp_enqueue_style('homepage', get_template_directory_uri() . '/css/pages/homepage.css', 'theme', '1.0.0');
        }
    }
}
new SetupTheme();
?>