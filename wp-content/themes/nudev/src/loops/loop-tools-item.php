<?php
    $toolPost = get_page_by_path($isPost, ARRAY_A, 'tools');
    $fields = get_fields($toolPost['ID']);


    // pre-set an object to contain the fields for the current grouping
    // when the grouping nav is clicked, it will refresh the page; rewriting the current grouping; which will cause this object to dynamically change
    // this should always have an array of the subfields inside of the 'current' grouping
    $currentGrouping = [];

    // dont show this feature if there is only one grouping with groups

    $haveGroups = array_filter($fields['groupings'], function($grouping){
        if( !empty($grouping['group']) ){
            return $grouping;
        }
    });
    if( $haveGroups ){

        $groupSelectorGuide = '<li class="%s"><a href="%s">%s</a></li>';
        $groupSelectorContent = '<ul class="tool-groupingnav">';

        foreach( $fields['groupings'] as $grouping ){
            if( $grouping['status'] == 1 ){

                // pass title to both the nav and the list
                $groupSelectorContent .= sprintf(
                    $groupSelectorGuide
                    ,( seoUrl($grouping['title']) == $theGrouping  ) ? 'tool-grouping-active' : null
                    ,get_permalink($toolPost['ID']) . seoUrl($grouping['title'])
                    ,$grouping['title']
                );

            }
            //
            if( seoUrl($grouping['title']) == $theGrouping ){
                $currentGrouping = $grouping;
            }
            //
        }
        $groupSelectorContent .= '</ul>';
    }
    //


    // (main page content stuff here)
    $groupContent = '<div class="tool-groups">';

    $groupContent_guide = '<ul class="js__collapsible_list"><h2>%s</h2>%s</ul>';

    $infoblock_guide = '<li><h5>%s</h5><div>%s</div></li>';

    foreach( $currentGrouping['group'] as $group ){

        $infoblock_string = '';
        foreach( $group['information_blocks'] as $infoblock ){
            if( $infoblock['status'] == 1){
                $infoblock_string .= sprintf(
                    $infoblock_guide
                    ,$infoblock['title']
                    ,$infoblock['description']
                );
            }
        }

        if($group['status'] == 1){
            $groupContent .= sprintf(
                $groupContent_guide
                ,$group['title']
                ,$infoblock_string
            );
        }


    }
    $groupContent .= '</div>';




    get_header();
?>
<main id="tools" role="main">
    <section>
        <?php

            echo '<h1>'.$toolPost['post_title'] . '</h1>' . $fields['full_description'];

            echo $groupSelectorContent;

            echo $groupContent;

         ?>
    </section>
</main>
<?php
    get_footer();
 ?>
