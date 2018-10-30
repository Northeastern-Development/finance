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
        // category title
        $content .= '<div class="forms-category">';
        $content .= '<h1>' . $forms_category->post_title . '</h1>';
        // loop thru forms
        foreach( $forms as $form )
        {
            // get fields for 'this' form
            $fields = get_fields($form);
            
            // check form matches category
            if( $forms_category->post_title == $fields['category']->post_title )
            {
                // write the form title (title of collapsible field)
                $content .= '<h5>'.$form->post_title.'</h5>';
                
                // open collapsible content wrapper
                $content .= '<div class="forms-category-collapsible js__forms_collapsible">';
                

                // Open File Section Wrapper
                $content .= '<div class="forms-category-collapsible-files">';
                foreach( $fields['files'] as $file )
                {
                    $content .= '<a href="'.$file['file'].'">'.$file['filename'].'</a>';
                }
                $content .= '</div>';
                
                
                // Open Info Blocks Section Wrapper
                
                $content .= '<div class="forms-category-collapsible-infoblocks">';
                foreach( $fields['information_blocks'] as $infoblock )
                {
                    $content .= '<h6>'.$infoblock['title'].'</h6>';
                    $content .= '<div>'.$infoblock['details'].'</div>';
                }
                $content .= '</div>';

                // Last Updated Section:
                // ( STILL TBD, NEED TO FORMAT DATE)
                $content .= '<p>'. get_the_modified_date('m/d/Y') .'</p>';

                // Related Resources Section:
                // (only written if populated)
                if( !empty($fields['related_resources']) )
                {
                    $content .= '<div class="forms-category-collapsible-related">';
                    $content .= '<h6>Related Resources</h6><ul>';
                    foreach( $fields['related_resources'] as $related_resource )
                    {
                        $ifExt = ( $related_resource['external_link'] == 1 ) ? '_blank' : '_self'; 
                        $content .= '<li><a target="'.$ifExt.'" href="'.$related_resource['link'].'">'.$related_resource['title'].'</a></li>';
                    }
                    $content .= '</ul></div>';
                }
                // close the collapsible content wrapper
                $content .= '</div>';
            }
                    
        }
        // close category
        $content .= '</div>';
    }
    


 ?>
<main id="forms">
<section class="forms">
    <?php echo $content; ?>
</section>
</main>

<?php 

get_footer();

?>