<?php 
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
    $categories = get_posts($args);

    
    // set empty content var
    $content = '';
    $format_category = '<div class="forms-category"><h1>%s</h1>%s</div>';
    $format_form = '<ul class="js__collapsible_list"><li><h5>%s</h5><div>%s%s%s%s</div></li></ul>';
    $format_files = '<a href="%s" title="click to open this file in a new tab" target="_blank">%s</a>';
    $format_blocks = '<h5>%s</h5>%s';
    $format_relresources = '<li><a target="%s" href="%s" title="View this Related Resource">%s</a></li>';
    // loop thru the active categories
    foreach( $categories as $category ){
        
        // loop thru each form post to match against the category
        $content_form = '';

        foreach( $forms as $form ){
            
            $fields = get_fields($form);

            // Verify: Form belongs to category && Form is Active
            if( $category->post_title == $fields['category']->post_title && $fields['status'] == '1'){
                
                // Set: format string for file downloads
                $content_files = '';
                foreach( $fields['files'] as $file ){
                    $content_files .= sprintf(
                        $format_files
                        ,$file['file']
                        ,$file['filename']
                    );
                }
                // Set: format string for information blocks
                $content_blocks = '';
                foreach( $fields['information_blocks'] as $infoblock ){
                    $content_blocks .= sprintf(
                        $format_blocks
                        ,$infoblock['title']
                        ,$infoblock['details']
                    );
                }

                // Set: format string for related resources
                $content_relresources = '<ul><h5>Related Resources</h5>';
                foreach( $fields['related_resources'] as $relresource ){
                    $ifExt = ( $related_resource['external_link'] == 1 ) ? '_blank' : '_self'; 
                    $content_relresources .= sprintf(
                        $format_relresources
                        ,$ifExt
                        ,$relresource['link']
                        ,$relresource['title']
                    );
                }
                $content_relresources .= '</ul>';

                // Set: format string combining all form elements into a complete form
                $content_form .= sprintf(
                    $format_form
                    ,$form->post_title
                    ,$content_files
                    ,$content_blocks
                    ,get_the_modified_date('m/d/Y', $form)
                    ,$content_relresources
                );
            }
        }
        // Set: format string combining each form into its category
        $content .= sprintf(
            $format_category
            ,$category->post_title
            ,$content_form
        );

    }

    echo $content;
 ?>