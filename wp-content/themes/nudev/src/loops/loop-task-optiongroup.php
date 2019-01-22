<?php 
/**
 * Tasks Options Groups & Sub Fields
 */
    $fields = get_fields($task); // (inefficient!)
    
    $content_option = '
        <div class="task-options">
            <h2>'.$fields['sub_title'].'</h2>
            <ul class="list task-options-list js__tasks_solutions">
    ';

    // the entire compiled option, including sidebar, related files, suboptions etc
    $format_option = '
        <li>
            <div>
                %s
                <h5>%s</h5>
                %s
            </div>
            <ul class="list task-options-list-item-suboptions js__tasks_steps">
                %s
                %s
                %s
            </ul>
        </li>
    ';
    

    // video should appear in a lightbox ( magnific popup )
    // still isnt working properly
    $format_the_video = '
        <li>
            <h5><a href="%s" class="js__youtube" title="Click to Open Video in Lightbox">%s</a></h5>
        </li>
    ';

    // basic sub-options as title + description
    $format_suboption = '
        <li>
            <h5>%s</h5>
            %s
        </li>
    ';

    // related files as a list
    $format_relatedfiles = '
        <li>
            <h5><a target="_blank" href="%s">%s</a></h5>
        </li>
    ';
    

    // Each : Options Grouping
    // (for each solution)
    foreach( $fields['options_group'] as $option ){
        // each option has its own related files and sidebar
        $content_relatedfiles = '';
        $content_sidebar = '';


        // Get : (if) related files
        if( $option['use_related_files'] ){
            foreach( $option['related_files'] as $file){
                $content_relatedfiles .= sprintf(
                    $format_relatedfiles
                    ,$file['file']['url']
                    ,$file['title']
                );
            }
        }
        // If the Sidebar is Enabled (for this "solution")
        if( $option['use_sidebar'] ){

            $target = ( $option['sidebar']['external'] ) ? '_blank' : '_self';
            
            // the sidebar
            $format_sidebar = '
                %s
                <h4>%s</h4>
                %s
                %s
            ';

            $content_sidebar .= sprintf(
                $format_sidebar
                ,( $option['sidebar']['image'] ) ? '<img src="'.$option['sidebar']['image'].'">' : null
                ,$option['sidebar']['title']
                ,$option['sidebar']['description']
                , ( !empty($option['sidebar']['link']) ) // if we have a link to reference; render the link
                    ? '<a class="neu__iconlink" target="'.$target.'" href="'.$option['sidebar']['link'].'">'.$option['sidebar']['link_name'].'</a>'
                    : null
            );
        }
        
        // each option has its own suboptions
        $content_suboption = '';

        // compile all suboptions into a string
        // (for each "step")
        foreach( $option['sub_options'] as $suboption ){

            // if is video suboption
            if( $suboption['use_video'] ){
                $content_suboption .= sprintf(
                    $format_the_video
                    ,$suboption['video']['link']
                    ,$suboption['video']['title']
                );
            }
            // else it is a normal suboption
            else {
                $content_suboption .= sprintf(
                    $format_suboption
                    ,$suboption['title']
                    ,$suboption['description']
                );
            }
        }

        // after all the bits are compiled, bring them all together as a complete option grouping
        $content_option .= sprintf(
            $format_option
            // ,( !empty($option['icon']) ) ? '<img class="taskoption-icon" src="'.$option['icon'].'">' : null
            ,'<i class="material-icons">check</i>'
            ,$option['title']
            ,$option['description']
            , ( !empty($content_relatedfiles) ) ? '<ul class="list"><h2>Related Files</h2>'.$content_relatedfiles.'</ul>' : null
            , ( !empty($content_sidebar) ) ? '<div class="sidebar">'.$content_sidebar.'</div>' : null
            ,$content_suboption
        );
        
    }
    $content_option .= '</ul></div>';

    echo $content_option;
 
 ?>