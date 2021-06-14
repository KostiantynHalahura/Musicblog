<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo wp_get_document_title(); ?></title>
	<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" />
	<?php wp_head(); ?>
</head>
<body>
	<header class="main-nav">
		<div>
			<ul>
				<li><a href="#">Главная</a></li>
				<li><a href="#">О нас</a></li>
				<li><a href="#">Статьи</a></li>
				<li><a href="#">Обратная связь</a></li>
			</ul>
		</div>
	</header>

<div id="content" class="site-content">