<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pumpkin_cafe
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'pumpkin_cafe'); ?></a>

		<header id="masthead" class="site-header header-container">
			<div class="header-container__wrapper">
				<div class="site-branding">
					<?php
					the_custom_logo();
					if (is_front_page() && is_home()) :
					?>
						<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php
					else :
					?>
						<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php
					endif;
					$pumpkin_cafe_description = get_bloginfo('description', 'display');
					if ($pumpkin_cafe_description || is_customize_preview()) :
					?>
						<p class="site-description"><?php echo $pumpkin_cafe_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																				?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<!-- ハンバーガーメニュー -->
				<div class="nav_toggle">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>

			<nav id="site-navigation" class="main-navigation nav">
				<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'pumpkin_cafe'); ?></button> -->
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'menu-1',
						'container'       => 'nav',
						'container_class' => 'main-navigation nav',
						'menu_class'      => 'menu',
						'menu_id'         => 'primary-menu',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">
																		%3$s
																		<li>
																			<a href="' . esc_url(home_url('/news/')) . '">新着情報一覧</a>
																		</li>
																		<li>
																			<a href="' . esc_url(home_url('/product/')) . '">商品一覧</a>
																		</li>
																		<li>
																			<a href="' . esc_url(home_url('/blog/')) . '">ブログ一覧</a>
																		</li>
																	</ul>',
						'fallback_cb'     => 'wp_page_menu',
						'depth'           => 1,
					)
				);
				?>
			</nav><!-- #site-navigation -->
			<div class="mask"></div>
		</header><!-- #masthead -->
