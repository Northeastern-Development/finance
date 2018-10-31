<?php 

    // (these exist already in the parent template)
    // $isPost = $wp_query->query_vars['toolname'];
    // $theGrouping = $wp_query->query_vars['toolgroup'];


    $toolPost = get_page_by_path($isPost, ARRAY_A, 'tools');
    $fields = get_fields($toolPost['ID']);
    
    $content = '<ul>';
    $guide = '<li><a href="%s">%s</a></li>';

    foreach( $fields['groupings'] as $grouping ){

        $content .= sprintf(
            $guide
            ,get_permalink($toolPost['ID']) . seoUrl($grouping['title'])
            ,$grouping['title']
        );
        
    }
    $content .= '</ul>';




    get_header();
?>
<main id="tools">
    <section>
        <?php 



            echo $content;

            // [0] => status [1] => categories [2] => image [3] => sub_title [4] => short_description [5] => full_description [6] => custom_link [7] => external_link [8] => groupings 

         ?>
        
        
    </section>
</main>
<?php 
    get_footer();
 ?>