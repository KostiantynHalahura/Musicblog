<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo wp_get_document_title(); ?></title>
	<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" />
	<?php wp_head(); ?>
</head>
<body>
	<header id="header" class="header">
		<?php wp_nav_menu(array( 'theme_location' => 'header-menu', 'menu_class' => 'link-list last-child' )) ?>
	</header>
<div id="content" class="site-content">