<?php 
/**
 * Loop: Discounts
 */

// Get Active Discount Categories Posts
$args = array(
    'post_type' => 'discount-categories',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'status',
            'value' => '1',
            'compare' => '='
        )
    ),
);
$categories = get_posts($args);
// Get Active Discount Item Posts
$args = array(
    'post_type' => 'discount-items',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'status',
            'value' => '1',
            'compare' => '='
        )
    ),
);
$discounts = get_posts($args);

$content = '';
$catsguide = '<h2>%s</h2><ul class="js__collapsible_list discounts">';
$itemsguide = '<li><h5>%s</h5><div>%s</div></li>';
// For Each Active Category,
foreach( $categories as $category ){
    // Write the Cat. as a Header
    $content .= sprintf(
        $catsguide
        ,$category->post_title
    );
    // For Each Post
    foreach( $discounts as $discount ){
        // Get Post Fields
        $fields = get_fields($discount);
        // Get Post Category Field & Match Against This Active Category
        if( $category->post_title == $fields['category']->post_title ){
            // Write This Posts Fields into The Page!
            $content .= sprintf(
                $itemsguide
                ,$discount->post_title
                ,$fields['description']
            );
        }
    }
    $content .= '</ul>';
}

echo $content;
?>