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
	);

	echo $president;

?>
