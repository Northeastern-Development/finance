<?php

require_once "modules/is-debug.php";

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here


/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
    'default-color' => 'FFF',
    'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
    'default-image'          => get_template_directory_uri() . '/img/headers/default.jpg',
    'header-text'            => false,
    'default-text-color'     => '000',
    'width'                  => 1000,
    'height'                 => 198,
    'random-default'         => false,
    'wp-head-callback'       => $wphead_cb,
    'admin-head-callback'    => $adminhead_cb,
    'admin-preview-callback' => $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Enable nudev support
    add_theme_support('nudev', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

    // Localisation Support
    load_theme_textdomain('nudev', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Functions
\*------------------------------------*/


// this file will house all custom redirects and query tags that we need to create

// add custom query tags here
function myplugin_rewrite_tag() {
  add_rewrite_tag( '%show-bio%', '([^&]+)' );	// this is for the full bio details
  add_rewrite_tag( '%show-article%', '([^&]+)' );	// this is for the news article details
}
add_action('init', 'myplugin_rewrite_tag', 10, 0);

// add custom rewrite rules here
function custom_rewrite_rule() {
    add_rewrite_rule('^faculty-and-staff/([^/]*)?','index.php?page_id=120&show-bio=$matches[1]','top');  // full bio details
    add_rewrite_rule('^news/article/([^/]*)?','index.php?page_id=157&show-article=$matches[1]','top');  // full news article details
    
    // Finance Site (staff section) rewrite rules
    add_rewrite_rule('^about/university-administration/([^/]*)?','index.php?page_id=778&team-filter=$matches[1]','top');  // administration
    add_rewrite_rule('^about/board-of-trustees/([^/]*)?','index.php?page_id=781&board-type=$matches[1]','top');  // trustees
}
add_action('init', 'custom_rewrite_rule', 10, 0);






// nudev navigation
function nudev_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'header-menu',
        'menu'            => '',
        'container'       => 'nav',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}





/**
 * [list_searcheable_acf list all the custom fields we want to include in our search query]
 * @return [array] [list of custom fields]
 */
// function list_searcheable_acf(){
//   $list_searcheable_acf = array(
//      'title_panel'
//     ,'type'
//     ,'image'
//     ,'caption'
//     ,'photo_credit'
//     ,'primary_title'
//     ,'secondary_title'
//     ,'background_image_caption'
//     ,'background_image_photo_credit'
//     ,'copy'
//     ,'side_note_copy'
//     ,'copy_block'
//     ,'stats_caption'
//     ,'stats_photo_credit'
//     ,'stats'
//     ,'content'
//     ,'quote'
//     ,'rubrick_rubric'
//     // ,'rubric'
//     ,'author_name'
//     ,'short_bio'
//     ,'full_bio'
//     ,'email'
//   );
//   return $list_searcheable_acf;
// }
/**
 * [advanced_custom_search search that encompasses ACF/advanced custom fields and taxonomies and split expression before request]
 * @param  [query-part/string]      $where    [the initial "where" part of the search query]
 * @param  [object]                 $wp_query []
 * @return [query-part/string]      $where    [the "where" part of the search query as we customized]
 * see https://vzurczak.wordpress.com/2013/06/15/extend-the-default-wordpress-search/
 * credits to Vincent Zurczak for the base query structure/spliting tags section
 */
// function advanced_custom_search( $where, &$wp_query ) {
//     global $wpdb;
//
//     if ( empty( $where ))
//         return $where;
//
//     // get search expression
//     $terms = $wp_query->query_vars[ 's' ];
//
//     // explode search expression to get search terms
//     $exploded = explode( ' ', $terms );
//     if( $exploded === FALSE || count( $exploded ) == 0 )
//         $exploded = array( 0 => $terms );
//
//     // reset search in order to rebuilt it as we whish
//     $where = '';
//
//     // get searcheable_acf, a list of advanced custom fields you want to search content in
//     $list_searcheable_acf = list_searcheable_acf();
//     foreach( $exploded as $tag ) :
//         $where .= "
//           AND (
//             (wp_posts.post_title LIKE '%$tag%')
//             OR (wp_posts.post_content LIKE '%$tag%')
//             OR EXISTS (
//               SELECT * FROM wp_postmeta
// 	              WHERE post_id = wp_posts.ID
// 	                AND (";
//         foreach ($list_searcheable_acf as $searcheable_acf) :
//           if ($searcheable_acf == $list_searcheable_acf[0]):
//             $where .= " (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
//           else :
//             $where .= " OR (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
//           endif;
//         endforeach;
// 	        $where .= ")
//             )
//             OR EXISTS (
//               SELECT * FROM wp_comments
//               WHERE comment_post_ID = wp_posts.ID
//                 AND comment_content LIKE '%$tag%'
//             )
//             OR EXISTS(
//               SELECT * FROM wp_terms
//               INNER JOIN wp_postmeta
//                 ON wp_postmeta.meta_value = wp_terms.term_id
//               WHERE post_id = wp_posts.ID
//               AND wp_terms.name LIKE '%$tag%'
//             )
//             OR EXISTS (
//               SELECT * FROM wp_terms
//               INNER JOIN wp_term_taxonomy
//                 ON wp_term_taxonomy.term_id = wp_terms.term_id
//               INNER JOIN wp_term_relationships
//                 ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
//               WHERE (
//           		taxonomy = 'post_tag'
//             		OR taxonomy = 'category'
//             		OR taxonomy = 'myCustomTax'
//           		)
//               	AND object_id = wp_posts.ID
//               	AND wp_terms.name LIKE '%$tag%'
//             )
//         )";
//     endforeach;
//     return $where;
// }
//
// add_filter( 'posts_search', 'advanced_custom_search', 500, 2 );







//Adds active class to current page main menu item
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){

  $checkNav = array("affiliated-faculty","events","location");

  foreach($checkNav as $cN){
    $postCats = get_the_category();
    if(strtolower($item->title) === $cN){
      foreach($postCats as $pC){
        $test = $pC;
        if(strtolower($test->slug) === $cN){
          $classes[] = 'current-menu-item';
        }
      }
    }
  }

  if(!get_query_var('s')){
    if( in_array('current-menu-item', $classes) ){
           $classes[] = 'active ';
    }
  }

  return $classes;


}

