# WordPress化 ステップ別指示書

## 概要

このドキュメントは、HTML/CSS/JavaScriptで実装したサイトをWordPressテーマとして実装するための手順を説明します。

## 📌 このフェーズで必要なルール

**まず読む**: [クイックスタートガイド](../../quick-start.md)

### このフェーズで覚えるべきこと

1. **PHPの基本**
   - エラーハンドリングを必ず書く
   - WordPress関数の戻り値をチェック

2. **WordPressの基本**
   - テンプレート階層の理解
   - ループの使い方
   - 関数の使い方（`get_header()`, `the_content()`など）

3. **BEM命名規則**（模写コーディングと同じ）
   - 既に実装したHTML/CSSの命名規則を維持

詳細は必要になったら [コーディング規約（詳細版）](../../coding-standards.md) を参照してください。

## 作業の流れ

1. テーマの基本構造を作成
2. 固定ページの実装
3. カスタム投稿タイプの実装
4. テンプレートパーツの分割
5. 動的コンテンツの実装
6. 動作確認

---

## 1. テーマの基本構造を作成

### ステップ1: style.cssの作成

テーマの基本情報を記述します。

```css
/*
Theme Name: Web Craft Studio
Description: チーム開発用WordPressテーマ
Version: 1.0.0
Author: チーム名
*/

/* ここから下に既存のCSSを記述 */
```

### ステップ2: functions.phpの作成

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

/**
 * スタイルシートとスクリプトの読み込み
 */
function theme_enqueue_scripts() {
  // スタイルシート
  wp_enqueue_style(
    'theme-style',
    get_stylesheet_uri(),
    array(),
    THEME_VERSION
  );

  // 追加のCSSファイル
  wp_enqueue_style(
    'theme-main',
    THEME_URI . '/assets/css/main.css',
    array(),
    THEME_VERSION
  );

  // JavaScript
  wp_enqueue_script(
    'theme-main',
    THEME_URI . '/assets/js/main.js',
    array(),
    THEME_VERSION,
    true
  );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
```

### ステップ3: ファイル構成の作成

```
テーマディレクトリ/
├── style.css
├── functions.php
├── index.php
├── header.php
├── footer.php
├── single.php
├── page.php
├── archive.php
├── assets/
│   ├── css/
│   │   └── main.css
│   └── js/
│       └── main.js
└── inc/
    ├── setup.php
    ├── enqueue.php
    └── custom-post.php
```

---

## 2. 固定ページの実装

### ステップ1: header.phpの作成

```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="header">
    <div class="header__inner">
      <h1 class="header__logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo-link">
          <?php bloginfo('name'); ?>
        </a>
      </h1>

      <?php
      wp_nav_menu(array(
        'theme_location' => 'header-menu',
        'container' => 'nav',
        'container_class' => 'header__nav',
        'menu_class' => 'header__nav-list',
        'fallback_cb' => false,
      ));
      ?>

      <button class="header__menu-toggle" aria-label="メニューを開く">
        <span class="header__menu-toggle-line"></span>
      </button>
    </div>
  </header>
```

### ステップ2: footer.phpの作成

```php
  <footer class="footer">
    <div class="footer__inner">
      <p class="footer__copyright">
        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
      </p>

      <?php
      wp_nav_menu(array(
        'theme_location' => 'footer-menu',
        'container' => 'nav',
        'container_class' => 'footer__nav',
        'menu_class' => 'footer__nav-list',
        'fallback_cb' => false,
      ));
      ?>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
```

### ステップ3: page.phpの作成

```php
<?php
/**
 * 固定ページテンプレート
 */

get_header();
?>

<main class="main">
  <?php
  while (have_posts()) {
    the_post();
    ?>
    <article class="page">
      <div class="page__inner">
        <h1 class="page__title"><?php the_title(); ?></h1>

        <div class="page__content">
          <?php the_content(); ?>
        </div>
      </div>
    </article>
    <?php
  }
  ?>
</main>

<?php
get_footer();
```

### ステップ4: index.phpの作成

```php
<?php
/**
 * メインテンプレート
 */

get_header();
?>

<main class="main">
  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      ?>
      <article class="post">
        <h2 class="post__title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <div class="post__content">
          <?php the_excerpt(); ?>
        </div>
      </article>
      <?php
    }
  } else {
    ?>
    <p>投稿が見つかりませんでした。</p>
    <?php
  }
  ?>
</main>

<?php
get_footer();
```

---

## 3. カスタム投稿タイプの実装

### ステップ1: カスタム投稿タイプの登録

`inc/custom-post.php`を作成します。

```php
<?php
/**
 * カスタム投稿タイプの登録
 */

/**
 * Works（実績）カスタム投稿タイプを登録
 */
