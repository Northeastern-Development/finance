<?php 
/**
 * Template Name: Deadlines
 */
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
    
    $content_deadlines = '<ul class="deadlines">';
    $format_deadline = '
        <li>
            <h5>%s</h5>
            %s
        </li>
    ';
    // loop thru this page of up to $max items
    for ($i=$start; $i < $end; $i++) {
        $fields = get_fields($deadlines[$i]);
        $content_deadlines .= sprintf(
            $format_deadline
            ,date('M d' ,strtotime($fields['date']))
            ,$fields['details']
        );
    }
    $content_deadlines .= '</ul>';


    // now we make the pagination!
    $pagination = '';
    $pagesNeeded = ceil($total / $max);

    if( $pagesNeeded > 1 ){

        // create conditionally rendered prev/next buttons
        // (prev button only appears if we are on a $pageNum greater than one)
        // (next button only appears if we are on a $pageNum smaller than $pagesNeeded)
        
        $prev = ( $pageNum > 1 ) 
            ? '<li id="paginate-prev"><a title="View previous page" aria-label="View previous page" href="/deadlines/page/'.($pageNum - 1).'">Prev</a></li>' 
            : '<li class="neu__inactivelink" id="paginate-prev"><a href="/deadlines/page/'.($pageNum - 1).'">Prev</a></li>';
        $next = ( $pageNum < $pagesNeeded ) 
            ? '<li id="paginate-next"><a title="View next page" aria-label="View next page" href="/deadlines/page/'.($pageNum + 1).'">Next</a></li>' 
            : '<li class="neu__inactivelink" id="paginate-next"><a href="/deadlines/page/'.($pageNum + 1).'">Next</a></li>';
        
        
    
        $format_pagination = '<li><a class="%s" title="View page %s" aria-label="View page %s" href="/deadlines/page/%s/">%s</a></li>';
        
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
    
    get_header();
?>
<main>
    <?php 
        $fields = get_fields($post_id);
        echo PageHero::return_pagehero($fields);
    ?>

    <section>
        <?php echo $pagination; ?>
        <?php echo $content_deadlines; ?>
        <?php echo $pagination; ?>
    </section>
</main>
<?php 
    get_footer();
?>