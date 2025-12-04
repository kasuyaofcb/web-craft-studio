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
 * スタイルシートとスクリプトの読み込み
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

	// TOPページ用セクションCSS（TOPページのみ読み込む）
	if ( is_page_template( 'page-templates/page-top.php' ) || is_front_page() ) {
		wp_enqueue_style( 'web-craft-studio-section-fv', get_template_directory_uri() . '/assets/css/section-fv.css', array( 'web-craft-studio-common' ), $theme_version );
		// その他のセクション用CSSは各担当者が追加
		// wp_enqueue_style( 'web-craft-studio-section-services', get_template_directory_uri() . '/assets/css/section-services.css', array( 'web-craft-studio-common' ), $theme_version );
		// wp_enqueue_style( 'web-craft-studio-section-works', get_template_directory_uri() . '/assets/css/section-works.css', array( 'web-craft-studio-common' ), $theme_version );
	}

	// 共通JavaScript
	wp_enqueue_script( 'web-craft-studio-common', get_template_directory_uri() . '/assets/js/common.js', array(), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'web_craft_studio_scripts' );
