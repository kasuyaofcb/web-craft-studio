<?php
/**
 * 404エラーページテンプレート
 *
 * @package Web_Craft_Studio
 */

get_header();
?>

	<section class="error404">
		<div class="u-container">
			<header class="pageHeader">
				<h1 class="pageTitle">404 - ページが見つかりません</h1>
			</header>
			<div class="pageContent">
				<p>お探しのページは見つかりませんでした。</p>
				<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップページに戻る</a></p>
			</div>
		</div>
	</section>

<?php
get_footer();