function register_works_post_type() {
  $labels = array(
    'name' => 'Works',
    'singular_name' => 'Work',
    'menu_name' => 'Works',
    'add_new' => '新規追加',
    'add_new_item' => '新しいWorkを追加',
    'edit_item' => 'Workを編集',
    'new_item' => '新しいWork',
    'view_item' => 'Workを表示',
    'search_items' => 'Workを検索',
    'not_found' => 'Workが見つかりませんでした',
    'not_found_in_trash' => 'ゴミ箱にWorkはありません',
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
 * Worksカテゴリーの登録
 */
function register_works_taxonomy() {
  $labels = array(
    'name' => 'Worksカテゴリー',
    'singular_name' => 'Worksカテゴリー',
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'rewrite' => array('slug' => 'works-category'),
  );

  $result = register_taxonomy('works_category', 'works', $args);

  if (is_wp_error($result)) {
    error_log('タクソノミーの登録に失敗しました: ' . $result->get_error_message());
  }
}
add_action('init', 'register_works_taxonomy');
```

### ステップ2: functions.phpに読み込み

```php
// カスタム投稿タイプの読み込み
require_once THEME_PATH . '/inc/custom-post.php';
```

### ステップ3: カスタム投稿タイプのアーカイブテンプレート

`archive-works.php`を作成します。

```php
<?php
/**
 * Worksアーカイブテンプレート
 */

get_header();
?>

<main class="main">
  <div class="works-archive">
    <h1 class="works-archive__title">Works</h1>

    <div class="works-archive__list">
      <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          ?>
          <article class="works-item">
            <?php if (has_post_thumbnail()) : ?>
              <div class="works-item__thumbnail">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('medium'); ?>
                </a>
              </div>
            <?php endif; ?>

            <h2 class="works-item__title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <div class="works-item__excerpt">
              <?php the_excerpt(); ?>
            </div>

            <?php
            $terms = get_the_terms(get_the_ID(), 'works_category');
            if ($terms && !is_wp_error($terms)) {
              ?>
              <div class="works-item__categories">
                <?php
                foreach ($terms as $term) {
                  echo '<span class="works-item__category">' . esc_html($term->name) . '</span>';
                }
                ?>
              </div>
              <?php
            }
            ?>
          </article>
          <?php
        }
      } else {
        ?>
        <p>Worksが見つかりませんでした。</p>
        <?php
      }
      ?>
    </div>

    <?php
    // ページネーション
    the_posts_pagination();
    ?>
  </div>
</main>

<?php
get_footer();
```

### ステップ4: カスタム投稿タイプの詳細テンプレート

`single-works.php`を作成します。

```php
<?php
/**
 * Works詳細テンプレート
 */

get_header();
?>

<main class="main">
  <?php
  while (have_posts()) {
    the_post();
    ?>
    <article class="works-single">
      <div class="works-single__inner">
        <h1 class="works-single__title"><?php the_title(); ?></h1>

        <?php if (has_post_thumbnail()) : ?>
          <div class="works-single__thumbnail">
            <?php the_post_thumbnail('large'); ?>
          </div>
        <?php endif; ?>

        <div class="works-single__content">
          <?php the_content(); ?>
        </div>

        <?php
        $terms = get_the_terms(get_the_ID(), 'works_category');
        if ($terms && !is_wp_error($terms)) {
          ?>
          <div class="works-single__categories">
            <span class="works-single__categories-label">カテゴリー:</span>
            <?php
            foreach ($terms as $term) {
              echo '<span class="works-single__category">' . esc_html($term->name) . '</span>';
            }
            ?>
          </div>
          <?php
        }
        ?>
      </div>
    </article>
    <?php
  }
  ?>
</main>

<?php
get_footer();
```

---

## 4. テンプレートパーツの分割

### ステップ1: テンプレートパーツディレクトリの作成

`template-parts/`ディレクトリを作成します。

### ステップ2: パーツファイルの作成

**例: `template-parts/works-card.php`**

```php
<?php
/**
 * Worksカードパーツ
 *
 * @param WP_Post $post 投稿オブジェクト
 */

if (!isset($post) || !$post instanceof WP_Post) {
  return;
}

setup_postdata($post);
?>

<article class="works-card">
  <?php if (has_post_thumbnail()) : ?>
    <div class="works-card__thumbnail">
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('medium'); ?>
      </a>
    </div>
  <?php endif; ?>

  <h2 class="works-card__title">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  </h2>

  <div class="works-card__excerpt">
    <?php the_excerpt(); ?>
  </div>
</article>

<?php
wp_reset_postdata();
```

### ステップ3: パーツの読み込み

```php
<?php
// テンプレートパーツの読み込み
get_template_part('template-parts/works-card', null, array('post' => $post));
?>
```

---

## 5. 動的コンテンツの実装

### ステップ1: カスタムフィールドの実装

**例: Worksの追加情報**

```php
/**
 * Worksカスタムフィールドの追加
 */
