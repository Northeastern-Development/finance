<?php 
/**
 *  Desktop Nav
 */
?>
<nav class="nu__main-nav" id="nu__main-nav-desktop">
    <ul>
        <?php 
            // set active class on nav item if page is loaded
            $if_active = (get_page_template_slug() === 'templates/template-homepage.php' || get_page_template_slug() === 'templates/template-tasks.php') ? 'neu__active' : null;
         ?>
        <li class="has-children <?php echo $if_active; ?>" data-id="howdoi">
            <a tabindex="0" href="javascript:;" title="View tasks organized by category" aria-label="View tasks organized by category"><span>How Do I...</span></a>
            <?php 
                if( !is_page_template('templates/template-homepage.php') ) :
                    echo '<div class="neumenu-wrapper" id="howdoi">';
                    include(__DIR__ . '/nav.howdoi.php');
                    echo '</div>';
                endif;
            ?>
        </li>

        <?php 
            $if_active = (get_page_template_slug() === 'templates/template-forms.php') ? 'neu__active' : null;
         ?>

        <li class="<?php echo $if_active; ?>"><a title="View the Forms Page" tabindex="0" aria-label="View the Forms Page" href="<?php echo get_permalink( get_page_by_path('forms') ); ?>"><span>Forms</span></a></li>
        
        
        <?php 
            $if_active = ( get_page_template_slug() === 'templates/template-tools-index.php' || get_page_template_slug() === 'templates/template-tool-detail.php' ) ? 'neu__active' : null;
         ?>
        <li class="<?php echo $if_active; ?>"><a title="View the Tools Page" aria-label="View the Tools Page" tabindex="0" href="<?php echo get_permalink( get_page_by_path('tools') ); ?>"><span>Tools</span></a></li>


        <li><a target="_blank" title="View the Banner Codes Page [will open in a new tab or window]" aria-label="View the Banner Codes Page [will open in a new tab or window]" tabindex="0" href="https://prod-web.neu.edu/wasapp/Banner/Finance/secure/index.jsp"><span>Banner Codes</span></a></li>
        <?php 
            // Nav Refactor :
            $if_active = ( get_page_template_slug() === 'templates/template-about.php' || get_page_template_slug() === 'templates/template-contact.php' || get_page_template_slug() === 'templates/template-departments-detail.php' ) ? 'neu__active' : null;
         ?>
        
        <li class="has-children <?php echo $if_active; ?>" data-id="about">
            <a tabindex="0" title="View the about and contact pages" aria-label="View the about and contact pages" href="javascript:;"><span>About</span></a>
            <div class="neumenu-wrapper" id="about">
                <div class="neumenu-wrapper-inner">
                    <a title="View the About page" tabindex="0" aria-label="View the About page" href="<?php echo get_permalink( get_page_by_path('about') ); ?>">Departments and Staff</a>
                    <a title="View the Contact page" tabindex="0" aria-label="View the Contact page" href="<?php echo get_permalink( get_page_by_path('contact') ); ?>">Contact Us</a>
                </div>
            </div>
        </li>

    </ul>
</nav>