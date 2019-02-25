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

$format_category = '
    <h2>%s</h2>
        <ul class="discounts js__collapsible_list list">
';

$format_item = '
    <li id="%s">
        <a href="javascript:;" title="Toggle dropdown item %s" aria-label="Toggle dropdown item %s"><span>%s</span></a>
        <div>%s</div>
    </li>
';

foreach( $categories as $category ){

    // write category title as section heading, open an UL, then write the items into it
    $content .= sprintf(
        $format_category
        ,$category->post_title
    );
    
    // for each discount item
    foreach( $discounts as $discount ){
        // get item fields
        $fields = get_fields($discount);
        // check item category is within 'this' category
        if( $category->post_title == $fields['category']->post_title ){
        
            // write the title and description into the UL opened by the category,
            $content .= sprintf(
                $format_item
                ,seoUrl($discount->post_title)
                ,$discount->post_title
                ,$discount->post_title
                ,$discount->post_title
                ,$fields['description']
            );
        }

    }
    // then close that UL and begin a new category loop w/ new heading and new UL
    $content .= '</ul>';
}

echo $content;
?>