// Async load
function nudev_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async";
    }
add_filter( 'clean_url', 'nudev_async_scripts', 11, 1 );

function disable_embeds_init() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('init', 'disable_embeds_init', 9999);

//* Adding DNS Prefetching
function ism_dns_prefetch() {
    echo '<meta http-equiv="x-dns-prefetch-control" content="on">
<link rel="dns-prefetch" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" />';

}

// Load nudev scripts (header.php)
function nudev_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        if (nudev_DEBUG) {
            // jQuery
            // wp_deregister_script('jquery');
            // wp_register_script('jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.js', array(), '1.11.1');

            // Conditionizr
            // wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0');

            // Modernizr
            // wp_register_script('modernizr', get_template_directory_uri() . '/bower_components/modernizr/modernizr.js', array(), '2.8.3');

            // Custom scripts
            wp_register_script(
                'nudevscripts',
                get_template_directory_uri() . '/js/scripts.js',
                array(
                    'conditionizr',
                    'modernizr',
                    'jquery'),
                '1.0.0');

            // Enqueue Scripts
            wp_enqueue_script('nudevscripts');

        // If production
        } else {
            // Scripts minify
            //wp_register_script('nudevscripts-min', get_template_directory_uri() . '/js/scripts.min.js', array(jquery), '1.0.0');
            // Enqueue Scripts
            //wp_enqueue_script('nudevscripts-min');
        }
    }
}



// load custom jquery
// function nudev_include_custom_jquery() {
// 	wp_deregister_script('jquery');
// 	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), false, '2.2.0', true);
// }
// add_action('wp_enqueue_scripts', 'nudev_include_custom_jquery');

// include custom jQuery
function neudev_include_custom_jquery() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), false, '2.2.0', true);

}
add_action('wp_enqueue_scripts', 'neudev_include_custom_jquery');




function nudev_footer_scripts() {

   if ( is_page( 14 ) ) {//location page
     wp_register_script('mapstyles', get_template_directory_uri() . '/js/lib/mapstyle-min.js',  array(), '1.0.0', true);
     wp_enqueue_script('mapstyles');

     wp_enqueue_script('googlemap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDIi5IUYN3xySijRqfhNDikL-MhWbYARoQ&callback=initMap', array(), '1.0.0', true);
     wp_enqueue_script('googlemap');
   }

   if(is_page_template('templates/template-staff.php')){
     wp_register_script('magnificjs', get_template_directory_uri() . '/js/magnific.js', array(), '1.0.0');
     wp_enqueue_script('magnificjs');
   }


   wp_register_script('nudevscripts-min', get_template_directory_uri() . '/js/scripts-min.js',  array('jquery'), '1.0.0', true);
   wp_enqueue_script('nudevscripts-min');




}
add_action('wp_footer', 'nudev_footer_scripts');





