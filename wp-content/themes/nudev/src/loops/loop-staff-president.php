<?php

    // Get post_id of "president" department
    $args = array(
        'post_type' => 'departments',
        'name' => 'president' // query by slug
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

    $fields = get_fields($pres[0]->ID);


    if( get_page_template_slug($post_id) == "templates/template-about.php" ){
        $visit_or_email = '<a class="neu__iconlink" href="%s" title="email the President" target="_blank">email</a>';
    } else {   
        $visit_or_email = '<a class="neu__iconlink" href="%s" title="Visit website [will open in new window]" target="_blank">Visit website</a>';
    }
    // (empty div is a darkened overlay)
    $guide = '
        <section class="nu__president">
            <div style="background-image: url(%s);">
                <div></div>
                <p><span>%s</span><br />%s</p>
            </div>
            <div>
                <h3>%s</h3>
                <p>%s</p>
                <p>
                    <a class="neu__iconlink" href="tel:%s" title="Call the Office of the President">%s</a>
                    <br />
                    %s
                </p>
            </div>
        </section>
    ';

	$president = sprintf(
		$guide
		,$fields['headshot']['url']
        ,$pres[0]->post_title
        ,$fields['title']
        ,(get_page_template_slug($post_id) == "templates/template-about.php") ? "One Centralized Department" : "Office of the President"
		,$fields['description']
		,$fields['phone']
        ,$fields['phone']
        ,$visit_or_email
        // ,$fields['url']
        
	);

	echo $president;

?>
