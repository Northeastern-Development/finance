<?php 
/**
 * Template Name: Home Page
 */
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
            <a href="%s" title="View %s" aria-label="View %s">
                <div><div style="background-image: url(%s)" aria-label="%s image"></div></div>
                <h5>%s</h5>
            </a>
        </li>
    ';
    foreach ($res as $i => $rec) {
        $fields = get_fields($rec);
        $content_tools .= sprintf(
            $format_tools
            ,get_permalink($rec) . seoUrl($fields['groupings'][0]['title'])
            ,$rec->post_title
            ,$rec->post_title
            ,$fields['image']
            ,$rec->post_title
            ,$rec->post_title
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
            <a href="%s" target="%s" title="View %s" aria-label="View %s">
                <div><div style="background-image: url(%s)" aria-label="%s image"></div></div>
                <h5>%s</h5>
                <h5>%s</h5>
                <p>%s</p>
                <p><span>Learn more about %s</span></p>
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
            ,$rec->post_title
            ,$fields['image']
            ,$rec->post_title
            ,$rec->post_title
            ,( get_fields( $fields['category']->ID )['status'] == true )
                ? $fields['category']->post_title
                : null
            ,strtok(strip_tags($fields['details']), '.').'.'        // kinda causes some issues if something like example inc. is the first sentence (or other reasons a period would be non-punctual)
            ,$rec->post_title
        );
    }
    // end get news post data
    
    
    // $img = site_url() . '/wp-content/uploads/hp-hero.jpg';
    
    // Get Hero Space fields

    $fields = get_fields($post_id);
    $hero_image = $fields['hero_image'];
    $hero_title = $fields['hero_title'];
    $hero_description = $fields['hero_description'];
    $link_text = $fields['link_text'];
    $link_url = $fields['link_url'];
    $link_ext = $fields['external_url'];

    $format_hero = '
        <section class="hero hero-image" style="background-image: url(%s)" aria-label="%s">
            <div>
                <h2>%s</h2>
                %s
                %s
            </div>
        </section>
    ';

    $format_link = '
        <a href="%s" %s aria-label="View the %s page" title="View the %s page" class="nu__content_btn">%s</a>
    ';
    $content_link = sprintf(
        $format_link
        ,$link_url
        ,( !empty($link_ext) ) ? 'target="_blank"' : ''
        ,$hero_title
        ,$hero_title
        ,(!empty($link_text)) ? $link_text : 'Learn More'
    );

    $content_hero = sprintf(
        $format_hero
        ,$hero_image
        ,$hero_title
        ,$hero_title
        ,( !empty($hero_description) ) ? '<p>' . $hero_description . '</p>': ''
        ,$content_link
    );
    
    get_header();
?>
<main role="main" class="main">

    <div class="neumenu-wrapper" id="howdoi">
        <?php 
            include(locate_template('includes/partials/nav.howdoi.php'));
        ?>
    </div>

    <?php echo $content_hero; ?>

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
            <a title="View All Tools" aria-label="View All Tools" class="nu__content_btn" href="<?php echo get_permalink( get_page_by_path('tools') ); ?>">View All Tools</a>
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
            <a title="View all News and Events" class="nu__content_btn" aria-label="View all News and Events" href="<?php echo get_permalink( get_page_by_path('news-events') ); ?>">View All Updates</a>
        </section>
    <?php 
        endif;
     ?>




</main>
<?php 
    get_footer();
 ?>