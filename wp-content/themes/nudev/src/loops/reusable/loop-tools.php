<?php 
/**
 * Reusable Loop: Tools
 */

    //  using this to sanitize the field groupings title (which could be anything)
    function seoUrl($string) {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }


    $args = array(
        'post_type' => 'tools',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            ),
            array(
                'key' => 'department',
                'value' => get_page_by_path($filter, OBJECT, 'departments')->ID,
                'compare' => 'LIKE'
            )
        ),
    );
    $tools = get_posts($args);


    $content_tools = '<ul>';

    $format_tools = '<li><a href="%s">%s</a></li>';
    foreach( $tools as $tool ){

        $fields = get_fields($tool);
        
        $content_tools .= sprintf(
            $format_tools
            ,site_url('/tools/') . $tool->post_name . '/' . seoUrl($fields['groupings'][0]['title'])
            ,$tool->post_title
        );

    }
    $content_tools .= '</ul>';
    
    echo $content_tools;

 ?>