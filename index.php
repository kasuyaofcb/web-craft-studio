<?php
/**
 * メインテンプレート
 * 他のテンプレートが見つからない場合のフォールバック
 *
 * @package Web_Craft_Studio
 */

get_header();
?>

	<section class="indexContent">
		<div class="u-container">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article>
					<?php
				endwhile;
			else :
				?>
				<p>投稿が見つかりませんでした。</p>
				<?php
			endif;
			?>
		</div>
	</section>

<?php
get_footer();
