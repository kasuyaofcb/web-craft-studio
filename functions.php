<?php
/**
 * Web Craft Studio テーマの関数定義
 *
 * @package Web_Craft_Studio
 */

/**
 * テーマのセットアップ
 */
function web_craft_studio_setup() {
	// タイトルタグのサポート
	add_theme_support( 'title-tag' );

	// アイキャッチ画像のサポート
	add_theme_support( 'post-thumbnails' );

	// HTML5マークアップのサポート
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
add_action( 'after_setup_theme', 'web_craft_studio_setup' );

/**
 * メニューの位置を登録
 */
function register_theme_menus() {
	register_nav_menus(array(
		'header-menu' => 'ヘッダーメニュー',
		'footer-menu' => 'フッターメニュー',
	));
}
add_action('init', 'register_theme_menus');

/**
 * メニューを作成
 *
 * メニュー項目を追加・削除する場合は、$header_menu_items配列を編集してください。
 * 例: array('title' => '新しいページ', 'url' => home_url('/new-page/')),
 */
function create_theme_menus() {
	// ヘッダーメニューの項目を定義（配列で管理）
	$header_menu_items = array(
		array('title' => 'ホーム', 'url' => home_url('/')),
		array('title' => 'About', 'url' => home_url('/about/')),
		array('title' => 'Works', 'url' => home_url('/works/')),
		array('title' => 'Blog', 'url' => home_url('/blog/')),
		array('title' => 'Contact', 'url' => home_url('/contact/')),
	);

	// ヘッダーメニューを作成
	$header_menu = wp_get_nav_menu_object('header-menu');
	if (!$header_menu) {
		$header_menu_id = wp_create_nav_menu('header-menu');
		if (!is_wp_error($header_menu_id)) {
			// メニュー項目を追加
			foreach ($header_menu_items as $item) {
				wp_update_nav_menu_item($header_menu_id, 0, array(
					'menu-item-title' => $item['title'],
					'menu-item-url' => $item['url'],
					'menu-item-status' => 'publish',
				));
			}
			// メニューの位置を設定
			set_theme_mod('nav_menu_locations', array('header-menu' => $header_menu_id));
		}
	}
}
add_action('after_setup_theme', 'create_theme_menus');

/**
 * スタイルシートとスクリプトの読み込み
 *
 * シンプルな方法: すべてのCSS/JavaScriptをすべてのページで読み込みます
 * 新しいセクション用CSSを追加する場合は、コメントアウトを解除して追加してください
 */
function web_craft_studio_scripts() {
	// テーマのバージョン（キャッシュ対策）
	$theme_version = wp_get_theme()->get( 'Version' );

	// 共通CSS（すべてのページで読み込む）
	wp_enqueue_style( 'web-craft-studio-common', get_template_directory_uri() . '/assets/css/common.css', array(), $theme_version );

	// ヘッダーCSS（すべてのページで読み込む）
	wp_enqueue_style( 'web-craft-studio-header', get_template_directory_uri() . '/assets/css/header.css', array( 'web-craft-studio-common' ), $theme_version );

	// フッターCSS（すべてのページで読み込む）
	wp_enqueue_style( 'web-craft-studio-footer', get_template_directory_uri() . '/assets/css/footer.css', array( 'web-craft-studio-common' ), $theme_version );

	// セクション用CSS（すべてのページで読み込む）
	// 新しいセクション用CSSを追加する場合は、コメントアウトを解除して追加してください
	wp_enqueue_style( 'web-craft-studio-section-fv', get_template_directory_uri() . '/assets/css/top/section-fv.css', array( 'web-craft-studio-common' ), $theme_version );
	// wp_enqueue_style( 'web-craft-studio-section-services', get_template_directory_uri() . '/assets/css/top/section-services.css', array( 'web-craft-studio-common' ), $theme_version );
	// wp_enqueue_style( 'web-craft-studio-section-works', get_template_directory_uri() . '/assets/css/top/section-works.css', array( 'web-craft-studio-common' ), $theme_version );

	// 共通JavaScript（すべてのページで読み込む）
	wp_enqueue_script( 'web-craft-studio-common', get_template_directory_uri() . '/assets/js/common.js', array(), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'web_craft_studio_scripts' );
