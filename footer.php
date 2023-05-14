<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pumpkin_cafe
 */

?>

	<footer id="colophon" class="site-footer footer-container">
		<div class="site-info">
			<div class="footer-company">
				<h3><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">PumpkinCafe</a></h3>
				<h4><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">パンプキンカフェ株式会社</a></h4>
			</div>
			<p>
				〒123-4567　東京都千代田区丸の内1-1-1<br>
				TEL:03-1234-5678 FAX:03-9876-5432<br>
				10:00~20:00(定休日：水曜日)
			</p>
			<p class="footer-contact"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" rel="home">お問い合わせはこちら</a></p>
			<div class="footer-sns">
				<a class="footer-sns__a" href="https://twitter.com/home" rel="sns"><i class="fa-brands fa-twitter"></i></a>
				<a class="footer-sns__a" href="https://www.facebook.com/" rel="sns"><i class="fa-brands fa-facebook"></i></a>
				<a class="footer-sns__a" href="https://www.instagram.com/" rel="sns"><i class="fa-brands fa-square-instagram"></i></a>
				<a class="footer-sns__a" href="https://www.youtube.com/" rel="sns"><i class="fa-brands fa-youtube"></i></a>
			</div>
			<p class="copyright">Copyright ©PumpkinCafe</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
