<!DOCTYPE HTML>
<html class="no-js" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<?php $detect = new Mobile_Detect(); /* Mobiel Detect */ ?>	
	<?php $options = get_option('scapegoat_theme_options'); /* load the Theme Options */ ?>
	<?php $template_url = get_bloginfo('template_url'); /* Template Path */ ?>
	<head profile="http://gmpg.org/xfn/11">
	
		<!--
                                                                                
                                 :MMMMMMMMMMO=                                  
                             .MMDIIIIIIIIIII?I?$MMMZ                            
                           8M8IIIIIIIIIIIIIIIIIIIIIIIMM~                        
                         MMIIIIIIIIIIIIIIIIIIIIIIIIIIIIIM,                      
                       MMNIIIIIIIIIIIIIIIIIIMMMMM7IIIIII?N8                     
                    .OM   MIIIIIIIIIIIIIIOM~.    .MDIIIIIIDM                    
                    M~.    MIIIIIIIIIIIIMI.         M?IIIII8M                   
                  ,M.      .MIIIIIIIIIIM=           .DDIIIIIMZ                  
                 :M.        IMIIIIIII$M.              ,NIIIIIM+                 
                .M.   8MD   .MDIIIII$M.      ,M7.       NIIIIIM                 
                M~   ?MMM,    MII7IIM:      MMMMMZ.     ,NIIIIIM                
                M   .MMMM.  +MMMMMMMM.     MMMMMMM.      ODIIIIM7               
               IO    .MM,  $MMMMMMMMMM.    MMMMMMM.      .MIIIIIM               
               OO           MMMMMMMMMM.     7MMMM.        MIIIIIZN.             
               M$=           IMMMMMMM.                   .MIIIII?M.             
              .MII~              .                       ?MIIIIII7M.            
              M,,,,,:                                    MIIIIIIIIM~            
             $M,,,,,,,,,. .                            .MMIIIIIIIIIM            
             M,,,,,,,,,,,,,,,,,,.......              .7MM8+===~~::,M,           
             M,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,8MM,,,,,,,,,,:M           
            =M,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,MM?,,,,,,,,,,,M           
            NZ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,OMM~,,,,,,,,,,,,+M          
            M:,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,OMM+,,,,,,,,,,,,,,,M.         
            M,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,7MM=,,,,,,,,,,,,,,,,,M$         
            M,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,+MM+:,,,,,,,,,,,,,,,,,,,M         
            M,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,+MM+,,,,,,,,,,,,,,,,,,,,,,M         
           =M,,,,,,,,,,,,,,,,,,,,,,,,,,,,,:MMZ,,,,,,,,,,,,,,,,,,,,,,,,M+        
           88,,,,,,,,,,,,,,,,,,,,,,,,,,,,8MM,,,,,,,,,,,,,,,,,,,,,,,,,,IM        
           M+,,,,,,,,,,,,,,,,,,,,,,,,,,,~MMD,,,,,,,,,,,,,,,,,,,,,,,,,,,M        
           M,,,,,,,,,,,,,,,,,,,,,,,,,,,,,~MMM=,,,,,,,,,,,,,,,,,,,,,,,,,M        
           M,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,IMMM?,,,,,,,,,,,,,,,,,,,,,,,M        
           M,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,~MMM$,,,,,,,,,,,,,,,,,,,,,M        
       .MMMM,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,MMMM=,,,,,,,,,,,,,,,,,,M        
       MMMMM,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,7MMMMMMMMMM,,,,,,,,,,M        
      MMMMMMMM,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,.~,,,,,,,,,,,,,,,~M        
      ~MMMMMMMMM,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,MMD       
       MMMMMMMMMM,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,MMM,      
        DMMMMMMMMM:,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,$MMM,      
         7MMMMMMMMM,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,MMMM       
          .MMMMMMMMI,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,MMMMD       
            .MMMMMMO,,,,,,,,,,,,,,:8MMMMMMM=:,,,,,,,,,,,,,,,,,,,,,?MMMMM~       
                    =MMMMMMMMMMMM~          .OMMM$,,,,,,,,,,,,~MMMMMMMMM        
                                                   IMMMMMMMMD:  =MMMMMM,        
                                                                 MMMMMD         
                                                                 ~MMM:           
                                                                         
			
		-->

		<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>

		<!-- ♥ ♥ ♥ Oh nice, you take a look at the sourcecode. I'm flattered. ♥ ♥ ♥ -->
		<meta name="author" content="Peter Amende" />
		<meta name="description" content="<?php bloginfo('description'); ?>" />

		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

		<link type="text/css" rel="stylesheet" href="<?php echo $template_url; ?>/style.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="<?php echo $template_url; ?>/css/font-awesome.min.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="<?php echo $template_url; ?>/css/plugins.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="<?php echo $template_url; ?>/css/print.css" media="print" />
		<!--[if IE]>
		<link type="text/css" rel="stylesheet" href="<?php echo $template_url; ?>/css/ie.css" media="screen" />
		<![endif]-->
		<!--[if IE 7]>
		<link type="text/css" rel="stylesheet" href="<?php echo $template_url; ?>/css/font-awesome-ie7.min.css" media="screen" />
		<![endif]-->

		<link rel="Shortcut Icon" type="image/x-icon" href="<?php echo $template_url; ?>/favicon.ico" />
		<?php if($options['icon']) : ?>
		<link rel="apple-touch-icon-precomposed" href="<?php echo $options['icon']; ?>"/>
		<?php else : ?>
		<link rel="apple-touch-icon-precomposed" href="<?php echo $template_url; ?>/images/touch-icon.png"/>
		<?php endif; ?>

		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss2_url'); ?>">
		<link rel="canonical" href="<?php bloginfo('url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link rel="index" title="<?php bloginfo('description'); ?>" href="<?php bloginfo('url'); ?>" />

		<?php if(is_single()) : ?>
			<?php
				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src($image_id,'thumbnail', true);
			?>
			<meta property="og:title" content="<?php the_title(); ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:url" content="<?php the_permalink(); ?>" />
			<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
			<meta property="og:description" content="" />
			<?php if($image_url) : ?>
			<meta property="og:image" content="<?php echo $image_url[0]; ?>" />
			<meta property="og:image:width" content="150" />
			<meta property="og:image:height" content="150" />
			<?php endif; ?>
			<meta property="twitter:card" content="summary" />
			<meta property="twitter:title" content="<?php the_title(); ?>" />
			<meta property="twitter:description" content="" />
			<?php if($image_url) : ?>
			<meta property="twitter:image" content="<?php echo $image_url[0]; ?>" />
			<?php endif; ?>
		<?php else : ?>
			<meta property="og:title" content="<?php bloginfo('name'); ?>" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="<?php bloginfo('url'); ?>" />
			<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
			<meta property="og:description" content="<?php bloginfo('description'); ?>" />
			<meta property="twitter:card" content="summary" />
			<meta property="twitter:title" content="<?php the_title(); ?>" />
			<meta property="twitter:description" content="<?php bloginfo('description'); ?>" />
		<?php endif; ?>

		<?php if($options['alignment-option'] == 'sidebar-left') : ?>
			<style>
				.sidebar {float: left;}
				.content {float: right;}
			</style>
		<?php endif; ?>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
