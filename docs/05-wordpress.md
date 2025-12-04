# 5. WordPress化

> **このフェーズで**: HTML/CSS/JavaScriptで実装したサイトをWordPressテーマとして実装します。

## 📌 このフェーズで必要なルール

### PHPの基本

- エラーハンドリングを必ず書く
- WordPress関数の戻り値をチェック

```php
$result = wp_insert_post($post_data);
if (is_wp_error($result)) {
  error_log('エラー: ' . $result->get_error_message());
}
```

### WordPressの基本

**初学者向けの用語説明**:

- **テンプレート階層**: WordPressがどのテンプレートファイルを使用するかを決定する仕組み
  - 例: 固定ページ「About」は `page-about.php` または `page.php` を使用
  - 詳細は [WordPress公式ドキュメント](https://wpdocs.osdn.jp/%E3%83%86%E3%83%B3%E3%83%97%E3%83%AC%E3%83%BC%E3%83%88%E9%9A%8E%E5%B1%A4) を参照

- **ループ**: WordPressの投稿や固定ページを表示するための仕組み
  - 例: `while (have_posts()) { the_post(); ... }` で投稿を1件ずつ表示

- **関数の使い方**: WordPressが提供する便利な関数
  - `get_header()`: ヘッダーテンプレートを読み込む
  - `the_content()`: 投稿の本文を表示
  - `bloginfo('name')`: サイト名を表示
  - 詳細は [WordPress公式ドキュメント](https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9) を参照

### BEM命名規則

- **すでに実装したHTML/CSSの命名規則を維持**（ブロック名は変更不要）
- 静的サイトフェーズで使用したクラス名（`sectionFv`など）をそのまま使用できます

### WordPressプラグインのルール

**原則: 必要最小限のプラグインのみ使用**

このプロジェクトでは、以下のプラグインのみ使用可能です：

#### 必須プラグイン

- **Advanced Custom Fields (ACF)** - カスタムフィールドの管理（必須）
  - よくある質問、制作実績の追加情報などで使用
  - チーム全体で統一して使用します

#### 推奨プラグイン（必要に応じて）

- **Contact Form 7** - お問い合わせフォーム（必要に応じて）

#### 禁止プラグイン

- ページビルダー系プラグイン（Elementor、Visual Composerなど）
- テーマカスタマイザー系プラグイン
- その他、テーマの構造を変更する可能性があるプラグイン

> **💡 理由**: チーム開発では、プラグインの有無による環境差を避けるため、必要最小限のプラグインのみ使用します。ACFは必須プラグインとして固定し、カスタムフィールドの実装を統一します。

## 🔧 作業の流れ

1. **作業開始前の確認**
   - [ ] WordPressの基本設定（設定 > 一般）が完了しているか
   - [ ] ブランチが作成されているか確認（`git branch` で現在のブランチを確認）
   - [ ] 最新のmainブランチを取得（`git pull origin main`）
   - [ ] Live Sass Compilerが起動しているか確認（VS Codeのステータスバーに「Watching...」と表示されているか）
   - [ ] 静的サイトフェーズで実装したHTML/CSSが確認できているか

2. **WordPressの基本設定（必須）**
   - 管理画面 > **設定 > 一般** でサイトのタイトルとキャッチフレーズを設定

3. **静的サイトからWordPressへの移行**
   - HTMLファイルをPHPテンプレートに変換
   - SCSSファイルをページごとのフォルダーに移動
   - クラス名は変更不要（統一ルールに従っているため）

4. **テーマの基本構造を作成**
   - `style.css` の確認
   - `functions.php` の確認

5. **固定ページの実装**
   - 固定ページテンプレートの作成（`page-templates/`）
   - テンプレートパーツの分割（`template-parts/`）

6. **カスタム投稿タイプの実装**
   - `functions.php` でカスタム投稿タイプを登録
   - アーカイブページと詳細ページのテンプレートを作成

7. **テンプレートパーツの分割**
   - セクションごとにファイルを分割
   - ページごとにフォルダーを分ける

8. **動的コンテンツの実装**
   - WordPress関数を使用してコンテンツを表示
   - ACFを使用してカスタムフィールドを実装

9. **動作確認**
   - Local by FlywheelのサイトURLで確認（例: `http://web-craft-studio.local`）
   - 複数のページで確認
   - 管理画面での動作確認

10. **コミット・PR作成**
    - 詳細は [Gitのルール](git-workflow.md) を参照

## ⚙️ WordPressの基本設定（必須）

WordPress化を始める前に、管理画面で最低限の設定を行います。

### 設定 > 一般

1. **管理画面にログイン**
2. **設定 > 一般** を開く
3. **以下の項目を設定**：

   - **サイトのタイトル**: サイト名を入力（例：「Web Craft Studio」）
     - この値は `<?php bloginfo('name'); ?>` で表示されます
     - ヘッダーのロゴ部分などで使用します

   - **キャッチフレーズ**: サイトの説明文を入力（例：「チーム開発で学ぶWeb制作」）
     - この値は `<?php bloginfo('description'); ?>` で表示されます
     - メタディスクリプションなどで使用します

4. **変更を保存** をクリック

> **💡 重要**: これらの設定はデータベースに保存されるため、**データベースの共有ルール**に従って共有してください。詳細は [データベースの共有](#💾-データベースの共有) セクションを参照してください。

## 📝 テーマの基本構造

### style.cssの作成

テーマの基本情報を記述します。

```css
/*
Theme Name: Web Craft Studio
Description: チーム開発用WordPressテーマ
Version: 1.0.0
Author: Web Craft Studio Team
*/
```

### functions.phpの作成

テーマの基本機能を実装します。

```php
<?php
/**
 * テーマの基本設定
 */

// テーマのバージョン
define('THEME_VERSION', '1.0.0');

// テーマのパス
define('THEME_PATH', get_template_directory());
define('THEME_URI', get_template_directory_uri());

/**
 * テーマのセットアップ
 */
function theme_setup() {
  // タイトルタグのサポート
  add_theme_support('title-tag');

  // アイキャッチ画像のサポート
  add_theme_support('post-thumbnails');

  // HTML5マークアップのサポート
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));
}
add_action('after_setup_theme', 'theme_setup');
```

#### メニューの作成（コードで実装）

メニューはコードで作成します。これにより、Gitで管理でき、チーム間で統一できます。

##### 1. メニューの位置を登録

`functions.php`に以下を追加します。

```php
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
```

##### 2. メニューを作成

`functions.php`に以下を追加します。

```php
/**
 * メニューを作成
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
```

**ポイント**:
- メニュー項目は配列で定義（追加・削除が簡単）
- エラーハンドリングは`is_wp_error()`で確認
- メニュー項目を追加する場合は、`$header_menu_items`配列に追加するだけ

##### 3. テンプレートでメニューを表示

`template-parts/common/header.php`に以下を追加します。

```php
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
```

##### 4. メニューの呼び出し方のサンプル

**基本的な呼び出し方**:

```php
<?php
wp_nav_menu(array(
	'theme_location' => 'header-menu',  // メニューの位置（functions.phpで登録した名前）
	'container' => false,                // コンテナ（div）を出力しない
	'menu_class' => 'header__navList',   // ulタグに付けるクラス名
	'fallback_cb' => false,              // メニューがない場合のフォールバック（なし）
));
?>
```

**よく使うオプション**:

```php
<?php
wp_nav_menu(array(
	'theme_location' => 'header-menu',
	'container' => false,                // false: コンテナを出力しない
	'menu_class' => 'header__navList',   // ulタグのクラス名
	'menu_id' => 'header-nav',           // ulタグのID（オプション）
	'fallback_cb' => false,              // メニューがない場合の処理（false: 何も出力しない）
	'depth' => 1,                        // メニューの階層（1: 1階層のみ）
	'items_wrap' => '<ul class="%2$s">%3$s</ul>',  // カスタムHTML（%2$s: menu_class, %3$s: メニュー項目）
));
?>
```

**フッターメニューの例**:

```php
<?php
// template-parts/common/footer.php
wp_nav_menu(array(
	'theme_location' => 'footer-menu',
	'container' => false,
	'menu_class' => 'footer__navList',
	'fallback_cb' => false,
));
?>
```

**メニューが存在するかチェックしてから表示**:

```php
<?php
if (has_nav_menu('header-menu')) {
	wp_nav_menu(array(
		'theme_location' => 'header-menu',
		'container' => false,
		'menu_class' => 'header__navList',
		'fallback_cb' => false,
	));
}
?>
```

> **💡 ポイント**:
> - メニュー項目を追加・削除する場合は、`functions.php`の`$header_menu_items`配列を編集するだけです
> - コードで管理するため、データベースの共有は不要です
> - `wp_nav_menu()`のオプションは、必要に応じて調整してください

#### CSS/JavaScriptの読み込み

##### 方法1: シンプルな方法（推奨）

すべてのCSS/JavaScriptをすべてのページで読み込みます。**初心者には理解しやすく、実装も簡単**です。

`functions.php`に直接記述します。

```php
<?php
/**
 * スタイルシートとスクリプトの読み込み
 *
 * シンプルな方法: すべてのCSS/JavaScriptをすべてのページで読み込みます
 * 新しいセクション用CSSを追加する場合は、コメントアウトを解除して追加してください
 */
function web_craft_studio_scripts() {
  // テーマのバージョン（キャッシュ対策）
  $theme_version = wp_get_theme()->get('Version');

  // 共通CSS（すべてのページで読み込む）
  wp_enqueue_style('web-craft-studio-common', get_template_directory_uri() . '/assets/css/common.css', array(), $theme_version);

  // ヘッダーCSS（すべてのページで読み込む）
  wp_enqueue_style('web-craft-studio-header', get_template_directory_uri() . '/assets/css/header.css', array('web-craft-studio-common'), $theme_version);

  // フッターCSS（すべてのページで読み込む）
  wp_enqueue_style('web-craft-studio-footer', get_template_directory_uri() . '/assets/css/footer.css', array('web-craft-studio-common'), $theme_version);

  // セクション用CSS（すべてのページで読み込む）
  // 新しいセクション用CSSを追加する場合は、コメントアウトを解除して追加してください
  wp_enqueue_style('web-craft-studio-section-fv', get_template_directory_uri() . '/assets/css/top/section-fv.css', array('web-craft-studio-common'), $theme_version);
  // wp_enqueue_style('web-craft-studio-section-services', get_template_directory_uri() . '/assets/css/top/section-services.css', array('web-craft-studio-common'), $theme_version);
  // wp_enqueue_style('web-craft-studio-section-works', get_template_directory_uri() . '/assets/css/top/section-works.css', array('web-craft-studio-common'), $theme_version);

  // 共通JavaScript（すべてのページで読み込む）
  wp_enqueue_script('web-craft-studio-common', get_template_directory_uri() . '/assets/js/common.js', array(), $theme_version, true);
}
add_action('wp_enqueue_scripts', 'web_craft_studio_scripts');
```

##### 方法2: ページごとに条件分岐する方法（オプション）

パフォーマンスを最適化したい場合は、ページごとに条件分岐して読み込む方法も使用できます。

```php
<?php
/**
 * スタイルシートとスクリプトの読み込み
 *
 * ページごとに条件分岐して読み込む方法
 */
function web_craft_studio_scripts() {
  // テーマのバージョン（キャッシュ対策）
  $theme_version = wp_get_theme()->get('Version');

  // 共通CSS（すべてのページで読み込む）
  wp_enqueue_style('web-craft-studio-common', get_template_directory_uri() . '/assets/css/common.css', array(), $theme_version);

  // ヘッダーCSS（すべてのページで読み込む）
  wp_enqueue_style('web-craft-studio-header', get_template_directory_uri() . '/assets/css/header.css', array('web-craft-studio-common'), $theme_version);

  // フッターCSS（すべてのページで読み込む）
  wp_enqueue_style('web-craft-studio-footer', get_template_directory_uri() . '/assets/css/footer.css', array('web-craft-studio-common'), $theme_version);

  // TOPページ用セクションCSS（TOPページのみ読み込む）
  if (is_page_template('page-templates/page-top.php') || is_front_page()) {
    wp_enqueue_style('web-craft-studio-section-fv', get_template_directory_uri() . '/assets/css/top/section-fv.css', array('web-craft-studio-common'), $theme_version);
    wp_enqueue_style('web-craft-studio-section-services', get_template_directory_uri() . '/assets/css/top/section-services.css', array('web-craft-studio-common'), $theme_version);
    wp_enqueue_style('web-craft-studio-section-works', get_template_directory_uri() . '/assets/css/top/section-works.css', array('web-craft-studio-common'), $theme_version);
    wp_enqueue_style('web-craft-studio-section-staff', get_template_directory_uri() . '/assets/css/top/section-staff.css', array('web-craft-studio-common'), $theme_version);
    wp_enqueue_style('web-craft-studio-section-testimonials', get_template_directory_uri() . '/assets/css/top/section-testimonials.css', array('web-craft-studio-common'), $theme_version);
    wp_enqueue_style('web-craft-studio-section-news', get_template_directory_uri() . '/assets/css/top/section-news.css', array('web-craft-studio-common'), $theme_version);
    wp_enqueue_style('web-craft-studio-section-cta', get_template_directory_uri() . '/assets/css/top/section-cta.css', array('web-craft-studio-common'), $theme_version);
  }

  // Aboutページ用CSS（Aboutページのみ読み込む）
  if (is_page('about') || is_page_template('page-templates/page-about.php')) {
    wp_enqueue_style('web-craft-studio-page-about', get_template_directory_uri() . '/assets/css/about/page-about.css', array('web-craft-studio-common'), $theme_version);
  }

  // カスタム投稿タイプ「Works」のアーカイブページ用CSS
  if (is_post_type_archive('works')) {
    wp_enqueue_style('web-craft-studio-works-archive', get_template_directory_uri() . '/assets/css/works/archive-works.css', array('web-craft-studio-common'), $theme_version);
  }

  // カスタム投稿タイプ「Works」の詳細ページ用CSS
  if (is_singular('works')) {
    wp_enqueue_style('web-craft-studio-works-single', get_template_directory_uri() . '/assets/css/works/single-works.css', array('web-craft-studio-common'), $theme_version);
  }

  // カスタム投稿タイプ「Blog」のアーカイブページ用CSS
  if (is_post_type_archive('blog')) {
    wp_enqueue_style('web-craft-studio-blog-archive', get_template_directory_uri() . '/assets/css/blog/archive-blog.css', array('web-craft-studio-common'), $theme_version);
  }

  // カスタム投稿タイプ「Blog」の詳細ページ用CSS
  if (is_singular('blog')) {
    wp_enqueue_style('web-craft-studio-blog-single', get_template_directory_uri() . '/assets/css/blog/single-blog.css', array('web-craft-studio-common'), $theme_version);
  }

  // Contactページ用CSS（Contactページのみ読み込む）
  if (is_page('contact') || is_page_template('page-templates/page-contact.php')) {
    wp_enqueue_style('web-craft-studio-page-contact', get_template_directory_uri() . '/assets/css/contact/page-contact.css', array('web-craft-studio-common'), $theme_version);
  }

  // 共通JavaScript（すべてのページで読み込む）
  wp_enqueue_script('web-craft-studio-common', get_template_directory_uri() . '/assets/js/common.js', array(), $theme_version, true);

  // TOPページ用JavaScript（TOPページのみ読み込む）
  if (is_page_template('page-templates/page-top.php') || is_front_page()) {
    wp_enqueue_script('web-craft-studio-top', get_template_directory_uri() . '/assets/js/top.js', array('web-craft-studio-common'), $theme_version, true);
  }

  // Works詳細ページ用JavaScript（Works詳細ページのみ読み込む）
  if (is_singular('works')) {
    wp_enqueue_script('web-craft-studio-works-single', get_template_directory_uri() . '/assets/js/works-single.js', array('web-craft-studio-common'), $theme_version, true);
  }

  // お問い合わせページ用JavaScript（フォームバリデーションなど）
  if (is_page('contact') || is_page_template('page-templates/page-contact.php')) {
    wp_enqueue_script('web-craft-studio-contact', get_template_directory_uri() . '/assets/js/contact.js', array('web-craft-studio-common'), $theme_version, true);
  }
}
add_action('wp_enqueue_scripts', 'web_craft_studio_scripts');
```

**よく使う条件分岐の例**:

| 条件 | 説明 | 使用例 |
| --- | --- | --- |
| `is_front_page()` | トップページ（フロントページ） | `if (is_front_page()) { ... }` |
| `is_page('about')` | 固定ページ「about」 | `if (is_page('about')) { ... }` |
| `is_page_template('page-templates/page-top.php')` | 特定のページテンプレート | `if (is_page_template('page-templates/page-top.php')) { ... }` |
| `is_post_type_archive('works')` | カスタム投稿タイプ「works」のアーカイブページ | `if (is_post_type_archive('works')) { ... }` |
| `is_singular('works')` | カスタム投稿タイプ「works」の詳細ページ | `if (is_singular('works')) { ... }` |
| `is_singular('blog')` | カスタム投稿タイプ「blog」の詳細ページ | `if (is_singular('blog')) { ... }` |
| `is_home()` | ブログのホームページ | `if (is_home()) { ... }` |
| `is_single()` | 単一投稿ページ | `if (is_single()) { ... }` |
| `is_archive()` | アーカイブページ全般 | `if (is_archive()) { ... }` |

> **💡 推奨**: 初心者の方は**方法1（シンプルな方法）**を使用してください。パフォーマンスを最適化したい場合は、**方法2（条件分岐）**を使用できます。

## 🎨 テンプレートパーツの分割

### コンポーネント化のルール

**ページごとにフォルダーを分ける構造**:

1. **セクション1つ = ファイル1つ**
   - 例：ファーストビュー → `section-fv.php`
2. **ページごとにフォルダーを分ける**（`template-parts/{ページ名}/`）
   - 例：TOPページ → `template-parts/top/`
   - 例：Aboutページ → `template-parts/about/`
3. **全ページ共通パーツは `template-parts/common/` に配置**
   - 例：`header.php`, `footer.php`
4. **命名規則**: `section-{セクション名}.php`
   - 例：`section-fv.php`, `section-services.php`
5. **呼び出し方**: `get_template_part('template-parts/{ページ名}/section-{名前}')`
   - 例：`get_template_part('template-parts/top/section-fv')`

**ディレクトリ構造**:
```
template-parts/
├── common/              # 全ページ共通パーツ
│   ├── header.php
│   └── footer.php
├── top/                 # TOPページ専用
│   ├── section-fv.php
│   ├── section-services.php
│   └── ...
└── about/               # Aboutページ専用
    └── section-page-header.php
```

### テンプレートパーツのブロック名ルール

**重要**: テンプレートパーツのブロック名（クラス名）は、**ファイル名から自動的に決定**されます（静的サイトフェーズと同じルール）。

**原則**: **1ファイル = 1ブロック**
- 1つのファイルには、1つのブロック（セクション）のみを定義します
- ✅ **OK**: `section-fv.php` には `.sectionFv` ブロックのみ
- ❌ **NG**: `section-fv.php` に `.sectionFv` と `.sectionServices` の両方を含める


**統一ルール**: **ファイル名から自動的に決定**

**命名規則**:
- ファイル名: `section-{セクション名}.php`
- ブロック名（クラス名）: `section{セクション名}`（キャメルケース）
- ハイフン（`-`）を削除し、次の単語の最初の文字を大文字にする

**例**:
- `section-fv.php` → ブロック名: `sectionFv`
- `section-services.php` → ブロック名: `sectionServices`
- `section-works.php` → ブロック名: `sectionWorks`
- `section-testimonials.php` → ブロック名: `sectionTestimonials`

**静的サイトフェーズとの関係**:
- 静的サイトフェーズで使用したブロック名（`sectionFv`など）を**そのまま使用**できます
- WordPress化時にブロック名を変更する必要はありません
- **1ファイル = 1ブロック**の原則も変わりません

**実装例**:
```php
<?php
/**
 * ファーストビューセクション
 *
 * @package Web_Craft_Studio
 */
?>

<section class="sectionFv">
  <div class="u-container">
    <!-- セクション内容 -->
  </div>
</section>
```

### SCSSファイルの構造

**重要**: WordPress化後は、SCSSファイルもPHPテンプレートパーツと同じ構造に合わせます。

**静的サイトフェーズとの違い**:
- **ファイル構造**: 静的サイトフェーズは`assets/scss/section-fv.scss`（ルートに配置）、WordPress化後は`assets/scss/top/section-fv.scss`（ページごとにフォルダー分け）
- **ブロック名（クラス名）**: **同じルール**（`sectionFv`、変更不要）
- **1ファイル = 1ブロック**: **同じ原則**（変更不要）
- **パーシャル参照**: 静的サイトフェーズは`@use 'partials/variables'`、WordPress化後は`@use '../partials/variables'`

**移行時の手順**:
1. 静的サイトフェーズで作成したSCSSファイルを、WordPress化時に`assets/scss/{ページ名}/`に移動します
   - 例: `assets/scss/section-fv.scss` → `assets/scss/top/section-fv.scss`
2. **クラス名は変更不要**です（同じルールを使用しているため）
3. パーシャルファイルの参照パスを修正します
   - 変更前: `@use 'partials/variables';`
   - 変更後: `@use '../partials/variables';`
4. `functions.php` でCSSファイルの読み込みパスを修正します
   - 例: `get_template_directory_uri() . '/assets/css/top/section-fv.css'`

**ディレクトリ構造**:
```
assets/scss/
├── common.scss          # 共通スタイル（リセット、ベースなど）
├── common/              # 全ページ共通パーツ
│   ├── header.scss
│   └── footer.scss
├── top/                 # TOPページ専用
│   ├── section-fv.scss
│   ├── section-services.scss
│   └── ...
└── partials/            # パーシャルファイル
    ├── _variables.scss
    └── ...
```

**パーシャルファイルの参照**:
- サブディレクトリ内のSCSSファイルからパーシャルを参照する場合は、相対パスで `../partials/` を使用
- 例：`assets/scss/top/section-fv.scss` から `assets/scss/partials/variables.scss` を参照する場合
  ```scss
  @use '../partials/variables';
  @use '../partials/reset';
  @use '../partials/base';
  @use '../partials/utilities';
  @use '../partials/layout';

  .sectionFv {
    // スタイルを記述
  }
  ```

### TOPページの例

```php
<?php
// page-templates/page-top.php
get_header();
?>

<?php get_template_part('template-parts/top/section-fv'); ?>
<?php get_template_part('template-parts/top/section-services'); ?>
<?php get_template_part('template-parts/top/section-works'); ?>
<?php get_template_part('template-parts/top/section-staff'); ?>
<?php get_template_part('template-parts/top/section-testimonials'); ?>
<?php get_template_part('template-parts/top/section-news'); ?>
<?php get_template_part('template-parts/top/section-cta'); ?>

<?php
get_footer();
```

## 📄 固定ページの実装

### ページテンプレートの作成

1. **ファイルの場所**: `page-templates/` ディレクトリに作成
   - 例: `page-about.php`, `page-contact.php`

2. **基本構造**
   ```php
   <?php
   /**
    * Template Name: About
    */
   get_header();
   ?>

  <main class="main">
    <?php get_template_part('template-parts/about/section-page-header'); ?>
    <?php get_template_part('template-parts/about/section-page-content'); ?>
  </main>

   <?php
   get_footer();
   ```

## 📝 実装手順の詳細

### テーマの基本構造

#### style.cssの作成

テーマの基本情報を記述します。

```css
/*
Theme Name: Web Craft Studio
Description: チーム開発用WordPressテーマ
Version: 1.0.0
Author: Web Craft Studio Team
*/
```

#### functions.phpの完全な例

`functions.php`にすべての機能を記述します。ファイルを分けずに、1つのファイルにまとめます。

```php
<?php
/**
 * Web Craft Studio テーマの関数定義
 *
 * @package Web_Craft_Studio
 */

// テーマのバージョン
define('THEME_VERSION', '1.0.0');

// テーマのパス
define('THEME_PATH', get_template_directory());
define('THEME_URI', get_template_directory_uri());

/**
 * テーマのセットアップ
 */
function web_craft_studio_setup() {
  // タイトルタグのサポート
  add_theme_support('title-tag');

  // アイキャッチ画像のサポート
  add_theme_support('post-thumbnails');

  // HTML5マークアップのサポート
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));
}
add_action('after_setup_theme', 'web_craft_studio_setup');

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
 * メニューの作成（コードで実装）
 */
function create_theme_menus() {
  // ヘッダーメニューを作成
  $header_menu_exists = wp_get_nav_menu_object('header-menu');
  if (!$header_menu_exists) {
    $header_menu_id = wp_create_nav_menu('header-menu');

    // メニュー項目を追加
    wp_update_nav_menu_item($header_menu_id, 0, array(
      'menu-item-title' => 'ホーム',
      'menu-item-url' => home_url('/'),
      'menu-item-status' => 'publish',
    ));

    wp_update_nav_menu_item($header_menu_id, 0, array(
      'menu-item-title' => 'About',
      'menu-item-url' => home_url('/about/'),
      'menu-item-status' => 'publish',
    ));

    wp_update_nav_menu_item($header_menu_id, 0, array(
      'menu-item-title' => 'Works',
      'menu-item-url' => home_url('/works/'),
      'menu-item-status' => 'publish',
    ));

    wp_update_nav_menu_item($header_menu_id, 0, array(
      'menu-item-title' => 'Blog',
      'menu-item-url' => home_url('/blog/'),
      'menu-item-status' => 'publish',
    ));

    wp_update_nav_menu_item($header_menu_id, 0, array(
      'menu-item-title' => 'Contact',
      'menu-item-url' => home_url('/contact/'),
      'menu-item-status' => 'publish',
    ));

    // メニューの位置を設定
    $locations = get_theme_mod('nav_menu_locations');
    $locations['header-menu'] = $header_menu_id;
    set_theme_mod('nav_menu_locations', $locations);
  }

  // フッターメニューを作成（必要に応じて）
  $footer_menu_exists = wp_get_nav_menu_object('footer-menu');
  if (!$footer_menu_exists) {
    $footer_menu_id = wp_create_nav_menu('footer-menu');

    // フッターメニューの項目を追加（必要に応じて）
    // wp_update_nav_menu_item($footer_menu_id, 0, array(...));

    // メニューの位置を設定
    $locations = get_theme_mod('nav_menu_locations');
    $locations['footer-menu'] = $footer_menu_id;
    set_theme_mod('nav_menu_locations', $locations);
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
  $theme_version = wp_get_theme()->get('Version');

  // 共通CSS（すべてのページで読み込む）
  wp_enqueue_style('web-craft-studio-common', get_template_directory_uri() . '/assets/css/common.css', array(), $theme_version);

  // ヘッダーCSS（すべてのページで読み込む）
  wp_enqueue_style('web-craft-studio-header', get_template_directory_uri() . '/assets/css/header.css', array('web-craft-studio-common'), $theme_version);

  // フッターCSS（すべてのページで読み込む）
  wp_enqueue_style('web-craft-studio-footer', get_template_directory_uri() . '/assets/css/footer.css', array('web-craft-studio-common'), $theme_version);

  // セクション用CSS（すべてのページで読み込む）
  // 新しいセクション用CSSを追加する場合は、コメントアウトを解除して追加してください
  wp_enqueue_style('web-craft-studio-section-fv', get_template_directory_uri() . '/assets/css/top/section-fv.css', array('web-craft-studio-common'), $theme_version);
  // wp_enqueue_style('web-craft-studio-section-services', get_template_directory_uri() . '/assets/css/top/section-services.css', array('web-craft-studio-common'), $theme_version);
  // wp_enqueue_style('web-craft-studio-section-works', get_template_directory_uri() . '/assets/css/top/section-works.css', array('web-craft-studio-common'), $theme_version);

  // 共通JavaScript（すべてのページで読み込む）
  wp_enqueue_script('web-craft-studio-common', get_template_directory_uri() . '/assets/js/common.js', array(), $theme_version, true);
}
add_action('wp_enqueue_scripts', 'web_craft_studio_scripts');

/**
 * Works（制作実績）カスタム投稿タイプを登録
 */
function register_works_post_type() {
  $labels = array(
    'name' => 'Works',
    'singular_name' => 'Work',
    'menu_name' => 'Works',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-portfolio',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'rewrite' => array('slug' => 'works'),
  );

  $result = register_post_type('works', $args);

  if (is_wp_error($result)) {
    error_log('カスタム投稿タイプの登録に失敗しました: ' . $result->get_error_message());
  }
}
add_action('init', 'register_works_post_type');

/**
 * Blog（ブログ）カスタム投稿タイプを登録
 */
function register_blog_post_type() {
  $labels = array(
    'name' => 'Blog',
    'singular_name' => 'Blog',
    'menu_name' => 'Blog',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-edit',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
    'rewrite' => array('slug' => 'blog'),
  );

  $result = register_post_type('blog', $args);

  if (is_wp_error($result)) {
    error_log('カスタム投稿タイプの登録に失敗しました: ' . $result->get_error_message());
  }
}
add_action('init', 'register_blog_post_type');
```

> **💡 ポイント**: `functions.php`にすべての機能を記述することで、ファイルが分散せず、初心者にも理解しやすくなります。メニュー項目の追加・削除や、新しいCSSの追加も、このファイルを編集するだけです。

### カスタム投稿タイプの実装

このプロジェクトでは、以下のカスタム投稿タイプを作成します：

- **Works（制作実績）** - 制作実績を管理
- **Blog（ブログ）** - ブログ記事を管理

> **💡 注意**: 標準の投稿タイプ（`post`）は使用しません。ブログはカスタム投稿タイプ `blog` を使用します。

#### カスタム投稿タイプの登録

`functions.php`に直接記述します。

```php
/**
 * Works（制作実績）カスタム投稿タイプを登録
 */
function register_works_post_type() {
  $labels = array(
    'name' => 'Works',
    'singular_name' => 'Work',
    'menu_name' => 'Works',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-portfolio',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'rewrite' => array('slug' => 'works'),
  );

  $result = register_post_type('works', $args);

  if (is_wp_error($result)) {
    error_log('カスタム投稿タイプの登録に失敗しました: ' . $result->get_error_message());
  }
}
add_action('init', 'register_works_post_type');

/**
 * Blog（ブログ）カスタム投稿タイプを登録
 */
function register_blog_post_type() {
  $labels = array(
    'name' => 'Blog',
    'singular_name' => 'Blog',
    'menu_name' => 'Blog',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-edit',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
    'rewrite' => array('slug' => 'blog'),
  );

  $result = register_post_type('blog', $args);

  if (is_wp_error($result)) {
    error_log('カスタム投稿タイプの登録に失敗しました: ' . $result->get_error_message());
  }
}
add_action('init', 'register_blog_post_type');
```

#### テンプレートファイルの命名規則

カスタム投稿タイプには、以下のテンプレートファイルを作成します：

- **アーカイブページ**: `archive-{投稿タイプ名}.php`
  - 例: `archive-works.php`, `archive-blog.php`
- **詳細ページ**: `single-{投稿タイプ名}.php`
  - 例: `single-works.php`, `single-blog.php`

> **💡 その他の設定**: アーカイブページの表示件数、タクソノミーの有無、ソート順などは、デザインカンプに合わせて実装してください。特に細かいルールは定めません。

### エスケープ処理のルール

**重要**: 出力するデータは必ずエスケープ処理を行います。

```php
// テキスト
<?php echo esc_html( $variable ); ?>

// URL
<a href="<?php echo esc_url( $url ); ?>">リンク</a>

// 属性
<div class="<?php echo esc_attr( $class_name ); ?>">コンテンツ</div>

// WordPress関数は自動エスケープされる
<?php the_title(); ?>        // OK（エスケープ不要）
<?php the_content(); ?>      // OK（エスケープ不要）

// get_*系の関数はエスケープが必要
<?php echo esc_html( get_the_title() ); ?>
```

### ループの書き方

**必ず`if ( have_posts() )`でチェックしてからループを開始します。**

```php
<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        // コンテンツの表示
    endwhile;
endif;
?>
```

### カスタムフィールドの実装

このプロジェクトでは、**Advanced Custom Fields (ACF)** を使用してカスタムフィールドを実装します。

> **📌 重要**: ACFは必須プラグインです。全員がインストールして使用してください。

#### ACFのセットアップ

1. **ACFプラグインのインストール**
   - WordPress管理画面 > **プラグイン > 新規追加**
   - 「Advanced Custom Fields」で検索
   - 「Advanced Custom Fields」をインストール・有効化

2. **カスタムフィールドグループの作成**
   - 管理画面 > **カスタムフィールド > 新規追加**
   - フィールドグループ名を設定（例: 「よくある質問」）
   - フィールドを追加

#### よくある質問（FAQ）の実装例

> **📌 注意**: ACFの無料版ではリピーターフィールドが使用できません。そのため、固定数のフィールドを使用します。

**よくある質問ページ用のACF設定**:
1. フィールドグループ名: 「よくある質問ページ」
2. 表示位置: 固定ページ = よくある質問ページ
3. フィールド構成:
   - **セクション1**（グループフィールド）:
     - `section1_title`（セクションタイトル）- テキスト
     - `section1_question_1`（質問1）- テキスト
     - `section1_answer_1`（回答1）- テキストエリア
     - `section1_question_2`（質問2）- テキスト
     - `section1_answer_2`（回答2）- テキストエリア
     - `section1_question_3`（質問3）- テキスト
     - `section1_answer_3`（回答3）- テキストエリア
     - `section1_question_4`（質問4）- テキスト
     - `section1_answer_4`（回答4）- テキストエリア
   - **セクション2〜5**も同様に設定（各セクション最大4個の質問）

**よくある質問ページのテンプレート例**:
```php
<?php
/**
 * よくある質問ページ
 */
$sections = array(1, 2, 3, 4, 5);
?>
<section class="sectionFaq">
  <div class="u-container">
    <?php
    foreach ($sections as $section_num) :
      $section_title = get_field("section{$section_num}_title");
      if (!$section_title) continue;
      ?>
      <div class="faq-section">
        <h2 class="faq-section__title"><?php echo esc_html($section_title); ?></h2>
        <div class="faq-section__list">
          <?php
          for ($i = 1; $i <= 4; $i++) :
            $question = get_field("section{$section_num}_question_{$i}");
            $answer = get_field("section{$section_num}_answer_{$i}");
            if (!$question || !$answer) continue;
            ?>
            <div class="faq-item">
              <h3 class="faq-item__question"><?php echo esc_html($question); ?></h3>
              <div class="faq-item__answer"><?php echo wp_kses_post($answer); ?></div>
            </div>
            <?php
          endfor;
          ?>
        </div>
      </div>
      <?php
    endforeach;
    ?>
  </div>
</section>
```

**お問い合わせページ・サービスページ下部用のACF設定**:
1. フィールドグループ名: 「よくある質問（簡易版）」
2. 表示位置: 固定ページ = お問い合わせページ、サービスページ
3. フィールド構成:
   - `faq_question_1`（質問1）- テキスト
   - `faq_answer_1`（回答1）- テキストエリア
   - `faq_question_2`（質問2）- テキスト
   - `faq_answer_2`（回答2）- テキストエリア
   - `faq_question_3`（質問3）- テキスト
   - `faq_answer_3`（回答3）- テキストエリア
   - `faq_question_4`（質問4）- テキスト
   - `faq_answer_4`（回答4）- テキストエリア
   - `faq_question_5`（質問5）- テキスト
   - `faq_answer_5`（回答5）- テキストエリア

**お問い合わせページ・サービスページ下部のテンプレート例**:
```php
<?php
/**
 * よくある質問セクション（簡易版 - 5個表示）
 */
?>
<section class="sectionFaq">
  <div class="u-container">
    <h2 class="sectionFaq__title">よくある質問</h2>
    <div class="sectionFaq__list">
      <?php
      for ($i = 1; $i <= 5; $i++) :
        $question = get_field("faq_question_{$i}");
        $answer = get_field("faq_answer_{$i}");
        if (!$question || !$answer) continue;
        ?>
        <div class="faq-item">
          <h3 class="faq-item__question"><?php echo esc_html($question); ?></h3>
          <div class="faq-item__answer"><?php echo wp_kses_post($answer); ?></div>
        </div>
        <?php
      endfor;
      ?>
    </div>
  </div>
</section>
```

#### 制作実績（Works）の追加情報の実装例

**ACFの設定**:
1. フィールドグループ名: 「制作実績の追加情報」
2. 表示位置: 投稿タイプ = Works
3. フィールド:
   - `client_name`（クライアント名）- テキスト
   - `project_url`（プロジェクトURL）- URL
   - `project_date`（制作日）- 日付

**テンプレートでの使用例**:
```php
<?php
/**
 * 制作実績の詳細ページ
 */
$client_name = get_field('client_name');
$project_url = get_field('project_url');
$project_date = get_field('project_date');
?>
<article class="work-detail">
  <h1 class="work-detail__title"><?php the_title(); ?></h1>

  <?php if ($client_name) : ?>
    <p class="work-detail__client">クライアント: <?php echo esc_html($client_name); ?></p>
  <?php endif; ?>

  <?php if ($project_date) : ?>
    <p class="work-detail__date">制作日: <?php echo esc_html($project_date); ?></p>
  <?php endif; ?>

  <?php if ($project_url) : ?>
    <a href="<?php echo esc_url($project_url); ?>" class="work-detail__link" target="_blank" rel="noopener">
      サイトを見る
    </a>
  <?php endif; ?>

  <div class="work-detail__content">
    <?php the_content(); ?>
  </div>
</article>
```

#### データベースの共有について

ACFのカスタムフィールドグループ設定は、**エクスポート/インポート機能**で共有できます：

1. **エクスポート**: 管理画面 > **カスタムフィールド > ツール > エクスポート**
2. **インポート**: 管理画面 > **カスタムフィールド > ツール > インポート**

> **💡 注意**: ACFのフィールドグループ設定は、WordPressのエクスポート/インポート機能では共有されません。ACFのエクスポート/インポート機能を使用するか、`acf-json`フォルダを使用してGitで管理することもできます。

## 💾 データベースの共有

ローカル開発環境でWordPressの管理画面で変更したデータベースの情報をチームで共有する方法を説明します。

### 概要

WordPressの開発では、管理画面で以下のような変更を行います：

- 固定ページの作成・編集
- カスタム投稿タイプの投稿作成
- ウィジェットの設定
- カスタムフィールドの設定（ACF）
- その他の設定

> **💡 注意**: メニューはコードで作成するため、データベースの共有は不要です。メニューの変更は `functions.php` を編集して行います。

これらの変更はデータベースに保存されるため、**チームメンバー間で共有する必要があります**。

### 推奨方法: WordPressのエクスポート/インポート機能

**もっとも簡単で安全な方法**です。コンテンツのみを共有できます。

#### エクスポート（変更を共有する側）

1. WordPressの管理画面にログイン
2. **ツール > エクスポート** を選択
3. **すべてのコンテンツ** または **特定の投稿タイプ** を選択
4. **エクスポートファイルをダウンロード** をクリック
5. ダウンロードしたXMLファイルをチームで共有（Slack、GitHubのIssue、など）

#### インポート（変更を受け取る側）

1. WordPressの管理画面にログイン
2. **ツール > インポート** を選択
3. **WordPress** を選択（初回のみプラグインのインストールが必要）
4. 共有されたXMLファイルを選択
5. **アップロードしてインポート** をクリック
6. **投稿者をマッピング**（必要に応じて）
7. **送信** をクリック

**メリット**:
- ✅ 簡単で安全
- ✅ URLが自動的に置換される（ローカル環境のURLに）
- ✅ 画像も自動的にインポートされる
- ✅ コンテンツのみを共有できる（設定ファイルは含まれない）

### チーム開発での運用方法

1. **定期的な共有**: 重要な変更（固定ページの作成、カスタム投稿の追加など）を行ったら、すぐに共有
2. **共有場所**: GitHubのIssueに添付、Slackなどのチームチャット
3. **共有時のチェックリスト**:
   - [ ] エクスポート前に、自分のローカル環境で動作確認
   - [ ] 共有するファイル名に日付を含める（例: `export-2024-01-15.xml`）
   - [ ] 共有時に、何が変更されたかを説明する
   - [ ] インポート後、管理画面で動作確認

### 注意事項

- **SQLファイルはGitにコミットしないでください**（ファイルサイズが大きい、個人情報が含まれる可能性がある）
- データベースには個人情報が含まれる可能性があります。共有する際は、チーム内でのみ共有してください
- 本番環境のデータベースは絶対に共有しないでください

### トラブルシューティング

#### インポート後に「404エラー」が表示される

**解決方法**:
1. 管理画面 > **設定 > パーマリンク設定** を開く
2. **変更を保存** をクリック（何も変更しなくてOK）
3. これでパーマリンクが再生成されます

#### インポート後に画像が表示されない

**解決方法**:
1. 管理画面 > **メディア** を確認
2. 画像がアップロードされているか確認
3. 画像ファイルを手動で共有する必要がある場合があります

## 📚 もっと詳しく知りたい場合

- [コーディング規約（詳細版）](coding-standards.md) - PHPセクションを参照
- [よくある質問・トラブルシューティング](faq-troubleshooting.md) - 困ったときはここ

## ➡️ 次に読むべきもの

- **[デザイン変更](06-design-update.md)** - WordPress化完了後、デザイン変更タスクに進みましょう

---

**最終更新**: 2025/12/4
