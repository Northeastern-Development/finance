<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>
		<meta name="title" content="<?php wp_title(''); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta name="author" content="Northeastern University, http://www.northeastern.edu" />
		<meta name="copyright" content="<?=date("Y")?>" />
		<meta name="language" content="english" />
		<meta name="zipcode" content="02115" />
		<meta name="city" content="Boston" />
		<meta name="state" content="MA" />

		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="revisit" content="15 days" />
		<!-- <meta http-equiv="robots" content="all" /> -->

        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />



        <link rel="apple-touch-icon" sizes="57x57"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-57x57.png?v=2" />
        <link rel="apple-touch-icon" sizes="60x60"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-60x60.png?v=2" />
        <link rel="apple-touch-icon" sizes="72x72"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-72x72.png?v=2" />
        <link rel="apple-touch-icon" sizes="76x76"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-76x76.png?v=2" />
        <link rel="apple-touch-icon" sizes="114x114"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-114x114.png?v=2" />
        <link rel="apple-touch-icon" sizes="120x120"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-120x120.png?v=2" />
        <link rel="apple-touch-icon" sizes="144x144"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-144x144.png?v=2" />
        <link rel="apple-touch-icon" sizes="152x152"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-152x152.png?v=2" />
        <link rel="icon" sizes="144x144" type="image/png" href="https://brand.northeastern.edu/global/assets/favicon/android-chrome-144x144.png?v=2" />
        <link rel="icon" sizes="32x32" type="image/png" href="https://brand.northeastern.edu/global/assets/favicon/favicon-32x32.png?v=2" />
        <link rel="icon" sizes="16x16" type="image/png" href="https://brand.northeastern.edu/global/assets/favicon/favicon-16x16.png?v=2" />
        <link rel="manifest" href="https://brand.northeastern.edu/global/assets/favicon/manifest.json" />
        <meta name="msapplication-TileColor" content="#ffffff" />
        <meta name="msapplication-TileImage" content="https://brand.northeastern.edu/global/assets/favicon/mstile-144x144.png?v=2" />
        <meta name="theme-color" content="#ffffff" />
        

        
        


        
        <link href="//www.google-analytics.com" rel="dns-prefetch">
        
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Google Tag Manager - uncomment when going to production -->
		<!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-WGQLLJ');</script> -->
		<!-- End Google Tag Manager -->

		<?php wp_head(); ?>
    </head>    
    <body <?php body_class(); ?>>
        <!-- Google Tag Manager (noscript) - uncomment when going to production -->
		<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WGQLLJ"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
		<!-- End Google Tag Manager (noscript) -->
        <a href="#maincontent" class="skiptomaincontent" title="Click here to skip to main content" aria-label="Click here to skip to main content">Skip to main content</a>
        <?php 
            // header/footer disabled on staff-bio template
            if( !is_page_template('templates/template-staff-bio.php') ) :
                // if enabled, include the globalheader
                // if(function_exists("NUML_globalheader")){ NUML_globalheader(); }
                // then the siteheader
         ?>
        <?php if(function_exists("NUML_globalheader")){NUML_globalheader();} ?><header class="header clear" role="banner">
            <div id="header">
                <?php require_once(dirname(__FILE__)."/includes/navigation.php"); ?>
            </div>
        </header>
    <?php 
        endif;
     ?>
    <div class="wrapper">
    <a name="maincontent" id="maincontent"></a>