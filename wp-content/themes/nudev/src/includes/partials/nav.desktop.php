<?php 
/**
 *  Desktop Nav
 */
?>
<nav class="nu__main-nav" id="nu__main-nav-desktop">
    <ul>
        <li class="has-children <?php echo ( get_page_template_slug() === 'templates/template-homepage.php' ) ? 'neu__active' : null ?>" data-id="howdoi">
            <a href=""><span>How do I...</span></a>
            <?php 
                if( !is_page_template('templates/template-homepage.php') ) :
                    echo '<div class="neumenu-wrapper" id="howdoi">';
                    include(__DIR__ . '/nav.howdoi.php');
                    echo '</div>';
                endif;
            ?>
        </li>


        <li class="<?php echo ($pagename === 'forms') ? 'neu__active' : null ?>"><a title="Click to open the Forms Page" href="<?php echo get_permalink( get_page_by_path('forms') ); ?>"><span>Forms</span></a></li>
        
        <li class="<?php echo ($pagename === 'tools') ? 'neu__active' : null ?>"><a title="Click to open the Tools Page" href="<?php echo get_permalink( get_page_by_path('tools') ); ?>"><span>Tools</span></a></li>

        <li><a target="_blank" title="Click to open the Expense Codes Page [will open in a new tab or window]" href="https://prod-web.neu.edu/wasapp/Banner/Finance/secure/searchAccount.do?q=AccountCode"><span>Expense Codes</span></a></li>

        <li class="has-children <?php echo ($pagename === 'about') ? 'neu__active' : null ?>" data-id="about"><a href=""><span>About</span></a>
            <div class="neumenu-wrapper" id="about">
                <div class="neumenu-wrapper-inner">

                    <div>
                        <h3>Who we are</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eleifend mauris vel.</p>
                        <a class="neu__iconlink" href="<?php echo get_permalink( get_page_by_path('about') ) ?>">Learn More</a>
                    </div>
                    
                    <div>
                        <ul>
                            <a href="<?php echo get_permalink( get_page_by_path('about') ); ?>" title="Navigate to the ____ page">
                                <li>
                                    <span>Overview</span>
                                </li>
                            </a>
                            <a href="<?php echo get_permalink( get_page_by_path('about') ); ?>" title="Navigate to the ____ page">
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
