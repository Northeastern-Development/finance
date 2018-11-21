<?php 
/**
 * Desktop Nav
 */
// get task categories
$args = array(
    'post_type'         =>  'tasks_categories',
    'posts_per_page'    =>  -1,
    'meta_query'        => array(
        array(
            'key'       => 'status', // (we can always just set this to 'status', but need to verify change everywhere)
            'value'     => '1',
            'compare'   => '='
        )
    )
);
$cats = get_posts($args);

$content_cats = '';
$format_cats = ' 
    <div class="neumenu-item %s">
        <h6>%s</h6>
        <div class="neumenu-sub %s">
            <div class="neumenu-sub-flex">
                <div class="neumenu-sub_box">
                    <ul>
                        %s
                    </ul>
                </div>
            </div>
        </div>
    </div>
';
$format_tasks = '
    <li>
        <a href="%s">%s</a>
    </li>
';
$count = 0;
// loop thru each category looking for posts that are assigned to it,
foreach( $cats as $cat )
{
    // get all active tasks within this category
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

    
    // set: string of each task within 'this' category as line items, reset for each cat
    $content_tasks = '';
    foreach( $tasks as $task ){
        $content_tasks .= sprintf(
            $format_tasks
            ,site_url('/tasks/') . $cat->post_name.'/'.$task->post_name
            ,$task->post_title
        );
    }

    // set: string of each category that contains its tasks
    $content_cats .= sprintf(
        $format_cats
        ,( $count === 0 ) ? 'active' : null
        ,$cat->post_title
        ,( $count === 0 ) ? 'first-sub' : null
        ,$content_tasks
    );

    $count++;
} // end foreach $cats
?>
<nav class="nu__main-nav" id="nu__main-nav-desktop">
    <ul>
        <li class="has-children" data-id="howdoi">
            <a href=""><span>How do I...</span></a>
            <div class="neumenu-wrapper" id="howdoi">
                <div class="neumenu verticle" data-pos="list.right" data-classes="active">
                    <?php echo $content_cats; ?>
                </div>
            </div>
        </li>
        <?php 
            // ( Top Level Nav Links (not dropdowns) )
            $nav_links = array(
                'Forms' => get_permalink( get_page_by_path('forms') ),
                'Tools' => get_permalink( get_page_by_path('tools') ),
                'Expense Codes' => get_permalink( get_page_by_path('expense-codes') )
            );
            $format_nav_links = '<li><a href="%s">%s</a></li>';
            $content_nav_links = '';
            foreach( $nav_links as $title => $permalink ){
                $content_nav_links .= sprintf(
                    $format_nav_links
                    ,$permalink
                    ,$title
                );
            }
            echo $content_nav_links;
         ?>
        <li class="has-children" data-id="about"><a href=""><span>About</span></a>
            <div class="neumenu-wrapper" id="about">
                <div  class="neumenu verticle" data-pos="list.right" data-classes="active">
                    <div class="neumenu-item ">
                        <h6 style="cursor:default;">Who we are</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eleifend mauris vel.</p>
                        <a href="<?php echo get_permalink( get_page_by_path('overview') ) ?>">Learn More</a>
                        <div class="neumenu-sub first-sub">
                            <div class="neumenu-sub-flex">
                                <?php 
                                    $about_submenu_links = array(
                                        'Overview' => get_permalink( get_page_by_path('overview') ),
                                        'Department &amp; Staff Information' => get_permalink( get_page_by_path('staff') ),
                                        'Contact Us' => get_permalink( get_page_by_path('contact-us') )
                                    );
                                    $format_about_submenu_links = '
                                        <div class="neumenu-sub_box neumenu-sub-about">
                                            <h6><a href="%s"><span>%s</span></a></h6>
                                        </div>
                                    ';
                                    $content_about_submenu_links = '';
                                    foreach( $about_submenu_links as $title => $permalink ){
                                        $content_about_submenu_links .= sprintf(
                                            $format_about_submenu_links
                                            ,$permalink
                                            ,$title
                                        );
                                    }
                                    echo $content_about_submenu_links;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>
