<?php 
/**
 * Loop: Forms
  */    

    // Get: Active Form Categories
    $args = array(
        'post_type' => 'forms_categories',
        'posts_per_page' => -1,
        'meta_query' => array(
            'key' => 'status',
            'value' => '1',
            'compare' => '='
        ),
    );
    $categories = get_posts($args);
    


    // 
    // 
    //  Get Form Posts
    // 

    
    
    // NOTE!!!
    // IT APPEARS THAT THIS LOOP IS NEVER CALLED ON THE DEPARTMENT DETAIL PAGE
    // THAT PAGE USES ITS OWN HARD CODED STUFF FOR DISPLAYING THOSE!
    // THIS BLOCK IS ONLY EVER CALLED ON THE FORMS PAGE TEMPLATE!

    // if this is a department detail page;
    // we will show all forms assigned to this department
    if( !empty(get_query_var('department')) ){   
        // set args for get_posts call below
        $args = array(
            'post_type' => 'forms',
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
                    'value' => get_page_by_path(get_query_var('department'), OBJECT, 'departments')->ID,
                    'compare' => 'LIKE'
                )
            )
        );
    }
    // if this is not a department detail page;
    // then this is the forms page
    else {
        // Get all active forms
        $args = array(
            'post_type' => 'forms',
            'posts_per_page' => -1,
            'meta_query' => array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        );
    }
    $forms = get_posts($args);

    // set empty content var
    $content = '';
    $format_category = '
        <div class="forms-category">
            <h2>%s</h2>
            %s
        </div>
    ';

    $format_form = '
        <ul class="js__collapsible_list list">
            <li>
                <a name="%s" id="%s" class="named_anchor"></a>
                <a href="javascript:;" title="Toggle the %s dropdown" aria-label="Toggle the %s dropdown"><span>%s</span></a>
                <div>
                    %s
                    %s
                    <h4>Last Updated</h4>
                    %s
                    %s
                </div>
            </li>
        </ul>
    ';

    

    $format_blocks = '<h4>%s</h4>%s';
    $format_relresources = '
        <li>
            <p><a class="neu__iconlink" %s href="%s" title="View this Related Resource" aria-label="View this Related Resource">%s</a>
        </li>
    ';

    
    
    
    // loop thru the active categories
    foreach( $categories as $category ){
        
        // loop thru each form post to match against the category
        $content_form = '';

        foreach( $forms as $form ){
            
            $fields = get_fields($form);

            // Verify: Form belongs to category && Form is Active
            if( $category->post_name == $fields['category']->post_name && $fields['status'] == '1'){
                
                $files = $fields['files'];

                $format_files = '<p><a class="neu__iconlink" href="%s" title="Download %s [will open in new tab/window]" aria-label="Download %s [will open in new tab/window]" target="_blank">%s</a></p>';
                $content_files = '';
                                
                // Check that the "Files" repeater has rows;
                if( !empty($files) ){
                    // note, this probably just has one row
                    // loop thru the files repeater
                    foreach( $files as $file ){


                        // If an External URL is used:
                        if( !empty($file['external_url']) ){

                            $content_files .= sprintf(
                                $format_files
                                ,$file['external_url']
                                ,( (!empty($file['filename'])) ? $file['filename'] : 'this file')
                                ,( !empty($file['filename']) ) ? $file['filename'] : 'this file'
                                ,( !empty($file['filename']) ) ? $file['filename'] : 'Download'
                            );
                        }

                        // If a local file has been added:
                        else {
                            if( !empty($file['file']) ){
                                $content_files .= sprintf(
                                    $format_files
                                    ,$file['file']
                                    ,( (!empty($file['filename'])) ? $file['filename'] : 'this file')
                                    ,( !empty($file['filename']) ) ? $file['filename'] : 'this file'
                                    ,( !empty($file['filename']) ) ? $file['filename'] : 'Download'
                                );
                            }
                        }
                        
                    }
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
                $content_relresources = '';
                // If there are related resources to show
                if( !empty($fields['related_resources']) ){
                    // Set: format string for related resources
                    $content_relresources = '
                        <h4>Related Resources</h4>
                        <ul class="forms-category-relatedresources list">
                    ';
                    foreach( $fields['related_resources'] as $relresource ){
                        $ifExt = ( $relresource['external_link'] == 1 ) ? 'target="_blank"' : ''; 
                        $content_relresources .= sprintf(
                            $format_relresources
                            ,$ifExt
                            ,$relresource['link']
                            ,$relresource['title']
                        );
                    }
                    $content_relresources .= '</ul>';
                }

                // Set: format string combining all form elements into a complete form
                $content_form .= sprintf(
                    $format_form
                    ,seoUrl($category->post_title) .'_'. seoUrl($form->post_title)  // name for anchor
                    ,seoUrl($category->post_title) .'_'. seoUrl($form->post_title)  // id for anchor
                    ,$form->post_title  // title
                    ,$form->post_title  // aria
                    ,$form->post_title  // text
                    ,$content_files // files
                    ,$content_blocks    // other content
                    ,get_the_modified_date('m/d/Y', $form) // idk
                    ,$content_relresources  
                );
            }
        }

        // Only print the category if forms exist inside it!
        if( !empty($content_form) ){
            // Set: format string combining each form into its category
            $content .= sprintf(
                $format_category
                ,$category->post_title
                ,$content_form
            );
        }
    }
    echo $content;
 ?>