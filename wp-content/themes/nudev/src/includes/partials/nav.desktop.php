<?php 
/**
 * Partial: Desktop Nav:
 */

    $hrefs = [
        'forms' => get_permalink( get_page_by_path('forms') )
        ,'tools' => get_permalink( get_page_by_path('tools') )
        ,'banner_codes' => 'https://prod-web.neu.edu/wasapp/Banner/Finance/secure/index.jsp'
        ,'about' => get_permalink( get_page_by_path('about') )
        ,'contact' => get_permalink( get_page_by_path('contact') )
    ];

    $howdoi_in_nav = '';
    $howdoi_in_nav_li_class = '';
    if( !is_page_template('templates/template-homepage.php') ){
        $howdoi_in_nav = 'aria-haspopup="true" aria-expanded="false"';
        $howdoi_in_nav_li_class = 'class="has-children"';
    }

?>
<nav class="nu__main-nav" id="nu__main-nav-desktop" aria-label="Northeastern University Finance Division main navigation">
    <ul role="menubar" aria-label="Northeastern University Finance Division main navigation">
    
        <li role="none" <?=$howdoi_in_nav_li_class;?>>
            <a role="menuitem" href="#" title="" aria-label="" <?= $howdoi_in_nav; ?> tabindex="0" data-name="howdoi">
                <span>How Do I...</span>
            </a>
            <?php 
                // include the howdoi in the nav on every page but the home page
                if( !is_page_template('templates/template-homepage.php') ) :
                    echo '<div class="neumenu-wrapper" id="howdoi">';
                    include(__DIR__ . '/nav.howdoi.php');
                    echo '</div>';
                endif;
            ?>
        </li>


        <li role="none">
            <a title="View the Forms Page" tabindex="0" aria-label="View the Forms Page" href="<?= $hrefs['forms']; ?>"><span>Forms</span></a>
        </li>
        <li role="none">
            <a title="View the Tools Page" aria-label="View the Tools Page" tabindex="0" href="<?= $hrefs['tools']; ?>"><span>Tools</span></a>
        </li>
        <li role="none">
            <a target="_blank" title="View the Banner Codes Page [will open in a new tab or window]" aria-label="View the Banner Codes Page [will open in a new tab or window]" tabindex="0" href="<?= $hrefs['banner_codes']; ?>"><span>Banner Codes</span></a>
        </li>
        
        <li role="none" class="has-children">
            <a role="menuitem" href="#" title="" aria-label="" tabindex="0" aria-haspopup="true" aria-expanded="false" data-name="about">
                <span>About</span>
            </a>

            <ul role="menu">

                <li role="none">
                    <a title="View the About page" tabindex="0" aria-label="View the About page" href="<?= $hrefs['about']; ?>"><span>Departments and Staff</span></a>
                </li>
                
                <li role="none">
                    <a title="View the Contact page" tabindex="0" aria-label="View the Contact page" href="<?= $hrefs['contact']; ?>"><span>Contact Us</span></a>
                </li>
                
            </ul>

        </li>
    </ul>
</nav>