/* **********************************************************************
Page Conditional Scripts
********************************************************************** */
function nudev_conditional_scripts(){

  // load magnific for the staff pages
  // if(is_page_template('templates/template-staff.php')){
  //   wp_register_script('magnificjs', get_template_directory_uri() . '/js/magnific.js', array(), '1.0.0');
  //   wp_enqueue_script('magnificjs');
  // }

}

/* ******************************************************************* */



// Load nudev conditional scripts











// Load nudev styles
function nudev_styles(){
    if (nudev_DEBUG) {
        // normalize-css
        // wp_register_style('normalize', get_template_directory_uri() . '/bower_components/normalize.css/normalize.css', array(), '3.0.1');

        // Custom CSS
        // wp_register_style('nudev', get_template_directory_uri() . '/css/style.css', array('normalize'), '1.0');
        wp_register_style('nudev', get_template_directory_uri() . '/css/style.css', array(), '1.0');

        // Register CSS
        wp_enqueue_style('nudev');
    } else {
        // Custom CSS
        wp_register_style('nudevcssmin', get_template_directory_uri() . '/css/style.css', array(), '1.0');
        // Register CSS
        wp_enqueue_style('nudevcssmin');
    }




    // load homepage styles
    // if(is_page('')){
    //   wp_register_style('homepagecss', get_template_directory_uri() . '/css/homepage.css', array(), '1.0');
    //   wp_enqueue_style('homepagecss');
    // }


    // if(get_query_var('s') != ""){
    //   //echo "SEARCH RESULT: ".$_GET['s'];
    //   wp_register_style('searchcss', get_template_directory_uri() . '/css/category.css', array(), '1.0');
    //   wp_enqueue_style('searchcss');
    // }


    // load the category styles
    // if(is_page_template('templates/template-category.php')){
    //   wp_register_style('categorycss', get_template_directory_uri() . '/css/category.css', array(), '1.0');
    //   wp_enqueue_style('categorycss');
    // }


    // load the article style: editorial
    // if(is_page_template('templates/single-editorial.php')){
    //   wp_register_style('editorialcss', get_template_directory_uri() . '/css/editorial.css', array(), '1.0');
    //   wp_enqueue_style('editorialcss');
    // }


    // load the staff styles
    if(is_page_template('templates/template-staff.php') || is_page_template('templates/template-staff-bio.php')){
      wp_register_style('staffcss', get_template_directory_uri() . '/css/staff.css', array(), '1.0');
      wp_enqueue_style('staffcss');
      wp_register_style('magnificcss', get_template_directory_uri() . '/css/magnific.css', array(), '1.0');
      wp_enqueue_style('magnificcss');
    }


    // load the news styles
    if(is_page_template('templates/template-news-archive.php') || is_page_template('templates/template-news-item.php')){
      wp_register_style('newscss', get_template_directory_uri() . '/css/news.css', array(), '1.0');
      wp_enqueue_style('newscss');
      // wp_register_style('magnificcss', get_template_directory_uri() . '/css/magnific.css', array(), '1.0');
      // wp_enqueue_style('magnificcss');
    }


    // load the article style: multimedia
    // if(is_page_template('templates/single-media.php')){
    //   wp_register_style('magnificcss', get_template_directory_uri() . '/css/magnific.css', array(), '1.0');
    //   wp_enqueue_style('magnificcss');
    //   wp_register_style('multimediacss', get_template_directory_uri() . '/css/multimedia.css', array(), '1.0');
    //   wp_enqueue_style('multimediacss');
    // }




    // load the static styles for the about and submit a story templates
    // if(is_page_template(array('templates/template-about.php','templates/template-submitstory.php','templates/template-contact.php'))){
    //   wp_register_style('staticcss', get_template_directory_uri() . '/css/static.css', array(), '1.0');
    //   wp_enqueue_style('staticcss');
    // }



}

// Register nudev Navigation
function register_nudev_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'nudev'), // Main Navigation
        // 'sidebar-menu' => __('Sidebar Menu', 'nudev'), // Sidebar Navigation
        // 'extra-menu' => __('Extra Menu', 'nudev') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}










/* THESE ARE TWEAKS TO TINYMCE */



/**
 * Add the TinyMCE Lineheight Plugin.
 *
 * @param array $plugins An array of all plugins.
 * @return array
 */
