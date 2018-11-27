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
        // reg. custom jquery version
        // reg. magnific
        // reg. main scripts file

        // also, conditionally reg.
            // tasks page
            // forms page
            // deadlines
            // reusables
    }
    function register_styles(){
        // reg. magnific
        // reg. hover
        // reg. style.css
    }
    function enqueue_scripts(){
    }
    function enqueue_styles(){
    }
}
new SetupTheme();
?>