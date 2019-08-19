<?php 
/**
 *      Manage Redirection;
*/

    // explode URL to determine where we are
    $pageQuery = explode("/",$_SERVER['REQUEST_URI']);

    // 
    $postType = $pageQuery[1];
    $postSlug = $pageQuery[2];
    $postAttach = $pageQuery[3];

    
    if( $postType == 'forms' ) // if this is a single for the form post type,
    {
        // get this post
        $args = array(
            'name' => $postSlug
            ,'posts_per_page' => 1
            ,'post_type' => 'forms'
        );
        $rec = get_posts($args);
    
        // if we got a post
        if( !empty($rec) ){

            // get the fields (to get category)
            $fields = get_fields($rec[0]->ID);

            // generate a hash value from the category and post titles
            $hashCat = seoUrl($fields['category']->post_title);
            $hashPost = seoUrl($rec[0]->post_title);
            $hashFull = '#'.$hashCat.'_'.$hashPost;

            wp_redirect(site_url('/forms/'.$hashFull));
            exit();
        }
    }
    // always just send financial statements back to their index page (no singles exist whatsoever)
    else if ( $postType == 'financial_statements' ){
        wp_redirect(site_url('/financial-statements/'));
        exit();
    }

    // direct glossary items to the glossary index page; with hash to jump to named anchor
    else if ( $postType == 'glossary_items' ){
        wp_redirect(site_url('/glossary/#'.$postSlug));
        exit();
    }

    // direct discount categories to the discounts index page
    else if ( $postType == 'discount-categories' ){
        wp_redirect(site_url('/discounts/'));
        exit();
    }

    // direct discount items to the discounts index page w/ hash to jump to named anchor
    else if ( $postType == 'discount-items' ){
        
        // get this post
        $args = array(
            'name' => $postSlug
            ,'posts_per_page' => 1
            ,'post_type' => 'discount-items'
        );
        $rec = get_posts($args);
    
        // if we got a post
        if( !empty($rec) ){

            // get the fields (to get category)
            $fields = get_fields($rec[0]->ID);

            // generate a hash value from the category and post titles
            $hashCat = seoUrl($fields['category']->post_title);
            $hashPost = seoUrl($rec[0]->post_title);
            $hashFull = '#'.$hashCat.'_'.$hashPost;

            wp_redirect(site_url('/discounts/'.$hashFull));
            exit();
        }

    }

    // task categories
    else if( $postType == 'tasks_categories' ){
        wp_redirect(site_url());
        exit();
    }

    // newsevents-items 
    else if( $postType == 'newsevents-items' ){
        wp_redirect(site_url('/news-events/'.$postSlug));
        exit();
    }
    
    


    get_header(); 



?>

	<main role="main" aria-label="Content">
	<!-- section -->
	<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
				</a>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<!-- post title -->
			<h1>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h1>
			<!-- /post title -->

			<!-- post details -->
			<span class="date">
				<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
					<?php the_date(); ?> <?php the_time(); ?>
				</time>
			</span>
			<span class="author"><?php _e( 'Published by', 'nudev' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'nudev' ), __( '1 Comment', 'nudev' ), __( '% Comments', 'nudev' )); ?></span>
			<!-- /post details -->

			<?php the_content(); // Dynamic Content ?>

			<?php the_tags( __( 'Tags: ', 'nudev' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

			<p><?php _e( 'Categorised in: ', 'nudev' ); the_category(', '); // Separated by commas ?></p>

			<p><?php _e( 'This post was written by ', 'nudev' ); the_author(); ?></p>

			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

			<?php comments_template(); ?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'nudev' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