// function mce_custom_plugins( $mceplugins ) {
//   //die("this is trying to load a plugin!!!");
//     $mceplugins['lineheight'] = plugins_url( 'tinymce/') . 'lineheight/plugin.js';
//      return $mceplugins;
// }
// add_filter( 'mce_external_plugins', 'mce_custom_plugins' );
//
//
// if ( ! function_exists( 'wpex_mce_lineheights' ) ) {
//     function wpex_mce_lineheights( $initArray ){
//       $fSizes = "";
//       for($i=9;$i<=100;$i++){
//         $fSizes .= ($i>9?" ":"").$i."px";
//       }
//       $initArray['lineheight_formats'] = $fSizes;
//       return $initArray;
//     }
// }
// add_filter( 'tiny_mce_before_init', 'wpex_mce_lineheights' );
//
// if ( ! function_exists( 'load_custom_fonts' ) ) {
//     function load_custom_fonts( $initArray ){
//       // $fSizes = "";
//       // for($i=9;$i<=100;$i++){
//       //   $fSizes .= ($i>9?" ":"").$i."px";
//       // }
//       // $initArray['fontsize_formats'] = $fSizes;
//
//       //$theme_advanced_fonts = array("Tungsten");
//
//       //$initArray['$theme_advanced_fonts'] = 'Aclonica=Aclonica, sans-serif;';
//
//       // $init['content_css'] = "https://fonts.googleapis.com/css?family=Lato";
//       $initArray['content_css'] = "https://cloud.typography.com/7862092/6820572/css/fonts.css";
//
//       $initArray['font_formats'] = "Tungsten='Tungsten Rounded A','Tungsten Rounded B'";
//
//
//       //function wpex_mce_text_sizes( $initArray ){
//         $fSizes = "";
//         for($i=9;$i<=100;$i++){
//           $fSizes .= ($i>9?" ":"").$i."px";
//         }
//         $initArray['fontsize_formats'] = $fSizes;
//         //return $initArray;
//
//       return $initArray;
//     }
// }
// add_filter( 'tiny_mce_before_init', 'load_custom_fonts' );

// if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
//     function wpex_mce_text_sizes( $initArray ){
//       $fSizes = "";
//       for($i=9;$i<=100;$i++){
//         $fSizes .= ($i>9?" ":"").$i."px";
//       }
//       $initArray['fontsize_formats'] = $fSizes;
//       return $initArray;
//     }
// }
// add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );


function thisismyurl_remove_full_screen_button( $buttons ) {

	if ( in_array( 'fullscreen', $buttons ) )
		$buttons = array_diff( $buttons, array( 'fullscreen') );

	return $buttons;

}
add_filter( 'mce_buttons', 'thisismyurl_remove_full_screen_button', 999 );




// function my_mce_buttons_line_2( $buttons ) {
//
//   // array_unshift( $buttons, 'fontselect |  fontsizeselect | lineheightselect' );
//   array_push( $buttons, 'fontselect','fontsizeselect','lineheightselect' );
//   return $buttons;
// }
// add_filter( 'mce_buttons_2', 'my_mce_buttons_line_2' );






















// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    // register_sidebar(array(
    //     'name' => __('Widget Area 1', 'nudev'),
    //     'description' => __('Description for this widget-area...', 'nudev'),
    //     'id' => 'widget-area-1',
    //     'before_widget' => '<div id="%1$s" class="%2$s">',
    //     'after_widget' => '</div>',
    //     'before_title' => '<h3>',
    //     'after_title' => '</h3>'
    // ));
    //
    // // Define Sidebar Widget Area 2
    // register_sidebar(array(
    //     'name' => __('Widget Area 2', 'nudev'),
    //     'description' => __('Description for this widget-area...', 'nudev'),
    //     'id' => 'widget-area-2',
    //     'before_widget' => '<div id="%1$s" class="%2$s">',
    //     'after_widget' => '</div>',
    //     'before_title' => '<h3>',
    //     'after_title' => '</h3>'
    // ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;

    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function nudevwp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '&#xf137;',
        'next_text' => '&#xf138;'
    ));
}

