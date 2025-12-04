<?php
/**
 * ヘッダーコンポーネント
 *
 * @package Web_Craft_Studio
 */
?>

<div class="header__inner">
	<div class="u-container">
		<h1 class="header__logo">
			<a href="<?php echo esc_url(home_url('/')); ?>" class="header__logoLink">
				<?php bloginfo('name'); ?>
			</a>
		</h1>
		<nav class="header__nav" aria-label="メインナビゲーション">
			<?php
			// メニューの呼び出し
			// 詳細は docs/05-wordpress.md の「メニューの呼び出し方のサンプル」を参照
			wp_nav_menu(array(
				'theme_location' => 'header-menu',
				'container' => false,
				'menu_class' => 'header__navList',
				'fallback_cb' => false,
			));
			?>
		</nav>
	</div>
</div>
