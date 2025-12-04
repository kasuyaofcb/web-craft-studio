<?php
/**
 * アーカイブテンプレート
 *
 * @package Web_Craft_Studio
 */

get_header();
?>

	<section class="archiveContent">
		<div class="u-container">
			<header class="pageHeader">
				<h1 class="pageTitle">
					<?php
					if ( is_category() ) {
						echo esc_html( single_cat_title( '', false ) );
					} elseif ( is_tag() ) {
						echo esc_html( single_tag_title( '', false ) );
					} elseif ( is_post_type_archive() ) {
						echo esc_html( post_type_archive_title( '', false ) );
					} else {
						the_archive_title();
					}
					?>
				</h1>
			</header>

			<?php
			if ( have_posts() ) :
				?>
				<div class="posts-list">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<h2 class="entry-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="entry-excerpt">
								<?php the_excerpt(); ?>
							</div>
						</article>
						<?php
					endwhile;
					?>
				</div>
				<?php
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
