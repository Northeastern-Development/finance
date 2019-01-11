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
                'value' => $pres_type[0]->ID,
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
                <p><span>%s</span><br />President</p>
            </div>
            <div>
                <h3>Office of the President</h3>
                <p>%s</p>
                <p>
                    <a class="neu__iconlink" href="tel:%s" title="Call the Office of the President"><i class="material-icons">phone</i><span>%s</span></a>
                    <br />
                    <a class="neu__iconlink" href="%s" title="Visit website [will open in new window]" target="_blank"><i class="material-icons">arrow_forward</i><span>Visit website</span></a>
                </p>
            </div>
        </section>
    ';

	$president = sprintf(
		$guide
		,$fields['headshot']['url']
		,$pres[0]->post_title
		,$fields['description']
		,$fields['phone']
		,$fields['phone']
		,$fields['url']
	);

	echo $president;

?>
