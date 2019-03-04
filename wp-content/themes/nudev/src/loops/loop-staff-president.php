<?php

    // Get post_id of "president" department
    $args = array(
        'post_type' => 'departments',
        'name' => 'office-of-the-svp-of-finance' // query by slug
    );
    $pres_type = get_posts($args);

    // Get the President Post (should only be one)
    $args = array(
        'posts_per_page' => 1,
        'post_type' => 'staff',
        'meta_query' => array(
            array(
                'key' => 'department',
                'value' => '"' . $pres_type[0]->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );
    $pres = get_posts($args);

    if( !empty($pres) ){
        $fields = get_fields($pres[0]->ID);
    
        if( !empty($fields['status']) ){
            
            // (empty div is a darkened overlay)
            $guide = '
                <section class="nu__president">
                    <div style="background-image: url(%s);" aria-label="%s\'s profile image">
                        <div></div>
                        <p><span>%s</span><br />%s</p>
                    </div>
                    <div>
                        <h3>%s</h3>
                        <p>%s</p>
                        <p>%s</p>
                        <p>%s</p>
                    </div>
                </section>
            ';
        
            $president = sprintf(
                $guide
                ,$fields['headshot']['url']
                ,$pres[0]->post_title
                ,$pres[0]->post_title
                ,$fields['title']
                ,(get_page_template_slug($post_id) == "templates/template-about.php") ? "Finance Division Leadership" : "Finance Division Leadership"
                ,$fields['description']
                , ( !empty($fields['phone']) )
                    ? '<a href="tel:'.$fields['phone'].'" title="Call '.$pres[0]->post_title.'" aria-label="Call '.$pres[0]->post_title.'" class="neu__iconlink neu__iconlink-phone">'.$fields['phone'].'</a>'
                    : null
                , ( !empty($fields['email']) )
                    ? '<a href="mailto:'.$fields['email'].'" title="Email '.$pres[0]->post_title.'" aria-label="Email '.$pres[0]->post_title.'" class="neu__iconlink neu__iconlink-email">email</a>'
                    : null
            );
        
            echo $president;
        }
        

    }
?>
