<?php 
/**
 * Template Name: Deadlines
 */

    // Get the Deadlines Data
    $home_id = get_page_by_path('home-page', OBJECT, 'page')->ID;
    $deadlines = get_fields($home_id)['deadlines'];
    usort($deadlines, function($a, $b){
        return $a['date'] <=> $b['date'];
    });
    

    // count total # of deadlines
    $total = count($deadlines);
    
    // set max # viewable per page
    $max = 15;
    
    // check which page we are on (no value equal to page 1)
    $pageNum = ( !empty($wp_query->query_vars['pagedd']) ) ? $wp_query->query_vars['pagedd'] : 1;

    // get the starting index for this page
    $start = ( ($pageNum * $max ) - $max);
    
    // get the ending index for this page (or stop at the total)
    $end = ( ($start + $max) > $total ) ? $total : ( $start + $max + 1);
    
    $content_deadlines = '<ul class="deadlines">';
    $format_deadline = '
        <li>
            <h5>%s</h5>
            %s
        </li>
    ';
    // loop thru this page of up to $max items
    for ($i=$start; $i < $end; $i++) {
        if( $deadlines[$i]['status'] == '1' && $deadlines[$i]['date'] >= date('Ymd') ){
            $content_deadlines .= sprintf(
                $format_deadline
                ,date('M d' ,strtotime($deadlines[$i]['date']))
                ,$deadlines[$i]['excerpt']
            );
        }
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
            ? '<li id="paginate-prev"><a href="/deadlines/page/'.($pageNum - 1).'">Prev</a></li>' 
            : '<li class="neu__inactivelink" id="paginate-prev"><a href="/deadlines/page/'.($pageNum - 1).'">Prev</a></li>';
        $next = ( $pageNum < $pagesNeeded ) 
            ? '<li id="paginate-next"><a href="/deadlines/page/'.($pageNum + 1).'">Next</a></li>' 
            : '<li class="neu__inactivelink" id="paginate-next"><a href="/deadlines/page/'.($pageNum + 1).'">Next</a></li>';
        
        
    
        $format_pagination = '<li><a class="%s" href="/deadlines/page/%s/">%s</a></li>';
        
        $pagination = '<ul class="deadlines-pagination">' . $prev;

        for ($i=0; $i < $pagesNeeded; $i++) { 
            $pagination .= sprintf(
                $format_pagination
                ,($i + 1 == $pageNum ) ? 'neu__activepage' : null
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