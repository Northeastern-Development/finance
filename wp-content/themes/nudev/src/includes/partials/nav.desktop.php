<?php 
/**
 *  Desktop Nav
 */
    // ( Top Level Nav Links (not dropdowns) )
    $nav_links = array(
        'Forms' => get_permalink( get_page_by_path('forms') ),
        'Tools' => get_permalink( get_page_by_path('tools') ),
        'Expense Codes' => 'https://www.northeastern.edu/'
    );
    $format_nav_links = '<li><a href="%s"><span>%s</span></a></li>';
    $content_nav_links = '';
    foreach( $nav_links as $title => $permalink ){
        $content_nav_links .= sprintf(
            $format_nav_links
            ,$permalink
            ,$title
        );
    }
?>
<nav class="nu__main-nav" id="nu__main-nav-desktop">
    <ul>
        <li class="has-children" data-id="howdoi">
            <a href=""><span>How do I...</span></a>
            <?php 
                if( !is_page_template('templates/template-homepage.php') ) :
                    echo '<div class="neumenu-wrapper" id="howdoi">';
                    include(__DIR__ . '/nav.howdoi.php');
                    echo '</div>';
                endif;
            ?>
        </li>
        
        <?php 
            echo $content_nav_links;
         ?>
        
        

        <li class="has-children" data-id="about"><a href=""><span>About</span></a>
            <div class="neumenu-wrapper" id="about">
                <div class="neumenu-wrapper-inner">

                    <div>
                        <h3>Who we are</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eleifend mauris vel.</p>
                        <a class="neu__iconlink" href="<?php echo get_permalink( get_page_by_path('about') ) ?>"><i class="material-icons">arrow_forward</i><span>Learn More</span></a>
                    </div>
                    
                    <div>
                        <ul>
                            <a href="<?php echo get_permalink( get_page_by_path('about') ); ?>" title="Navigate to the ____ page">
                                <li>
                                    <span>Overview</span>
                                </li>
                            </a>
                            <a href="<?php echo get_permalink( get_page_by_path('staff') ); ?>" title="Navigate to the ____ page">
                                <li>
                                    <span>Department &amp; Staff Information</span>
                                </li>
                            </a>
                            <a href="<?php echo get_permalink( get_page_by_path('contact') ); ?>" title="Navigate to the ____ page">
                                <li>
                                    <span>Contact Us</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </li>

    </ul>
</nav>
