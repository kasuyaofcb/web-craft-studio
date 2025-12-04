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

- テンプレート階層の理解
- ループの使い方
- 関数の使い方（`get_header()`, `the_content()`など）

### BEM命名規則

- **すでに実装したHTML/CSSの命名規則を維持**（ブロック名は変更不要）
- 静的サイトフェーズで使用したクラス名（`sectionFv`など）をそのまま使用できます

## 🔧 作業の流れ

1. **テーマの基本構造を作成**
2. **固定ページの実装**
3. **カスタム投稿タイプの実装**
4. **テンプレートパーツの分割**
5. **動的コンテンツの実装**
6. **動作確認**

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

  // メニューの登録
  register_nav_menus(array(
    'header-menu' => 'ヘッダーメニュー',
    'footer-menu' => 'フッターメニュー',
  ));
}
add_action('after_setup_theme', 'theme_setup');
```

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

**移行時の注意**:
- 静的サイトフェーズで作成したSCSSファイルを、WordPress化時に`assets/scss/{ページ名}/`に移動します
- **クラス名は変更不要**です（同じルールを使用しているため）

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

#### functions.phpの基本設定

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

  // メニューの登録
  register_nav_menus(array(
    'header-menu' => 'ヘッダーメニュー',
    'footer-menu' => 'フッターメニュー',
  ));
}
add_action('after_setup_theme', 'theme_setup');
```

### カスタム投稿タイプの実装

#### カスタム投稿タイプの登録

`inc/custom-post.php`を作成します。

```php
<?php
/**
 * Works（実績）カスタム投稿タイプを登録
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
```

#### functions.phpに読み込み

```php
// カスタム投稿タイプの読み込み
require_once THEME_PATH . '/inc/custom-post.php';
```

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

## 💾 データベースの共有

ローカル開発環境でWordPressの管理画面で変更したデータベースの情報をチームで共有する方法を説明します。

### 概要

WordPressの開発では、管理画面で以下のような変更を行います：

- 固定ページの作成・編集
- カスタム投稿タイプの投稿作成
- メニューの設定
- ウィジェットの設定
- カスタムフィールドの設定
- その他の設定

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

- **[リファクタリング](06-refactoring.md)** - WordPress化完了後、リファクタリングに進みましょう

---

**最終更新**: 2025/12/4
