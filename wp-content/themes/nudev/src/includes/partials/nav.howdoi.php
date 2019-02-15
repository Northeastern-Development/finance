<?php 
/**
 * Partial: navigation sub-nav  "How Do I..."
 */
    // 
    $args = array(
        'post_type'         =>  'tasks_categories',
        'posts_per_page'    =>  -1,
        'meta_query'        => array(
            array(
                'key'       => 'status',
                'value'     => '1',
                'compare'   => '='
            )
        )
    );
    $cats = get_posts($args);

    $format_cats = '
        <a href="#" title="View tasks in the %s category" aria-label="View tasks in the %s category">
            <img class="taskicon" src="%s" alt="%s icon" aria-label="%s icon">
            <h4><span>%s</span></h4>
            <ul>
                <li><h4>%s</h4></li>
                %s
            </ul> 
        </a>
    ';
    $format_tasks = '
        <li>
            <a title="View %s" aria-label="View %s" href="%s"><span>%s</span></a>
        </li>
    ';
    $content_cats = '';
    foreach ($cats as $i => $cat) {

        $fields = get_fields($cat->ID);

        // GET active tasks within this category
        $args = array(
            'post_type' => 'tasks',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'status',
                    'value' => '1',
                    'compare' => '='
                ),
                array(
                    'key' => 'category',
                    'value' => $cat->ID,
                    'compare' => 'LIKE'
                )
            )
        );
        $tasks = get_posts($args);

        // SET TASKS STRING
        $content_tasks = '';
        foreach( $tasks as $i => $task ){
            $content_tasks .= sprintf(
                $format_tasks
                ,$task->post_title  // title
                ,$task->post_title  // aria label
                ,site_url('/tasks/') . $cat->post_name.'/'.$task->post_name // href
                ,$task->post_title  // text
            );
        }

        // SET CATS STRING
        $content_cats .= sprintf(
            $format_cats
            ,$cat->post_title   // title
            ,$cat->post_title   // aria label
            ,$fields['icon']    // icon src
            ,$cat->post_title   // icon alt
            ,$cat->post_title   // icon aria
            ,$cat->post_title   // title (text)
            ,$cat->post_title   // title (inner, hidden)
            ,$content_tasks     // content (inner, hidden)
        );
    }
?>
<div class="neumenu-wrapper-inner">
    <div>
        <h2>How Do I...</h2>
        <h3>(Select Topic)</h3>
        <h3>(Select Task)</h3>
        <a title="Return to viewing task categories" aria-label="Return to viewing task categories" class="removefilter nu__content_btn">Back to Topics</a>
    </div>
    <div>
        <?php 
            echo $content_cats;
        ?>
    </div>
</div>