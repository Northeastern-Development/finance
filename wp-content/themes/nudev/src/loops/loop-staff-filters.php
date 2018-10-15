<?php

	// this will grab the select options for departments in the CMS to be used as filters on screen

	$field_key = "field_5a5e2ca106a03";
	$field = get_field_object($field_key);

	$return = '';

	$skipThese = array('President','Strategy');

	if($field){
		foreach($field['choices'] as $k => $v){
			if(!in_array($v,$skipThese)){
				$return .= '<li><a '.($filter == strtolower(str_replace(" ","-",$v))?'class="active"':'').' href="'.home_url().'/about/university-administration/'.strtolower(str_replace(" ","-",$v)).'" title="Filter to show '.strtolower($v).' team">'.$v.' <span>&#xE313;</span></a></li>';
			}
		}
	}

	echo $return;

?>
