<?php 
    $toolPost = get_page_by_path($isPost, ARRAY_A, 'tools');
    $fields = get_fields($toolPost['ID']);


    // pre-set an object to contain the fields for the current grouping
    // when the grouping nav is clicked, it will refresh the page; rewriting the current grouping; which will cause this object to dynamically change
    // this should always have an array of the subfields inside of the 'current' grouping
    $currentGrouping = [];
    


    $groupSelectorGuide = '<li><a href="%s">%s</a></li>';
    $groupSelectorContent = '<ul class="tool-groupingnav">';
    foreach( $fields['groupings'] as $grouping ){
        // pass title to both the nav and the list
        $groupSelectorContent .= sprintf(
            $groupSelectorGuide
            ,get_permalink($toolPost['ID']) . seoUrl($grouping['title'])
            ,$grouping['title']
        );
        //
        if( seoUrl($grouping['title']) == $theGrouping  ){
            $currentGrouping = $grouping;
        }
        // 
    }
    $groupSelectorContent .= '</ul>';

    

    // (main page content stuff here)
    $groupContent = '<div class="tool-groups">';

    $groupContent_guide = '<ul class="js__collapsible_list"><h2>%s</h2>%s</ul>';

    $infoblock_guide = '<li><h5>%s</h5><p>%s</p></li>';

    foreach( $currentGrouping['group'] as $group ){

        $infoblock_string = '';
        foreach( $group['information_blocks'] as $infoblock ){
            $infoblock_string .= sprintf(
                $infoblock_guide
                ,$infoblock['title']
                ,$infoblock['description']
            );
        }

        $groupContent .= sprintf(
            $groupContent_guide
            ,$group['title']
            ,$infoblock_string
        );
        
        
    }
    $groupContent .= '</div>';




    get_header();
?>
<main id="tools">
    <section>
        <?php 

            echo '<h1>'.$toolPost['post_title'] . '</h1><p>' . $fields['full_description'] . '</p>';
            
            echo $groupSelectorContent;

            echo $groupContent;

         ?>
    </section>
</main>
<?php 
    get_footer();
 ?>