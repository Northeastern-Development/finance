<?php 


class Prefooter
{
    function __construct(){
        $this->do_setup_prefooter_admin();
    }
    function do_setup_prefooter_admin(){


        // we only want to show specific types of posts here cross-linked from the prefooter items, based on selection of type
        function update_acf_post_object_field_choices($title,$post,$field,$post_id){
            $fFP = get_post(get_post($field['parent'])->post_parent);

            if($fFP->post_excerpt === 'pre-footer_'.strtolower(get_metadata('post', $post->ID, 'type')[0]).'_block'){
                return $title;
            }
            else{
                return $title.' --------- Incompatible Type';
            }
        }


        // Add columns to administration post listing
        function add_helpful_links_acf_columns ( $columns ) {
            $slice1 = array_slice($columns, 0, 2, true);
            $slice2 = array_slice($columns, 2, count($columns), true);
            return array_merge($slice1,array('type' => __ ( 'Type' )),$slice2);
        }
        function helpful_links_custom_column ( $column, $post_id ) {
            switch ( $column ) {
                case 'type':
                    echo get_post_meta ( $post_id, 'type', true );
                break;
            }
        }
        // add filter options
        function helpful_links_admin_posts_filter_restrict_manage_posts(){
            global $typenow;
            $type = 'helpful_links';

            if ($typenow == $type){

                $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
                $guide = '<option value="%s"%s>%s</option>';

                // hardcoded values for now, there is an issue retrieving them again after the first filter
                $values = array(
                    'Image' => 'Image'
                    ,'Link' => 'Link'
                    ,'Text' => 'Text'
                );
             ?>
                <select name="ADMIN_FILTER_FIELD_VALUE"><option value=""><?php _e('Filter By Type', 'type'); ?></option>
             <?php
                foreach ($values as $label => $value){
                    printf(
                        $guide
                        ,$value
                        ,$value == $current_v? ' selected="selected"':''
                        ,$label
                    );
                }
             ?>
                </select>
             <?php
            }
        }


        function helpful_links_posts_filter( $query ){
            global $pagenow;
            global $typenow;
            $type = 'helpful_links';
            if ( $typenow == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != ''){
                $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
            }
        }

        add_filter ( 'manage_helpful_links_posts_columns', 'add_helpful_links_acf_columns' );
        add_action ( 'manage_helpful_links_posts_custom_column', 'helpful_links_custom_column', 10, 2 );

        add_action( 'restrict_manage_posts', 'helpful_links_admin_posts_filter_restrict_manage_posts' );
        add_filter( 'parse_query', 'helpful_links_posts_filter' );


        // this needs to be tied to specific fields (Not all post_object fields anywhere!)
        // add_filter( 'acf/fields/post_object/result', 'update_acf_post_object_field_choices', 100, 4 );
        
        
    }// end 'do_setup_prefooter_admin'
    
    
} // end class


$Prefooter = new Prefooter();


?>