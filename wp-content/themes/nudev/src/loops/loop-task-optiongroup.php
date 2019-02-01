<?php 
/**
 * Tasks Options Groups & Sub Fields
 */
    $fields = get_fields($task); // (inefficient!)

    $solution_heading = '';
    if( !empty($fields['sub_title']) ){
        $solution_heading = '<h2>'.$fields['sub_title'].'</h2>';
    }
    
    $content_option = '
        <div class="task-options">
            '.$solution_heading.'
            <ul class="list task-options-list js__tasks_solutions">
    ';

    // the entire compiled option, including sidebar, related files, suboptions etc
    $format_option = '
        <li>
            <div>
                <h5 title="Toggle dropdown for %s">%s<span>%s</span></h5>
                %s
            </div>
            <ul class="list task-options-list-item-suboptions js__tasks_steps neu__fancy_bullets">
                %s
                %s
                %s
            </ul>
        </li>
    ';
    

    // video should appear in a lightbox ( magnific popup )
    
    // $format_the_video = '
    //     <li>
    //         <h5><a href="%s" class="js__youtube" title="Click to Open Video in Lightbox">%s</a></h5>
    //     </li>
    // ';

    $format_the_video = '
        <li>
            <h5>%s</h5>
            <a href="%s" class="js__youtube neu__iconlink" target="View %s video in lightbox">View Video</a>
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
            <a class="neu__iconlink" title="Click to download %s" target="_blank" href="%s">%s</a>
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
                    ,( !empty($file['title']) )
                        ? $file['title']
                        : 'This File'
                    ,$file['file']['url']
                    ,( !empty($file['title']) )
                        ? $file['title']
                        : 'Download'
                );
            }
        }
        // If the Sidebar is Enabled (for this "solution")
        if( $option['use_sidebar'] ){

            $target = ( $option['sidebar']['external'] ) ? '_blank' : '_self';
            $actiontext = ( !empty($option['sidebar']['link_name']) ) ? $option['sidebar']['link_name'] : 'Action to Take';
            
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
                    ? '<a title="Go to '.$option['sidebar']['link_name'].'" class="neu__iconlink" target="'.$target.'" href="'.$option['sidebar']['link'].'">'.$actiontext.'</a>'
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
                    ,$suboption['video']['title']
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
            ,$option['title']
            ,'<i class="material-icons">check</i>'
            ,$option['title']
            ,$option['description']
            , ( !empty($content_sidebar) ) ? '<li class="sidebar">'.$content_sidebar.'</li>' : null
            ,$content_suboption
            , ( !empty($content_relatedfiles) ) ? '<ul class="list"><li><h2>Related Files</h2></li>'.$content_relatedfiles.'</ul>' : null
        );
        
    }
    $content_option .= '</ul></div>';

    echo $content_option;
 
 ?>