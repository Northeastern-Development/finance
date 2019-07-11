<?php
    wp_reset_query();

    if( empty($fields) ){
        $fields = get_fields($post->ID);
    }
    $prefooterFields = $fields;

    $return_prefooter = '';

    if($prefooterFields['use_pre-footer'] == 1){	// if the page is using the pre-footer option

        $section_title = ( !empty($prefooterFields['pre-footer_area_title']) ) ? $prefooterFields['pre-footer_area_title'] : 'Helpful Links';
        
        $prefooterBgColor = ($prefooterFields['background_color'] == ''?' bg_white':' bg_'.$prefooterFields['background_color']);
        
        if(isset($prefooterFields['pre-footer_image_block']) && $prefooterFields['pre-footer_image_block'] != ''){		// image blocks: image, title, description
            
            $return_prefooter .= '<h2>'.$section_title.'</h2><div class="nu__prefooter imageblocks'.$prefooterBgColor.'"><div><ul>';
            
            $guide = '
                <li>
                    <a href="%s" title="%s" aria-label="%s" %s>
                        <h4>%s</h4>
                        <p>%s</p>
                        <p><span>Learn More</span></p>
                    </a>
                </li>
            ';
			foreach($prefooterFields['pre-footer_image_block'] as $r){

                $helpful_link_fields = get_fields($r['items'][0]['item']->ID);


				$return_prefooter .= sprintf(
					$guide
                    ,$helpful_link_fields['link']                                                                       // href
                    ,'View ' . $r['items'][0]['item']->post_title                                                       // title
                    ,'View ' . $r['items'][0]['item']->post_title                                                       // aria-label
                    ,( $helpful_link_fields['external_link'] == "1" )    // target
                        ?' target="_blank"'
                        :''
					,$r['block_title']
					,$helpful_link_fields['description']
                );
                
			}
			$return_prefooter .= '</ul></div></div>';
		}
	}
	echo $return_prefooter;	// echo the compiled content back to the footer for the page that called it
?>
