<?php 
/**
 *  Template Name: Tool Detail
 * 
 *  Description:
 *          
 */
    // Get Custom Query Vars -- i.e., site_url.com/tools/banner/access
    $toolname = get_query_var('toolname')  ;              // i.e., 'banner'

    $toolgrouping = get_query_var('toolgroup');         // i.e., 'access'

    // check for query var value, use that for get post
    if( $toolname !== 'null' ){
        // get post object
        $toolpost = get_page_by_path($toolname, ARRAY_A, 'tools');
        // get ACF fields
        $fields = get_fields($toolpost['ID']);
    }


    // 
    // 
    // remove any 'groupings' that are empty
    $haveGroups = array_filter($fields['groupings'], function($grouping){
        if( !empty($grouping['group']) ){
            return $grouping;
        }
    });


    $group_titles = array_map(function($n){
        return seoUrl($n);
    },array_column($haveGroups, 'title'));

    $matches = array_search($toolgrouping, $group_titles);


    // check if toolgrouping is empty
    if( $toolgrouping == 'null' || $matches === false){
        // if this is empty, we need to redirect
        wp_redirect(site_url('/tools/').$toolname.'/'.seoUrl($fields['groupings'][0]['title']));
        exit();
    }
    
    


    // 
    // 
    // 
    if( !empty($haveGroups) ){

        $groupSelectorGuide = '<li class="%s"><a href="%s" title="Filter to show information about %s" aria-label="Filter to show information about %s">%s</a></li>';
        $groupSelectorContent = '<ul class="tool-groupingnav">';

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