// Custom Excerpts
function nudevwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using nudevwp_excerpt('nudevwp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using nudevwp_excerpt('nudevwp_custom_post');
function nudevwp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function nudevwp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function nudev_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'nudev') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function nudev_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Removes scripts version number from script tags
function _remove_script_version( $src ){
	return remove_query_arg( 'ver',  $src  );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function nudevgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function nudevcomments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
    </div>
<?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
    <br />
<?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
        <?php
            printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
        ?>
    </div>

    <?php comment_text() ?>

    <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php }

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'nudev_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'nudev_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_head', 'ism_dns_prefetch', 0); // DNS Prefetch Google Fonts
add_action('wp_enqueue_scripts', 'nudev_styles'); // Add Theme Stylesheet
add_action('init', 'register_nudev_menu'); // Add nudev Menu
add_action('init', 'create_post_type_nudev'); // Add our nudev Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'nudevwp_pagination'); // Add our nudev Pagination


// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );//Removing Emoji code from header
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );//Removing Emoji code from header
remove_action( 'wp_print_styles', 'print_emoji_styles' );//Removing Emoji code from header
remove_action( 'admin_print_styles', 'print_emoji_styles' );//Removing Emoji code from header

// remove_action( 'load-update-core.php', 'wp_update_plugins' ); //Removes the Update Plugins option from WordPress
// add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) ); //Removes the Update Plugins option from WordPress
// add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) ); //Remove the "Please Update Now" option from WordPress

// Add Filters





// Add Filters
add_filter('avatar_defaults', 'nudevgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'nudev_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'nudev_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 ); // Removes scripts version number from script tags
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 ); // Removes scripts version number from style tags
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('nudev_shortcode_demo', 'nudev_shortcode_demo'); // You can place [nudev_shortcode_demo] in Pages, Posts now.
add_shortcode('nudev_shortcode_demo_2', 'nudev_shortcode_demo_2'); // Place [nudev_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [nudev_shortcode_demo] [nudev_shortcode_demo_2] Here's the page title! [/nudev_shortcode_demo_2] [/nudev_shortcode_demo]


// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
	remove_submenu_page( 'options-general.php', 'options-discussion.php' );
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');

// Remove comments from top admin bar
function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );




/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called nudev
function create_post_type_nudev()
{
    register_taxonomy_for_object_type('category', 'nudev'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'nudev');
    register_post_type('careers', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Careers', 'nudev'), // Rename these to suit
            'singular_name' => __('Careers', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Career Opportunity', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Career Opportunity', 'nudev'),
            'new_item' => __('New Career Opportunity', 'nudev'),
            'view' => __('View Career Opportunities', 'nudev'),
            'view_item' => __('View Career Opportunities', 'nudev'),
            'search_items' => __('Search Career Opportunities', 'nudev'),
            'not_found' => __('No Careers found', 'nudev'),
            'not_found_in_trash' => __('No Careers found in Trash', 'nudev')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom nudev post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));

    register_taxonomy_for_object_type('category', 'Staff'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'Staff');
    register_post_type('staff', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Staff', 'nudev'), // Rename these to suit
            'singular_name' => __('Staff', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New Staff Member', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit Staff Member', 'nudev'),
            'new_item' => __('New Staff Member', 'nudev'),
            'view' => __('View Staff Member', 'nudev'),
            'view_item' => __('View Staff Member', 'nudev'),
            'search_items' => __('Search Staff Members', 'nudev'),
            'not_found' => __('No Staff Members found', 'nudev'),
            'not_found_in_trash' => __('No Staff Members found in Trash', 'nudev')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom nudev post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));


    register_taxonomy_for_object_type('category', 'newsandevents'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'newsandevents');
    register_post_type('newsandevents', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('News and Events', 'nudev'), // Rename these to suit
            'singular_name' => __('News and Events', 'nudev'),
            'add_new' => __('Add New', 'nudev'),
            'add_new_item' => __('Add New News and Events', 'nudev'),
            'edit' => __('Edit', 'nudev'),
            'edit_item' => __('Edit News and Events', 'nudev'),
            'new_item' => __('New News and Events', 'nudev'),
            'view' => __('View News and Events', 'nudev'),
            'view_item' => __('View News and Events', 'nudev'),
            'search_items' => __('Search News and Events', 'nudev'),
            'not_found' => __('No News and Events found', 'nudev'),
            'not_found_in_trash' => __('No News and Events found in Trash', 'nudev')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom nudev post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));


    // Add columns to administration post listing
    function add_newsandevents_acf_columns($columns){
      $slice1 = array_slice($columns, 0, 2, true);
      $slice2 = array_slice($columns, 2, count($columns), true);
      return array_merge($slice1,array('type' => __ ( 'Type' )),array('featured' => __ ( 'Featured' )),$slice2);
    }

    function newsandevents_custom_column($column, $post_id){
      switch($column){
        case 'type':
          echo ucwords(get_post_meta($post_id,'type',true));
          break;
        case 'featured':
          if(get_post_meta($post_id,'featured',true) == 1){
            echo "Yes";
          }else{
            echo "";
          }
          break;
      }
    }

    // add filter options
    function newsandevents_admin_posts_filter_restrict_manage_posts(){
      global $typenow;
      $type = 'newsandevents';

      if ($typenow == $type){


        $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';

        $guide = '<option value="%s"%s>%s</option>';

        // hardcoded values for now, there is an issue retrieving them again after the first filter
        $values = array(
           'News' => 'News'
          ,'Event' => 'Event'
        );
  ?>
        <select name="ADMIN_FILTER_FIELD_VALUE"><option value=""><?php _e('Filter By Type', 'type'); ?></option>

  <?php



        foreach ($values as $label => $value){

          printf(
             $guide
            ,$value
            ,$value == $current_v? ' selected="selected"':''
            ,$label
          );
        }
  ?>
        </select>
  <?php
      }
    }


    function newsandevents_posts_filter( $query ){
      global $pagenow;
      global $typenow;
      $type = 'newsandevents';
      if ( $typenow == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != ''){

        // this is so that we can fuzzy find a match even if the profile is in more than 1 dept.
        $query->set('meta_query',array(
          array(
            'key' => 'type'
            ,'value' => $_GET['ADMIN_FILTER_FIELD_VALUE']
            ,'compare' => 'LIKE'
          )
        ));

      }
    }

    function newsandevents_sortable_columns( $columns ) {
      $columns['featured'] = 'featured';
      // $columns['acf_field'] = 'acf_field';

      return $columns;
    }

    add_filter('manage_newsandevents_posts_columns','add_newsandevents_acf_columns');
    add_action('manage_newsandevents_posts_custom_column','newsandevents_custom_column',10,2);

    add_action( 'restrict_manage_posts', 'newsandevents_admin_posts_filter_restrict_manage_posts' );
    add_filter( 'parse_query', 'newsandevents_posts_filter' );

    add_filter( 'manage_edit-newsandevents_sortable_columns', 'newsandevents_sortable_columns' );





}

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function nudev_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function nudev_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

