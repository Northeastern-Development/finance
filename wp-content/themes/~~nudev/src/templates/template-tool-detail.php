<?php 
/**
 * Template Name: Tool Detail
 */
    // get query vars
    $toolgrouping = get_query_var('toolgroup');
    $toolname = get_query_var('toolname');
    // use query var to determine which tool is displayed
    $toolpost = get_page_by_path($toolname, ARRAY_A, 'tools');
    // get fields for that tool
    $fields = get_fields($toolpost['ID']);
    // 
    $haveGroups = array_filter($fields['groupings'], function($grouping){
        if( !empty($grouping['group']) ){
            return $grouping;
        }
    });


    /**
     *      Filtering Nav
     */
    if( !empty($haveGroups) ){

        $groupSelectorGuide = '
            <li class="%s">
                <a href="%s" title="Filter to show information about %s" aria-label="Filter to show information about %s">%s</a>
            </li>
        ';
        $groupSelectorContent = '
            <ul class="tool-groupingnav">
        ';
        // a 'grouping' is like 'use concur as full time employee'
        // unsets var
        $currentGrouping = [];


        foreach( $fields['groupings'] as $grouping ){
            if( $grouping['status'] == 1 ){
                // pass title to both the nav and the list
                $groupSelectorContent .= sprintf(
                    $groupSelectorGuide
                    ,( seoUrl($grouping['title']) == $toolgrouping  ) ? 'tool-grouping-active' : null
                    ,get_permalink($toolpost['ID']) . seoUrl($grouping['title'])
                    ,$grouping['title']
                    ,$grouping['title']
                    ,$grouping['title']
                );
            }
            if( seoUrl($grouping['title']) == $toolgrouping ){
                $currentGrouping = $grouping;
            }
        }
        $groupSelectorContent .= '</ul>';
    }


    /**
     *      Page Content Setup
     */

        $format_group = '
            <div class="tool-group">
                <a href="javascript:;" title="Toggle dropdown for %s" aria-label="Toggle dropdown for %s"><span>%s</span></a>
                <ul class="neu__fancy_bullets">
                    %s
                </ul>
            </div>
        ';
        $format_infoblocks = '<li><h5>%s</h5>%s</li>';
        
        foreach( $currentGrouping['group'] as $group ){
            // check if 'this' grouping is active,
            if( $group['status'] == 1 ){
                // pre-stringify all the active infoblocks belonging to this grouping
                $content_infoblocks = '';
                foreach( $group['information_blocks'] as $infoblock ){
                    if( $infoblock['status'] == 1 ){
                        $content_infoblocks .= sprintf(
                            $format_infoblocks
                            ,$infoblock['title']
                            ,$infoblock['description']
                        );
                    }
                }

                $content_group .= sprintf(
                    $format_group
                    ,$group['title']
                    ,$group['title']
                    ,$group['title']
                    ,$content_infoblocks
                );
            }
        }
    /**
     *      End Page Content Setup
     */

    get_header();
?>
<main role="main">

    <?php 
        $fields = get_fields($post_id);
        echo PageHero::return_pagehero($fields, $toolpost['post_title'], null);
     ?>

    <section>
        <?php 
            $fields = get_fields($toolpost['ID']);
            echo $fields['full_description'];
         ?>
    </section>
    
    <section>
        <?php
            echo $groupSelectorContent;
            echo '<h2>'.$currentGrouping['title'].'</h2>';
            echo $content_group;
        ?>
    </section>
</main>
<?php 
    get_footer();
?>