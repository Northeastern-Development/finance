<?php 
/**
 * Template Name: Deadlines
 */


    //  default get posts args
    // all deadlines, must be active status, date must be in the future
    $args = array(
        'post_type'     => 'deadlines'
        ,'posts_per_page'   => -1
        ,'meta_query'   => array(
            'relation' => 'AND'
            ,array(
                'key'       => 'status',
                'value'     => '1',
                'compare'   => '='
            )
            ,array(
                'key' => 'date'
                ,'compare' => '>='
                ,'value' => date('Y-m-d')
                ,'type' => 'DATE'
            )
        )
        ,'orderby' => 'meta_value'
        ,'meta_key' => 'date'
        ,'order' => 'ASC'
    );


    // check if we have a filter query var
    $typeToFilter = !empty($wp_query->query_vars['deadline-type']) ? $wp_query->query_vars['deadline-type'] : '';

    // if we have a filter query var; append the relevant args to the meta query before you fire it
    if( !empty($typeToFilter) ){


        // if we are looking for deadlines; also show all the posts that have empty type field?
        if( $typeToFilter == 'deadlines' ){
            
            $args['meta_query'][] = array(
                'relation' => 'OR'
                ,array(
                    'key' => 'type'
                    ,'compare' => 'NOT EXISTS'
                )
                ,array(
                    'key' => 'type'
                    ,'compare' => '='
                    ,'value' => $wp_query->query_vars['deadline-type']
                )
            );
            
        }
        
        // otherwise; just normally show what is filtered
        else {
            $args['meta_query'][] = array(
                'key' => 'type'
                ,'compare' => '='
                ,'value' => $wp_query->query_vars['deadline-type']
            );
        }
        
    
    }
    
    // Get the posts ( also, gets the filtered or paginated posts )
    $deadlines = get_posts($args);

    // count total # of deadlines
    $total = count($deadlines);
    
    // set max # viewable per page
    $max = 15;
    
    // check which page we are on (no value equal to page 1)
    $pageNum = ( !empty($wp_query->query_vars['pagedd']) ) ? $wp_query->query_vars['pagedd'] : 1;

    // get the starting index for this page
    $start = ( ($pageNum * $max ) - $max);
    
    // get the ending index for this page (or stop at the total)
    $end = ( ($start + $max) > $total ) ? $total : ( $start + $max );
    
    
    // 
    // 
    // 
    // 
    
    
    $format_deadline = '
        <li%s>
            <h5>%s</h5>
            %s
        </li>
    ';
    
    
    if( !empty($deadlines) ){
        
        $content_deadlines = '<ul class="deadlines">';

    
        // loop thru this page of up to $max items
        for ($i=$start; $i < $end; $i++) {
        
            $fields = get_fields($deadlines[$i]);
    
        
            $content_deadlines .= sprintf(
                $format_deadline
                ,( !empty($fields['type']) ? ' class="'.$fields['type'].'"' : '' )
                ,date('M d' ,strtotime($fields['date']))
                ,$fields['details']
            );
        }
    
    
        $content_deadlines .= '</ul>';

    } else {
        $content_deadlines = '<div class="deadlines-nonefound">Sorry, no Important Dates were found...</div>';
    }

    // 
    // 
    // 
    // 


    // now we make the pagination!
    $pagination = '';
    $pagesNeeded = ceil($total / $max);

    if( $pagesNeeded > 1 ){

        // create conditionally rendered prev/next buttons
        // (prev button only appears if we are on a $pageNum greater than one)
        // (next button only appears if we are on a $pageNum smaller than $pagesNeeded)
        
        
        // if we have a type filter we need to modify the pagination
        $modhref = ( !empty($typeToFilter) ? $typeToFilter.'/' : '');
        
        
        $prev = ( $pageNum > 1 ) 
            ? '<li id="paginate-prev"><a title="View previous page" aria-label="View previous page" href="/deadlines/'.$modhref.'page/'.($pageNum - 1).'">Prev</a></li>' 
            : '<li class="neu__inactivelink" id="paginate-prev"><a href="/deadlines/'.$modhref.'page/'.($pageNum - 1).'">Prev</a></li>';
        $next = ( $pageNum < $pagesNeeded ) 
            ? '<li id="paginate-next"><a title="View next page" aria-label="View next page" href="/deadlines/'.$modhref.'page/'.($pageNum + 1).'">Next</a></li>' 
            : '<li class="neu__inactivelink" id="paginate-next"><a href="/deadlines/'.$modhref.'page/'.($pageNum + 1).'">Next</a></li>';
        
        
    
        $format_pagination = '<li><a class="%s" title="View page %s" aria-label="View page %s" href="/deadlines/'.$modhref.'page/%s/">%s</a></li>';
        
        $pagination = '<ul class="deadlines-pagination">' . $prev;

        for ($i=0; $i < $pagesNeeded; $i++) { 
            $pagination .= sprintf(
                $format_pagination
                ,($i + 1 == $pageNum ) ? 'neu__activepage' : null
                ,($i + 1)
                ,($i + 1)
                ,($i + 1)
                ,($i + 1)
            );
        }
        $pagination .= $next . '</ul>';
    }    
    
    // 
    // 
    // 
    // 
    
    $content_filtering = '
        <div class="deadlines-typefilter">
            <div>Filter By:</div>
            <div>
                <ul>
                    <li><a '.( $typeToFilter === 'deadlines' ? 'class="active"' : '' ).' href="'.site_url('/deadlines/deadlines').'" title="Filter to view only Deadlines" aria-label="Filter to view only Deadlines"><span class="colorkey deadlines"></span><span>Deadlines</span></a></li>
                    <li><a '.( $typeToFilter === 'trainings' ? 'class="active"' : '' ).' href="'.site_url('/deadlines/trainings').'" title="Filter to view only Trainings" aria-label="Filter to view only Trainings"><span class="colorkey trainings"></span><span>Trainings</span></a></li>
                    <li><a '.( $typeToFilter === 'events' ? 'class="active"' : '' ).' href="'.site_url('/deadlines/events').'" title="Filter to view only Events" aria-label="Filter to view only Events"><span class="colorkey events"></span><span>Events</span></a></li>
                    <li><a class="clear-filter nu__content_btn" href="'.site_url('/deadlines/').'" title="View all Important Events" aria-label="View all Important Events">Clear</a></li>
                </ul>
            </div>
        </div>
    ';

    $content_filtering = '
        <div class="deadlines-typefilter">
            <div>Filter By:</div>
            <div>
                <ul>
                    <li><a '.( $typeToFilter === 'deadlines' ? 'class="active"' : '' ).' href="'.site_url('/deadlines/deadlines').'" title="Filter to view only Deadlines" aria-label="Filter to view only Deadlines"><span class="colorkey deadlines"></span><span>Deadlines</span></a></li>
                    <li><a '.( $typeToFilter === 'trainings' ? 'class="active"' : '' ).' href="'.site_url('/deadlines/trainings').'" title="Filter to view only Trainings" aria-label="Filter to view only Trainings"><span class="colorkey trainings"></span><span>Trainings</span></a></li>
                    <li><a class="clear-filter nu__content_btn" href="'.site_url('/deadlines/').'" title="View all Important Events" aria-label="View all Important Events">Clear</a></li>
                </ul>
            </div>
        </div>
    ';
    
    // 
    // 
    // 
    // 

    get_header();
?>
<main>
    <?php 
        $fields = get_fields($post_id);
        echo PageHero::return_pagehero($fields);
    ?>

    <section>
        <?php echo $pagination; ?>
        <?php echo $content_filtering; ?>
        <?php echo $content_deadlines; ?>
        <?php echo $pagination; ?>
    </section>
</main>
<?php 
    get_footer();
?>