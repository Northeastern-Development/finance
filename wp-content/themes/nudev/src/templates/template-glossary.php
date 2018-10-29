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


    $alphabet = array('a' => [],'b' => [],'c' => [],'d' => [],'e' => [],'f' => [],'g' => [],'h' => [],'i' => [],'j' => [],'k' => [],'l' => [],'m' => [],'n' => [],'o' => [],'p' => [],'q' => [],'r' => [],'s' => [],'t' => [],'u' => [],'v' => [],'w' => [],'x' => [],'y' => [],'z' => []);
    
    // adds record data to the letter array based on position
    foreach( $glossQuery as $i => $glossPost){
        $fields = get_fields($glossPost);

        // $fields['post_title'] = $glossPost->post_title;

        $alphabet[ $fields['position'] ][] = array("post_title"=>$glossPost->post_title,"description"=>$fields['description']);
    }

    $guide = '<h2>%s</h2>';
    $content = '<div><ul>';

    $objGuide = '<li>%s%s</li>';

    // loop to present information to the screen
    foreach( $alphabet as $letter => $objects ){

        $content .= sprintf($guide, strtoupper($letter));
        
        // each record at the specific letter position
        foreach( $objects as $object ){
            $content .= sprintf(
                $objGuide
                ,$object['post_title']
                ,$object['description']
            );
        }
        $content .= '</ul>';
    }
    
 ?>
<main id="glossary" role="main">
    <section>

        <?php echo $content; ?>
        
    </section>
</main>
<?php 
    get_footer();
 ?>