<div id="main-outside">
	<div id="main-inside">
		<div id="header-outside" role="banner">
			<header id="header-inside" class="inside">
				<div id="header-mobile">
					<h1 id ="logo-mobile">
						<a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
					</h1>
					<a href="#main-nav-inside" id="menu-open"><?php _e('Navigation','scapegoat'); ?></a>
				</div>
				<figure id="logo">
					<?php if($options['logo']) : ?>
						<a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>">
							<img src="<?php echo $options['logo']; ?>" alt="<?php bloginfo('name'); ?>" />
						</a>
					<?php else : ?>
						<span id="logo-text">
							<a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
						</span>
					<?php endif; ?>
				</figure><!-- logo -->
				<?php if(!$detect->isMobile() || $detect->isTablet()) : ?>
				<span id="search">
					<h2 id="search-title-header" class="visuallyhidden"><?php _e('Search','scapegoat'); ?></h2>
					<?php get_search_form(); ?>
				</span>
				<?php endif; ?>
				<div class="clear"></div>
			</header><!-- header-inside -->
		</div><!-- header-outside -->

		<div id="main-nav-outside">
			<div id="main-nav-inside" class="inside">
				<nav id="main-nav" role="navigation">
					<div id ="nav-search">
						<?php get_search_form(); ?>
					</div>
					<h2 id="nav-title" class="visuallyhidden"><?php _e('Navigation','scapegoat'); ?></h2>
					<a href="#header-inside" id="menu-close"><?php _e('Navigation','scapegoat'); ?></a>
					<?php wp_nav_menu(array('theme_location' => 'header', 'fallback_cb' => fallback_menu, 'walker' => new My_Walker_Nav_Menu())); ?>
					<div class="clear"></div>
				</nav><!-- main-nav -->
			</div><!-- main-nav-inside -->
		</div><!-- main-nav-outside -->

		
		<?php if(!$detect->isMobile() || $detect->isTablet()) : ?>
			<?php if (!is_paged() && is_home()) : ?>
				<?php include('slider.php'); ?>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if(is_paged()) : ?>
			<div id="title-outside">
				<div id="title-inside" class="inside">
					<div class="content<?php if (!is_active_sidebar('Main-Sidebar')) : ?> nosidebar<?php endif; ?>">
						<header class="title-header">
							<h2 class="post-title"><?php current_paged(); ?></h2>
						</header>
					</div>
					<div class="clear"></div>
				</div>			
			</div>
		<?php elseif((!($options['header-option'] == 'show-slider') && !($options['header-option'] == 'show-header')) && is_home()) : ?>
			<div id="title-outside">
				<div id="title-inside" class="inside">
					<div class="content<?php if (!is_active_sidebar('Main-Sidebar')) : ?> nosidebar<?php endif; ?>">
						<header class="title-header">
							<h2 class="post-title"><?php _e('Blog','scapegoat'); ?></h2>
						</header>
					</div>
					<div class="clear"></div>
				</div>			
			</div>
		<?php endif; ?>
		