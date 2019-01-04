<?php 
/**
 *  Desktop Nav
 */
?>
<nav class="nu__main-nav" id="nu__main-nav-desktop">
    <ul>
        <li class="has-children" data-id="howdoi">
            <a href=""><span>How do I...</span></a>
            <div class="neumenu-wrapper" id="howdoi">
                <?php 
                    if( !is_page_template('templates/template-homepage.php') ){
                        include(__DIR__ . '/nav.howdoi.php');
                    }
                 ?>
            </div>
        </li>
        <?php 
            // ( Top Level Nav Links (not dropdowns) )
            $nav_links = array(
                'Forms' => get_permalink( get_page_by_path('forms') ),
                'Tools' => get_permalink( get_page_by_path('tools') ),
                'Expense Codes' => 'https://www.northeastern.edu/'
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