function add_works_meta_boxes() {
  add_meta_box(
    'works_details',
    'Works詳細情報',
    'render_works_meta_box',
    'works',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'add_works_meta_boxes');

/**
 * Worksメタボックスの表示
 */
function render_works_meta_box($post) {
  wp_nonce_field('save_works_meta', 'works_meta_nonce');

  $client = get_post_meta($post->ID, '_works_client', true);
  $url = get_post_meta($post->ID, '_works_url', true);
  $date = get_post_meta($post->ID, '_works_date', true);
  ?>
  <table class="form-table">
    <tr>
      <th><label for="works_client">クライアント名</label></th>
      <td>
        <input
          type="text"
          id="works_client"
          name="works_client"
          value="<?php echo esc_attr($client); ?>"
          class="regular-text"
        >
      </td>
    </tr>
    <tr>
      <th><label for="works_url">URL</label></th>
      <td>
        <input
          type="url"
          id="works_url"
          name="works_url"
          value="<?php echo esc_url($url); ?>"
          class="regular-text"
        >
      </td>
    </tr>
    <tr>
      <th><label for="works_date">制作日</label></th>
      <td>
        <input
          type="date"
          id="works_date"
          name="works_date"
          value="<?php echo esc_attr($date); ?>"
          class="regular-text"
        >
      </td>
    </tr>
  </table>
  <?php
}

/**
 * Worksメタボックスの保存
 */
function save_works_meta($post_id) {
  // 認証チェック
  if (!isset($_POST['works_meta_nonce']) || !wp_verify_nonce($_POST['works_meta_nonce'], 'save_works_meta')) {
    return;
  }

  // 自動保存チェック
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // 権限チェック
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // データの保存
  if (isset($_POST['works_client'])) {
    update_post_meta($post_id, '_works_client', sanitize_text_field($_POST['works_client']));
  }

  if (isset($_POST['works_url'])) {
    $url = esc_url_raw($_POST['works_url']);
    if ($url) {
      update_post_meta($post_id, '_works_url', $url);
    } else {
      delete_post_meta($post_id, '_works_url');
    }
  }

  if (isset($_POST['works_date'])) {
    update_post_meta($post_id, '_works_date', sanitize_text_field($_POST['works_date']));
  }
}
add_action('save_post_works', 'save_works_meta');
```

### ステップ2: カスタムフィールドの表示

```php
<?php
$client = get_post_meta(get_the_ID(), '_works_client', true);
$url = get_post_meta(get_the_ID(), '_works_url', true);
$date = get_post_meta(get_the_ID(), '_works_date', true);
?>

<?php if ($client) : ?>
  <div class="works-single__client">
    <strong>クライアント:</strong> <?php echo esc_html($client); ?>
  </div>
<?php endif; ?>

<?php if ($url) : ?>
  <div class="works-single__url">
    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
      <?php echo esc_html($url); ?>
    </a>
  </div>
<?php endif; ?>

<?php if ($date) : ?>
  <div class="works-single__date">
    <strong>制作日:</strong> <?php echo esc_html($date); ?>
  </div>
<?php endif; ?>
```

---

## 6. 動作確認

### 確認項目

- [ ] テーマが正しく有効化されている
- [ ] 固定ページが正しく表示される
- [ ] カスタム投稿タイプが正しく登録されている
- [ ] アーカイブページが正しく表示される
- [ ] 詳細ページが正しく表示される
- [ ] メニューが正しく表示される
- [ ] カスタムフィールドが正しく保存・表示される
- [ ] レスポンシブ対応が正しく動作している

### テスト手順

1. **管理画面での確認**
   - カスタム投稿タイプが表示されるか
   - メニューが設定できるか
   - カスタムフィールドが保存されるか

2. **フロントエンドでの確認**
   - 各ページが正しく表示されるか
   - リンクが正しく動作するか
   - 画像が正しく表示されるか

3. **エラーログの確認**
   - PHPエラーがないか
   - JavaScriptエラーがないか

---

## よくある質問・トラブルシューティング

### Q: カスタム投稿タイプが表示されない

A: 以下を確認してください
- `functions.php`で正しく登録されているか
- パーマリンク設定を更新（設定 > パーマリンク設定 > 変更を保存）

### Q: メニューが表示されない

A: 以下を確認してください
- `functions.php`でメニューが登録されているか
- 管理画面（外観 > メニュー）でメニューが作成・設定されているか
- `wp_nav_menu()`の引数が正しいか

### Q: カスタムフィールドが保存されない

A: 以下を確認してください
- 非ceフィールドの検証が正しいか
- 権限チェックが正しいか
- 自動保存時の処理をスキップしているか

---

## 参考資料

- [WordPress Codex](https://wpdocs.osdn.jp/)
- [WordPress Developer Handbook](https://developer.wordpress.org/)

---

## ➡️ 次に読むべきもの

- **WordPress化完了後**: [フェーズ別チェックリスト](../checklists/phase-checklist.md) - WordPress化セクションを確認
- **納品・振り返りフェーズ**: [フェーズ別チェックリスト](../checklists/phase-checklist.md) - 納品・振り返りセクション
- **全体の流れ**: [ドキュメント一覧](../README.md)
