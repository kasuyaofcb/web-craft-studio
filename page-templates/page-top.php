<?php
/**
 * Template Name: TOPページ
 * TOPページ専用テンプレート
 *
 * @package Web_Craft_Studio
 */

get_header();
?>

	<!-- ファーストビュー -->
	<?php get_template_part( 'template-parts/top/section-fv' ); ?>

	<!-- サービス紹介 -->
	<?php get_template_part( 'template-parts/top/section-services' ); ?>

	<!-- 制作実績 -->
	<?php get_template_part( 'template-parts/top/section-works' ); ?>

	<!-- スタッフ紹介 -->
	<?php get_template_part( 'template-parts/top/section-staff' ); ?>

	<!-- お客様の声 -->
	<?php get_template_part( 'template-parts/top/section-testimonials' ); ?>

	<!-- 最新のお知らせ -->
	<?php get_template_part( 'template-parts/top/section-news' ); ?>

	<!-- CTA -->
	<?php get_template_part( 'template-parts/top/section-cta' ); ?>

<?php
get_footer();
