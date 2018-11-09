<?php 
// format output
$content_howdoi = '';
$format_howdoi = '
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
// format output
$content_tasks = '';
$format_tasks = '
    <li>
        <a href="%s">
            %s
        </a>
    </li>
';
// set a counter (first submenu item gets an 'active' class)
$counter = 0;
// sprintf content
foreach ($filter_cats as $cat_name => $cat_tasks) {
    $content_tasks = '';
    foreach( $cat_tasks as $cat_task ){
        $content_tasks .= sprintf(
            $format_tasks
            ,site_url( '/tasks/' . $cat_name . '/' . $cat_task->post_name)
            ,$cat_task->post_title
        );
    }
    $content_howdoi .= sprintf(
        $format_howdoi
        ,($counter == 0 ) ? 'active' : ''
        ,get_page_by_path($cat_name, OBJECT, 'tasks_categories')->post_title
        ,($counter == 0 ) ? 'first-sub' : ''
        ,$content_tasks
    );
    $counter++;
}
?>
<nav class="nu__main-nav" id="nu__main-nav-desktop">
    <ul>
        <li class="has-children" data-id="howdoi">
            <a href=""><span>How do I...</span></a>
            <div class="neumenu-wrapper" id="howdoi">
                <div class="neumenu verticle" data-pos="list.right" data-classes="active">
                    <?php echo $content_howdoi; ?>
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
