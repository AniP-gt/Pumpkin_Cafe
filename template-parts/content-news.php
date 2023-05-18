<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pumpkin_cafe
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-news">
		<div class="content-news__thumb"><?php pumpkin_cafe_post_thumbnail(); ?></div>
		<div class="content-news__article">
			<header class="entry-header">
				<?php
				if (is_singular()) :
					the_title('<h1 class="entry-title">', '</h1>');
				else :
					the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
				endif;

				if ('post' === get_post_type()) :
				?>
					<div class="entry-meta">
						<?php
						pumpkin_cafe_posted_on();
						pumpkin_cafe_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php echo get_the_date(); ?>
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'pumpkin_cafe'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post(get_the_title())
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__('Pages:', 'pumpkin_cafe'),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
