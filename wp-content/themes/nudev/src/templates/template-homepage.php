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
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    $res = get_posts($args);
    $content_tools = '';
    $format_tools = '
        <div>
            <a href="%s">
                <img src="%s">
                <p>%s</p>
                <p><i class="material-icons">arrow_forward</i>Learn more</p>
            </a>
        </div>
    ';
    foreach ($res as $i => $rec) {
        $fields = get_fields($rec);
        $content_tools .= sprintf(
            $format_tools
            ,get_permalink($rec) . seoUrl($fields['groupings'][0]['title'])
            ,$fields['image']
            ,$fields['short_description']
        );
    }
    // end get tools post data

    // get news posts
    $args = array(
        'posts_per_page' => 3
        ,'post_type' => 'newsevents-items'
        ,'meta_query' => array(
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    $res = get_posts($args);


    
    $content_news = '';
    $format_news = '
        <div>
            <a href="%s" target="%s">
                <img src="%s">
                <h5>%s</h5>
                <p>%s</p>
                <p><i class="material-icons">arrow_forward</i>Learn more</p>
            </a>
        </div>
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
            ,$fields['image']
            ,$rec->post_title
            ,$fields['details']
        );
    }
    // end get news post data
    

    
    get_header();
?>
<div role="main" class="main">


    <?php 
        include(locate_template('includes/partials/nav.howdoi.php'));
     ?>


    <section class="hero" style="background-image: url(<?= $img[0]; ?>)">
        
        <div>
            <h2>One Centralized Department</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime modi, harum nesciunt repudiandae vel unde neque! Consequuntur error quas, obcaecati recusandae, fugiat quis, unde modi voluptatibus minus aperiam tempore! Quasi.</p>    
            <a class="nu__content_btn" href="<?php echo get_permalink(3550); ?>">Learn More</a>
        </div>

        <?php
            // will not output anything if there are no deadlines to show
            include(locate_template('loops/loop-deadlines.php'));
         ?>
    </section>

    <section class="home-feat-tools fullwidth nobg">
        <h1>Tools</h1>
        <div>
            <?php 
                echo $content_tools;
            ?>
        </div>
        <a class="nu__content_btn" href="<?php echo get_permalink(3183); ?>"><h4>View All</h4></a>
    </section>

    <section class="home-feat-news fullwidth nobg">
        <h1>Latest Updates</h1>
        <div>
            <?php 
                echo $content_news;
             ?>
        </div>
        <a class="nu__content_btn" href="<?php echo get_permalink(143); ?>"><h4>View All</h4></a>
    </section>




</div>
<?php 
    get_footer();
 ?>