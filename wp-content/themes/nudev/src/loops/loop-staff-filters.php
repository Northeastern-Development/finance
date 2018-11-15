<?php
/**
 * get departments
 * create a 'filtering nav' to sort by department
 */

    $args = array(
        'post_type' => 'departments',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    $departments = get_posts($args);

    $dept_titles = [];
    foreach( $departments as $department ){
        $dept_titles[] = $department->post_title;
    }

	$return = '';

    $skipThese = array('President','Strategy');

    if( !empty($dept_titles) ){
		foreach($dept_titles as $v){
			if(!in_array($v,$skipThese)){
				$return .= '<li><a '.($filter == strtolower(str_replace(" ","-",$v))?'class="active"':'').' href="'.home_url().'/staff/'.strtolower(str_replace(" ","-",$v)).'" title="Filter to show '.strtolower($v).' team">'.$v.' <span>&#xE313;</span></a></li>';
			}
		}
	}

	echo $return;

?>
