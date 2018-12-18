<?php
/**
 * Template Name: Glossary
 */
    get_header();


    // Get the Glossary Posts
    $args = array(
        'post_type' => 'glossary_items',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'glossary-item-status',
                'value' => '1',
                'compare' => '='
            ),
            array(
                'key' => 'position'
            )
        ),
        'orderby' => 'position',
        'order' => 'ASC'
    );
    $glossQuery = get_posts( $args );
    // define alphabet w/ each letter associated to an empty array
    $alphabet = array('a' => [],'b' => [],'c' => [],'d' => [],'e' => [],'f' => [],'g' => [],'h' => [],'i' => [],'j' => [],'k' => [],'l' => [],'m' => [],'n' => [],'o' => [],'p' => [],'q' => [],'r' => [],'s' => [],'t' => [],'u' => [],'v' => [],'w' => [],'x' => [],'y' => [],'z' => []);

    // set each letter's empty array to matching glossary posts by their 'position' field
    foreach( $glossQuery as $i => $glossPost)
    {
        $fields = get_fields($glossPost);
        $alphabet[ $fields['position'] ][] = array(
            "post_title" => $glossPost->post_title
            ,"description" => $fields['description']
        );
    }

    $jumpnav = '<div class="glossary-jumpnav">';
    $contents = '<div class="glossary-content">';
    $haspost_guide = '<li><h6>%s</h6>%s</li>';
    // each letter
    foreach( $alphabet as $letter => $array )
    {
        // each letter is a h2 within an ul
        $contents .= '<ul id="'.$letter.'" class="list"><h2>'.strtoupper($letter).'</h2>';
        // if letter has posts
        if( !empty($array) ){
            foreach( $array as $info ){
                $contents .= sprintf(
                    $haspost_guide
                    ,$info['post_title']
                    ,$info['description']
                );
            }
            // jumpnav letter is active
            $jumpnav .= '<span><a href="#'.$letter.'">'.strtoupper($letter).'</a></span>';
        }
        // letter has no posts
        else {
            $jumpnav .= '<span>'.strtoupper($letter).'</span>';
        }
        $contents .= '</ul>';
    }
    $jumpnav .= '</div>';
    $contents .= '</div>';
 ?>
<main role="main">
    <?php 
        $fields = get_fields($post_id);
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields);
     ?>

    <section id="glossary">
      <?php echo $jumpnav; ?>
      <?php echo $contents; ?>
    </section>
</main>
<?php
    get_footer();
 ?>
