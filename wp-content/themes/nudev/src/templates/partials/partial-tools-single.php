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
        if( strtolower($grouping['title']) == $theGrouping  ){
            $currentGrouping = $grouping;
        }
    }
    $groupSelectorContent .= '</ul>';



    // (main page content stuff here)
    // we need a UL for each group - a line item for each info block, 
    
    $groupContent = '<ul>';

    $groupGuide = '<h6>%s</h6><li>%s</li>';

    
    $infoblockGuide = '<li><p>%s</p><p>%s</p></li>';
    
    foreach( $currentGrouping['group'] as $group ){
        // prep the infoblock content var
        $infoblockContent = '';
        // set the infoblock content var
        foreach( $group['information_blocks'] as $infoblock ){
            $infoblockContent .= sprintf(
                $groupGuide
                ,$infoblock['title']
                ,$infoblock['description']
            );
        }
        // sprint the 'group' and its infoblock within the outer grouping
        $groupContent .= sprintf(
            $groupGuide
            ,$group['title']
            ,$infoblockContent
        );
        
    }
    $groupContent .= '</ul>';

    get_header();
?>
<main id="tools">
    <section>
        <?php 

            echo $groupSelectorContent;
            echo $groupContent;

         ?>
    </section>
</main>
<?php 
    get_footer();
 ?>