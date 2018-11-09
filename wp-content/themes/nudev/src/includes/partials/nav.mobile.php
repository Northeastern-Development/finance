<?php 
$content_howdoi = '';
$format_howdoi = '
    <li>
        <a class="toggle js-mobile-nav child" href="#">%s</a>
        <div class="inner">
            <ul>
                %s
            </ul>
        </div>
    </li>
';
$format_tasks = '<li><a href="%s">%s</a></li>';
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
        ,get_page_by_path($cat_name, OBJECT, 'tasks_categories')->post_title
        ,$content_tasks
    );
}
?>
<div id="nu__mobile">
    <nav>
        <ul>
            <li>
                <a class="toggle js-mobile-nav parent" href="javascript:void(0);">How do I..</a>
                <ul class="inner">
                    <?php echo $content_howdoi; ?>    
                </ul>
            </li>
            <?php 
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
            <li>
                <a class="toggle js-mobile-nav parent" href="javascript:void(0);">About</a>
                <ul class="inner">
                    <?php 
                        $format_about_submenu_links = '<li><a href="%s">%s</a></li>';
                        $about_submenu_links = array(
                            'Overview' => get_permalink( get_page_by_path('overview') ),
                            'Department &amp; Staff Information' => get_permalink( get_page_by_path('staff') ),
                            'Contact Us' => get_permalink( get_page_by_path('contact-us') )
                        );
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
                </ul>
            </li>
        </ul>
    </nav>
</div>