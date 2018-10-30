<?php 
/**
 * Template Name: Forms
 */
    get_header();
    // get forms
    $args = array(
        'post_type' => 'forms',
        'posts_per_page' => -1,
        'meta_query' => array(
            'key' => 'status',
            'value' => '1',
            'compare' => '='
        )
    );
    $forms = get_posts($args);
    // get forms-categories
    $args = array(
        'post_type' => 'forms_categories',
        'posts_per_page' => -1,
        'meta_query' => array(
            'key' => 'status',
            'value' => '1',
            'compare' => '='
        ),
        'order' => 'ASC'
    );
    $forms_categories = get_posts($args);
    // Begin Building the Page:
    $content = '';
    
    // for each active category
    foreach( $forms_categories as $forms_category )
    {
        // open category wrapper
        $content .= '<ul class="forms-category">';
        // category title
        $content .= '<h1>' . $forms_category->post_title . '</h1>';
        
        // for each form custom post
        foreach( $forms as $form )
        {
            $fields = get_fields($form);
            // match 'this' form against 'this' category
            if( $forms_category->post_title == $fields['category']->post_title )
            {
                // each form post is its own line item
                $content .= '<li class="js__collapsible">';
                // clickable area (toggle)
                $content .= '<a href="#" class="js__collapsible_clickarea"><h5>'.$form->post_title.'</h5></a>';
                // open wrapper for collapsible hidden area
                $content .= '<ul class="js__collapsible_hiddenarea">';

                // Start Hidden Section 1: Download Files
                    $content .= '<li>';
                    foreach( $fields['files'] as $file )
                    {
                        $content .= '<a target="_blank" title="Click to Open in a New Tab or Window" href="'.$file['file'].'">'.$file['filename'].'</a>';
                    }
                    $content .= '</li>';
                    // End Hidden Section 1 : Download Files

                // Start Hidden Section 2 : "Info Blocks"
                    $content .= '<li>';
                    foreach( $fields['information_blocks'] as $infoblock )
                    {
                        $content .= '<h6>'.$infoblock['title'].'</h6>';
                        $content .= $infoblock['details'];
                    }
                    $content .= '</li>';
                    // End Hidden Section 2 : "Info Blocks"

                // Start Hidden Section 3: Last Updated
                    $content .= '<li>';
                    $content .= '<h6>Last Updated</h6><p>'. get_the_modified_date('m/d/Y') .'</p>';
                    $content .= '</li>';
                    // End Hidden Section 3 : Last Updated

                // Start Hidden Section 4 : Related Resources
                    $content .= "<li>";
                    if( !empty($fields['related_resources']) )
                    {
                        $content .= '<ul>';
                        $content .= '<h6>Related Resources</h6>';
                        foreach( $fields['related_resources'] as $related_resource )
                        {
                            $ifExt = ( $related_resource['external_link'] == 1 ) ? '_blank' : '_self'; 
                            $content .= '<li><a target="'.$ifExt.'" href="'.$related_resource['link'].'">'.$related_resource['title'].'</a></li>';
                        }
                        $content .= '</ul>';
                    }
                    $content .= '</li>';
                    // End Hidden Section 4 : Related Resources


                $content .= '</ul>'; // close hidden area wrapper
                $content .= '</li>'; // close form post wrapper
            }
        }
        $content .= '</ul>'; // close category wrapper
    }
    


 ?>
<main id="forms">
<section class="forms">
    <?php echo $content; ?>
    <?php 
        $fields = get_fields($post->ID);
        include(locate_template('includes/prefooter.php'));
     ?>
</section>
</main>

<?php 

get_footer();

?>