/*------------------------------------*\
    Additional Functions
\*------------------------------------*/

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/_ui/logo.svg);
            width:302px;
            background-size: 302px 63px;
          	height: 63px;
        }
        body.login #login_error, .login .message {
            border-left: 4px solid rgba(204, 0, 0, 1.0) !important;
        }
        body.login #backtoblog a, .login #nav a {
            color:rgba(51, 62, 71, 1.0) !important;
        }
        body.login #backtoblog a:hover, .login #nav a:hover {
            color:rgba(204, 0, 0, 1.0) !important;
        }
         .wp-core-ui .button-primary {
            background:rgba(204, 0, 0, 1.0) !important;
            border-color:rgba(0, 0, 0, 1.0) !important;
            text-shadow: none !important;
        }
        body.login label {
            color:rgba(51, 62, 71, 1.0) !important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Site Name Here';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//including srcset in img tags when they are added to the WYSIWYG editor on the admin side
add_filter( 'acf_the_content', 'wp_make_content_images_responsive' );

//Add colors to the page/post/plugins panels within the dashboard
add_action('admin_footer','posts_status_color');
function posts_status_color(){
?>
<style>
.status-draft .check-column {box-shadow: -12px 0 0 -3px rgba(237, 86, 68, 1.0) !important;}
.status-pending .check-column {box-shadow: -12px 0 0 -3px rgba(235, 138, 35, 1.0) !important;}
.status-publish .check-column {box-shadow: -12px 0 0 -3px rgba(81, 248, 0, 1.0) !important;}
.status-future .check-column {box-shadow: -12px 0 0 -3px #ffffff !important;}
.status-private .check-column {box-shadow: -12px 0 0 -3px #000000 !important;}
.active .check-column {border-left:4px solid rgba(81, 248, 0, 1.0) !important;}
.inactive .check-column {border-left:4px solid rgba(100, 100, 100, .3) !important;}
</style>
<?php
}

// block WP enum scans
// http://m0n.co/enum
if (!is_admin()) {
	// default URL format
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
	add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2);
}
function shapeSpace_check_enum($redirect, $request) {
	// permalink URL format
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
	else return $redirect;
}
