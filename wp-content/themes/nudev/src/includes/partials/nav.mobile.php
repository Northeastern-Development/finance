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

        <li><a href="">Forms</a>  </li>
        <li><a href="">Tools</a></li>
        <li><a href="">Expense Codes</a></li>

        <li>
        <a class="toggle js-mobile-nav parent" href="javascript:void(0);">About</a>
        <ul class="inner">
            <!-- <h6>Who We Are</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus placerat fringilla.</p> -->
            <li><a href="">Overview</a></li>
            <li><a href="">Department & Staff Information</a></li>
            <li><a href="">Contact US</a></li>
        </ul>
        </li>

    </ul>
    </nav>
</div>