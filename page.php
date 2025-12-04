<?php
/**
 * 固定ページテンプレート
 *
 * @package Web_Craft_Studio
 */

get_header();
?>

	<section class="pageContent">
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
			endif;
			?>
		</div>
	</section>

<?php
get_footer();
