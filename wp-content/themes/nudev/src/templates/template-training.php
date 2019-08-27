<?php 
/**
 * Template Name: Training
 */
    $args = array(
        'post_type'     => 'training_items'
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
    $training_items = get_posts($args);

    // count total # of training_items
    $total = count($training_items);
    
    // set max # viewable per page
    $max = 3;
    
    // check which page we are on (no value equal to page 1)
    $pageNum = ( !empty($wp_query->query_vars['pagedd']) ) ? $wp_query->query_vars['pagedd'] : 1;

    // get the starting index for this page
    $start = ( ($pageNum * $max ) - $max);
    
    // get the ending index for this page (or stop at the total)
    $end = ( ($start + $max) > $total ) ? $total : ( $start + $max );
    
    $content_training_items = '<ul class="training_items">';
    $format_training_item = '
        <li>
            <h5>%s</h5>
            <h3>%s</h3>
            %s
        </li>
    ';
    // loop thru this page of up to $max items
    for ($i=$start; $i < $end; $i++) {
        $fields = get_fields($training_items[$i]);
        $content_training_items .= sprintf(
            $format_training_item
            ,date('M d' ,strtotime($fields['date']))
            ,$training_items[$i]->post_title
            ,$fields['details']
        );
    }
    $content_training_items .= '</ul>';


    // now we make the pagination!
    $pagination = '';
    $pagesNeeded = ceil($total / $max);

    if( $pagesNeeded > 1 ){

        // create conditionally rendered prev/next buttons
        // (prev button only appears if we are on a $pageNum greater than one)
        // (next button only appears if we are on a $pageNum smaller than $pagesNeeded)
        
        $prev = ( $pageNum > 1 ) 
            ? '<li id="paginate-prev"><a title="View previous page" aria-label="View previous page" href="/training/page/'.($pageNum - 1).'">Prev</a></li>' 
            : '<li class="neu__inactivelink" id="paginate-prev"><a href="/training/page/'.($pageNum - 1).'">Prev</a></li>';
        $next = ( $pageNum < $pagesNeeded ) 
            ? '<li id="paginate-next"><a title="View next page" aria-label="View next page" href="/training/page/'.($pageNum + 1).'">Next</a></li>' 
            : '<li class="neu__inactivelink" id="paginate-next"><a href="/training/page/'.($pageNum + 1).'">Next</a></li>';
        
        
    
        $format_pagination = '<li><a class="%s" title="View page %s" aria-label="View page %s" href="/training/page/%s/">%s</a></li>';
        
        $pagination = '<ul class="training_items-pagination">' . $prev;

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

    <section class="training_grid">
        <?php echo $pagination; ?>
        <?php echo $content_training_items; ?>
        <?php echo $pagination; ?>
    </section>
</main>
<?php 
    get_footer();
?>