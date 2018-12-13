<?php 
/**
 * Template Name: Tool Detail
 * 
 */
    
    $toolgrouping = get_query_var('toolgroup');
    $toolname = get_query_var('toolname');

    $toolpost = get_page_by_path($toolname, ARRAY_A, 'tools');

    $fields = get_fields($toolpost['ID']);

    $currentGrouping = [];
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
                    ,( seoUrl($grouping['title']) == $toolgrouping  ) ? 'tool-grouping-active' : null
                    ,get_permalink($toolpost['ID']) . seoUrl($grouping['title'])
                    ,$grouping['title']
                );
            }
            //
            if( seoUrl($grouping['title']) == $toolgrouping ){
                $currentGrouping = $grouping;
            }
        }
        $groupSelectorContent .= '</ul>';
    }
    

    // (main page content stuff here)
    $groupContent = '<div class="tool-groups">';

    $groupContent_guide = '<h2>%s</h2><ul class="js__collapsible_list list">%s</ul>';

    $infoblock_guide = '<li><h5>%s</h5><div>%s</div></li>';

    if( !empty($currentGrouping['group']) ){
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
    }
    $groupContent .= '</div>';

    
    get_header();
?>
<main role="main">

    <?php 
        // get hero space if enabled
        $base_title = $toolpost['post_title'];
        $fields = get_fields($post_id);
        if( $fields['use_hero'] == '1' ){
            include(locate_template('includes/pagehero.php'));
        }
     ?>

    <section>
        <?php 
            echo $fields['full_description'];
         ?>
    </section>
    
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