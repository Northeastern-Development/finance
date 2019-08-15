<?php 
/**
 * 
 *  Type :  Reusable Loop
 *  Name :  Task "Solutions"
 * 
 *  Available Vars :
 *      $fields
 *      ,$task
 * 
 *  Description :
 *      
*/
    $content_option = '
        <div class="task-options">
            '.(!empty($fields['sub_title']) ? '<h2>'.$fields['sub_title'].'</h2>' : '').'
            <ul class="list task-options-list js__tasks_solutions">
    ';
    // the entire compiled option, including sidebar, related files, suboptions etc
    $format_option = '
        <li>
            <a href="javascript:;" title="Toggle dropdown for %s" aria-label="Toggle dropdown for %s">
                <h5>%s<span>%s</span></h5>
            </a>
            %s
            <ul class="list task-options-list-item-suboptions %s neu__fancy_bullets">
                %s
                %s
                %s
            </ul>
        </li>
    ';
    $format_the_video = '
        <li>
            <h5>%s</h5>
            <a href="%s" class="js__youtube neu__iconlink" title="View %s video in lightbox" aria-label="View %s video in lightbox">View Video</a>
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
            <a class="neu__iconlink" title="Click to download %s" aria-label="Click to download %s" target="_blank" href="%s">%s</a>
        </li>
    ';
    

    // 
    // 
    // Loop thru the "Solutions"

    foreach( $fields['options_group'] as $option ){
        // each option has its own related files and sidebar
        $content_relatedfiles = '';
        $content_sidebar = '';


        // Get : (if) related files
        if( $option['use_related_files'] ){
            foreach( $option['related_files'] as $file){
                $content_relatedfiles .= sprintf(
                    $format_relatedfiles
                    ,( !empty($file['title']) ) ? htmlentities2($file['title']) : 'This File'
                    ,( !empty($file['title']) ) ? htmlentities2($file['title']) : 'This File'
                    ,$file['file']['url']
                    ,( !empty($file['title']) ) ? htmlentities2($file['title']) : 'Download'
                );
            }
        }
        // If the Sidebar is Enabled (for this "solution")
        if( $option['use_sidebar'] ){

            $target = ( $option['sidebar']['external'] ) ? '_blank' : '_self';
            $actiontext = ( !empty($option['sidebar']['link_name']) ) ? htmlentities2($option['sidebar']['link_name']) : 'Action to Take';
            
            // the sidebar
            $format_sidebar = '
                %s
                <h4>%s</h4>
                %s
                %s
            ';

            $content_sidebar .= sprintf(
                $format_sidebar
                ,( $option['sidebar']['image'] ) ? '<div style="background-image: url('.$option['sidebar']['image'].'" aria-label="'.htmlentities2($option['sidebar']['title']).'"></div>' : null
                ,htmlentities2($option['sidebar']['title'])
                ,$option['sidebar']['description']
                , ( !empty($option['sidebar']['link']) ) // if we have a link to reference; render the link
                    ? '<a title="Go to '.htmlentities2($option['sidebar']['link_name']).'" aria-label="Go to '.htmlentities2($option['sidebar']['link_name']).'" class="neu__iconlink" target="'.$target.'" href="'.$option['sidebar']['link'].'">'.$actiontext.'</a>'
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
                    ,htmlentities2($suboption['video']['title'])
                    ,$suboption['video']['link']
                    ,htmlentities2($suboption['video']['title'])
                    ,htmlentities2($suboption['video']['title'])
                );
            }
            // else it is a normal suboption
            else {
                $content_suboption .= sprintf(
                    $format_suboption
                    ,htmlentities2($suboption['title'])
                    ,$suboption['description']
                );
            }
        }

        // after all the bits are compiled, bring them all together as a complete option grouping
        $content_option .= sprintf(
            $format_option
            ,htmlentities2($option['title'])
            ,htmlentities2($option['title'])
            ,'<i class="material-icons">check</i>'
            ,htmlentities2($option['title']) // the visible title
            ,$option['description']
            ,( count($fields['options_group']) > 1 ) ? 'js__tasks_steps' : null
            , ( !empty($content_sidebar) ) ? '<li class="sidebar">'.$content_sidebar.'</li>' : null
            ,$content_suboption
            , ( !empty($content_relatedfiles) ) ? '<ul class="list"><li><h2>Related Files</h2></li>'.$content_relatedfiles.'</ul>' : null
        );
        
    }
    $content_option .= '</ul></div>';

    echo $content_option;
 
 ?>