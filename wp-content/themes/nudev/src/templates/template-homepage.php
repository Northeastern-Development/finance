<?php 
/**
 * Template Name: Home Page
 */

    // 
    $img = wp_get_attachment_image_src(3525, 'full');

    // get tools posts data
    $args = array(
        'posts_per_page' => 3
        ,'post_type' => 'tools'
        ,'meta_query' => array(
            'relation' => 'AND'
            ,array(
                'key' => 'featured'
                ,'value' => '1'
                ,'compare' => '='
            )
            ,array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    $res = get_posts($args);
    $content_tools = '';
    $format_tools = '
        <li>
            <a href="%s" title="View %s">
                <div><div style="background-image: url(%s)"></div></div>
                <p>%s</p>
                <p><span>Learn more</span></p>
            </a>
        </li>
    ';
    foreach ($res as $i => $rec) {
        $fields = get_fields($rec);
        $content_tools .= sprintf(
            $format_tools
            ,get_permalink($rec) . seoUrl($fields['groupings'][0]['title'])
            ,$rec->post_title
            ,$fields['image']
            ,strip_tags($fields['short_description'])
        );
    }
    // end get tools post data

    // get news posts
    $args = array(
        'posts_per_page' => 3
        ,'post_type' => 'newsevents-items'
        ,'meta_query' => array(
            'relation' => 'AND'
            ,array(
                'key' => 'featured'
                ,'value' => '1'
                ,'compare' => '='
            )
            ,array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    $res = get_posts($args);


    
    $content_news = '';
    $format_news = '
        <li>
            <a href="%s" target="%s" title="View %s">
                <div><div style="background-image: url(%s)"></div></div>
                <h5>%s</h5>
                <h5>%s</h5>
                <p>%s</p>
                <p><span>Learn more</span></p>
            </a>
        </li>
    ';
    foreach ($res as $i => $rec) {
        $fields = get_fields($rec);

        if( !empty($fields['external_url'])){
            $the_permalink = $fields['external_url'];
            $target = '_blank';
        } else {
            $the_permalink = site_url('news-events/') . $rec->post_name;
            $target = '';
        }
        
        $content_news .= sprintf(
            $format_news
            ,$the_permalink
            ,$target
            ,$rec->post_title
            ,$fields['image']
            ,$rec->post_title
            ,( get_fields( $fields['category']->ID )['status'] == true )
                ? $fields['category']->post_title
                : null
            ,strip_tags($fields['details'])
        );
    }
    // end get news post data
    

    
    get_header();
?>
<main role="main" class="main">

    <div class="neumenu-wrapper" id="howdoi">
        <?php 
            include(locate_template('includes/partials/nav.howdoi.php'));
        ?>
    </div>


    <section class="hero" style="background-image: url(<?= $img[0]; ?>)">
        
        <div>
            <h2>One Centralized Department</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime modi, harum nesciunt repudiandae vel unde neque! Consequuntur error quas, obcaecati recusandae, fugiat quis, unde modi voluptatibus minus aperiam tempore! Quasi.</p>    
            <a title="View the About Page" href="<?php echo get_permalink( get_page_by_path('about') ); ?>"><h4 class="nu__content_btn">Learn More</h4></a>
        </div>

    </section>
    <?php
        // will not output anything if there are no deadlines to show
        include(locate_template('loops/loop-deadlines.php'));
     ?>

    <?php 
        if( !empty($content_tools) ) :
     ?>
        <section class="home-feat-tools fullwidth nobg">
            <h2>Tools</h2>
            <ul>
                <?php 
                    echo $content_tools;
                ?>
            </ul>
            <a title="View All Tools" href="<?php echo get_permalink( get_page_by_path('tools') ); ?>"><h4 class="nu__content_btn">View All</h4></a>
        </section>
    <?php 
        endif;
        if( !empty($content_news) ) :
     ?>
        <section class="home-feat-news fullwidth nobg">
            <h2>Latest Updates</h2>
            <ul>
                <?php 
                    echo $content_news;
                ?>
            </ul>
            <a title="View all News and Events" href="<?php echo get_permalink( get_page_by_path('news-events') ); ?>"><h4 class="nu__content_btn">View All</h4></a>
        </section>
    <?php 
        endif;
     ?>




</main>
<?php 
    get_footer();
 ?>