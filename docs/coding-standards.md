# コーディング規約・命名規則（詳細版）

> **初学者の方はまず**: [クイックスタートガイド](quick-start.md) を読んでから、必要に応じてこの詳細版を参照してください。

このドキュメントは、コーディング規約の詳細な説明です。
基本的なルールは [クイックスタートガイド](quick-start.md) にまとめています。

## HTML

### 基本ルール

- インデントは**スペース2つ**を使用
- タグは小文字で記述
- 属性値はダブルクォートで囲む
- 自己完結型タグ（`<img>`, `<br>`など）は閉じタグを記述しない（HTML5形式）
- セマンティックなHTML5タグを積極的に使用

### 例

```html
<header class="header">
  <div class="header__inner">
    <h1 class="header__logo">
      <a href="/" class="header__logoLink">サイト名</a>
    </h1>
    <nav class="header__nav" aria-label="メインナビゲーション">
      <ul class="header__navList">
        <li class="header__navItem">
          <a href="/about" class="header__navLink">About</a>
        </li>
      </ul>
    </nav>
    <button class="header__menuToggle" aria-label="メニューを開く" aria-expanded="false">
      <span class="header__menuToggleLine"></span>
    </button>
  </div>
</header>
```

## CSS

### 基本ルール

- インデントは**スペース2つ**を使用
- **BEM（Block Element Modifier）**命名規則を採用し、共通スタイルはユーティリティクラス（`u-`接頭辞）で管理
- 各単語は**キャメルケース**を使用（最初は小文字、2単語目は大文字から始める）
- 1ファイルにつき1block要素で記述
- block名はファイル名のキャメルケースを使用（例：`page-components.php`なら`.pageComponents`）
- プロパティはアルファベット順に並べる（推奨）
- コメントは適切に記述

### 参考資料

- [BEM基本知識](https://qiita.com/takahirocook/items/01fd723b934e3b38cbbc)
- [BEM命名規則](https://necomesi.jp/blog/tsmd/posts/152#css-styles)

### BEM命名規則

#### 基本構造

```css
.blockName
.blockName__element
.blockName--modifier
.blockName__element--modifier
```

### Block

#### pages, components など

```html
<div class="blockName">
  ...
</div>
```

```css
.blockName {
  ...
}
```

#### utility

ページ・コンポーネントをまたいで使いたいが、componentsとして分類（別ファイル化）できない粒度の単一のクラス名は、他と区別するため、接頭辞に`u-`をつけてユーティリティークラスにします。該当スタイルシートは`utility/*.css`に作成します。

```html
<!-- 単一で使うためelement要素は存在してはいけない -->
<div class="u-utilityName">...</div>

<!-- マルチクラスで指定してもいい -->
<div class="blockName u-spDisplayNone">
  <h1 class="u-heading1">見出し1</h1>
  ...
</div>
```

```css
/* utility/utility.css */
.u-utilityName {
  ...
}

.u-spDisplayNone {
  display: none;
}

@media (min-width: 768px) {
  .u-spDisplayNone {
    display: block;
  }
}

.u-heading1 {
  font-size: 32px;
  font-weight: bold;
}
```

### Element

#### 基本事項

- elementのスタイルは以下のように**並列で記述**します

```html
<div class="blockName">
  <div class="blockName__element1">
    ...
    <div class="blockName__element2">
      ...
    </div>
  </div>
  <div class="blockName__element3">
    ...
  </div>
  ...
</div>
```

```css
.blockName {
  ...
}

.blockName__element1 {
  ...
}

.blockName__element2 {
  ...
}

.blockName__element3 {
  ...
}
```

- 派生のスタイルを当てる目的の場合は以下のようにmodifierクラス名を使用します

```html
<div class="blockName">
  <div class="blockName__style1 blockName__style1--style2">
    ...
  </div>
</div>
```

- 異なる要素間で共通のスタイルを当てる場合は、以下のようにユーティリティークラスを使用するか、共通のmixin定義し使用します

```html
<div class="blockName">
  <div class="blockName__element1 u-style2">
    ...
  </div>
  <div class="blockName__element2 u-style2">
    ...
  </div>
  ...
</div>
```

```css
/* mixinを使用する場合 */
@mixin style2 {
  ...
}

.blockName__element1 {
  @include style2;
  ...
}

.blockName__element2 {
  @include style2;
  ...
}
```

- block要素内でローカル変数を使用したい場合は、以下のように記述します。ローカル変数はグローバル変数と区別するため`$_`をつけます

```css
.blockName {
  @at-root {
    $_localVariable: 10px;

    & { /* .blockNameのスタイルはこれ */
      ...
    }

    .blockName__element1 {
      ...
    }

    .blockName__element2 {
      ...
    }

    .blockName__element3 {
      ...
    }
  }
}
```

#### 禁止事項

- **入れ子での記述は禁止**

```css
/* NG */
.blockName {
  ...
  .blockName__element1 {
    ...
    .blockName__element2 {
      ...
    }
  }
  .blockName__element3 {
    ...
  }
}
```

- **elementのクラス名は一つの要素に対して一つのみ使用し、複数は禁止**

```html
<!-- NG -->
<div class="blockName">
  <div class="blockName__style1 blockName__style2">
    ...
  </div>
</div>
```

### Modifier

#### blockName__element--modifier

##### 基本事項

- 派生のスタイルを当てる目的の場合は以下のようにmodifierクラス名を使用します。modifierはblockにつけることもできます（例：`.blockName--modifier`）

```html
<div class="blockName">
  <div class="blockName__element blockName__element--modifier">
    ...
  </div>
</div>
```

- modifierのスタイルも**並列で記述**します

```css
.blockName__element {
  ...
}

/* --modifierのスタイルは、__elementよりも詳細度をあげるために下に書くこと */
.blockName__element--modifier {
  ...
}
```

- `isOpen`, `isSelected`など状態をWAI-ARIAで指定できそうなものはそちらを積極的に使います。以下の1ではなく、2を使用します

```html
<!-- 1. modifierで状態を指定（NG） -->
<div class="blockName blockName--isSelected"></div>

<!-- 2. こっちの方がアクセシビリティに優れている（推奨） -->
<div class="blockName" aria-selected="true"></div>
```

```css
/* 1. NG */
.blockName--isSelected {
  ...
}

/* 2. 推奨（この場合&を使うと可読性が悪くなるので使わない方が無難） */
.blockName[aria-selected="true"] {
  ...
}
```

- modifierを複数使用することは可能です

```html
<!-- OK（modifierが複数つくのは問題ない） -->
<div class="blockName">
  <div class="blockName__element blockName__element--modifier1 blockName__element--modifier2">
    ...
  </div>
</div>
```

##### 禁止事項

- modifierを使用するときは`&`は禁止

```css
/* NG */
.blockName__element {
  ...
  &--modifier {
    ...
  }
}
```

- modifierクラス名は派生スタイルを表すので以下のように単体での使用は禁止

```html
<!-- NG -->
<div class="blockName">
  <div class="blockName__element--modifier">
    ...
  </div>
  ...
</div>
```

#### blockName--modifier 時の blockName__element に対してのスタイル

`blockName--modifier`の場合は、以下のようにmodifier時のスタイルはすべてmodifier内に記述します。

```css
.blockName {
  /* modifierでない時のblockName */
}

.blockName--modifier {
  /* modifier時のblockName */

  .blockName__element1 {
    /* modifier時のblockName__element1 */
  }

  .blockName__element2 {
    /* modifier時のblockName__element2 */
  }
}

.blockName__element1 {
  /* modifierでない時のblockName__element1 */
}

.blockName__element2 {
  /* modifierでない時のblockName__element2 */
}
```

### CSSファイル構成

```plaintext
style.css          # メインスタイルシート
assets/
  css/
    base/          # リセット、ベーススタイル
      reset.css
      base.css
    layout/         # レイアウト関連
      header.css
      footer.css
    component/      # コンポーネント
      button.css
      card.css
    utility/        # ユーティリティクラス
      spacing.css
      display.css
```

### 記述例

```css
/* Block: header */
.header {
  background-color: #fff;
  padding: 20px 0;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 100;
}

/* Element: header__inner */
.header__inner {
  display: flex;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Element: header__logo */
.header__logo {
  font-size: 24px;
  font-weight: bold;
}

/* Element: header__nav */
.header__nav {
  display: none;
}

/* Element: header__navList */
.header__navList {
  display: flex;
  list-style: none;
  gap: 24px;
}

/* Element: header__navItem */
.header__navItem {
  ...
}

/* Element: header__navLink */
.header__navLink {
  color: #333;
  text-decoration: none;
  transition: color 0.3s;
}

/* Modifier: header__navLink--active */
.header__navLink--active {
  color: #ff6b6b;
  font-weight: bold;
}

/* Modifier: header--fixed */
.header--fixed {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* WAI-ARIAを使用した状態指定（推奨） */
.header__nav[aria-expanded="true"] {
  display: block;
}
```

### ユーティリティクラスの例

```css
/* utility/spacing.css */
.u-mtSmall {
  margin-top: 16px;
}

.u-mtMedium {
  margin-top: 24px;
}

.u-mtLarge {
  margin-top: 32px;
}

/* utility/display.css */
.u-spDisplayNone {
  display: none;
}

@media (min-width: 768px) {
  .u-spDisplayNone {
    display: block;
  }
}

.u-pcDisplayNone {
  display: block;
}

@media (min-width: 768px) {
  .u-pcDisplayNone {
    display: none;
  }
}
```

## JavaScript

### 基本ルール

- インデントは**スペース2つ**を使用
- 変数名・関数名は**キャメルケース**を使用
- 定数は**大文字のスネークケース**を使用
- クラス名は**パスカルケース**を使用
- エラーハンドリングを必ず実装

### 命名規則

```javascript
// 変数（キャメルケース）
const userName = 'Tanaka';
let itemCount = 0;

// 定数（大文字のスネークケース）
const MAX_ITEMS = 10;
const API_BASE_URL = 'https://api.example.com';

// 関数（キャメルケース）
function getUserData() { }
const handleClick = () => { };

// クラス（パスカルケース）
class MenuController { }

// プライベート変数・関数（アンダースコアで始める）
const _privateVariable = 'private';
function _privateFunction() { }
```

### エラーハンドリング

```javascript
// 非同期処理のエラーハンドリング
async function fetchData() {
  try {
    const response = await fetch('/api/data');
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('データの取得に失敗しました:', error);
    // ユーザーへの通知や代替処理
    return null;
  }
}

// Promiseのエラーハンドリング
fetch('/api/data')
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    // データ処理
  })
  .catch(error => {
    console.error('データの取得に失敗しました:', error);
    // エラー処理
  });
```

### ファイル構成

```plaintext
assets/
  js/
    main.js           # メインスクリプト
    modules/          # モジュール
      menu.js
      slider.js
      form.js
```

## PHP（WordPress）

### 基本ルール

- インデントは**スペース2つ**または**タブ**を使用（チームで統一）
- 関数名は**スネークケース**を使用
- クラス名は**パスカルケース**を使用
- WordPressコーディング規約に準拠

### 命名規則

```php
// 関数（スネークケース）
function get_custom_post_data() { }
function register_custom_post_type() { }

// クラス（パスカルケース）
class Custom_Post_Type { }
class Theme_Setup { }

// 定数（大文字のスネークケース）
define('THEME_VERSION', '1.0.0');
const MAX_POSTS_PER_PAGE = 10;

// 変数（スネークケース）
$post_data = get_post();
$custom_query = new WP_Query();
```

### エラーハンドリング

```php
// ファイル操作のエラーハンドリング
try {
    $file_content = file_get_contents('path/to/file.txt');
    if ($file_content === false) {
        throw new Exception('ファイルの読み込みに失敗しました');
    }
    // ファイル処理
} catch (Exception $e) {
    error_log('エラー: ' . $e->getMessage());
    // エラー処理
}

// データベース操作のエラーハンドリング
$result = wp_insert_post($post_data);
if (is_wp_error($result)) {
    error_log('投稿の作成に失敗しました: ' . $result->get_error_message());
    // エラー処理
}

// 関数の戻り値チェック
$attachment_id = get_post_thumbnail_id($post_id);
if ($attachment_id === false) {
    // エラー処理
}
```

### ファイル構成

```plaintext
functions.php
inc/
  setup.php           # テーマセットアップ
  enqueue.php         # スクリプト・スタイルの読み込み
  custom-post.php     # カスタム投稿タイプ
  template-parts/     # テンプレートパーツ
    header.php
    footer.php
```

## コメント

### HTML

```html
<!-- セクション: ヘッダー -->
<header class="header">
  <!-- ロゴ部分 -->
  <div class="header__logo">...</div>
</header>
```

### CSS

```css
/* ============================================
   ヘッダー
   ============================================ */

/* Block: header */
.header { }

/* Element: header__logo */
.header__logo { }
```

### JavaScript

```javascript
/**
 * メニューの開閉を制御する関数
 * @param {HTMLElement} menuElement - メニュー要素
 * @returns {void}
 */
function toggleMenu(menuElement) {
  // メニューの開閉処理
}
```

### PHP

```php
/**
 * カスタム投稿タイプを登録する関数
 *
 * @return void
 */
function register_custom_post_type() {
  // カスタム投稿タイプの登録処理
}
```

## その他のルール

### ファイル名

- 小文字とハイフンを使用
- 例: `header-nav.css`, `menu-controller.js`, `custom-post-type.php`

### 文字コード

- すべてのファイルは**UTF-8（BOMなし）**で保存

### 改行コード

- **LF（\n）**を使用（Windowsの場合はCRLFでも可、ただしGitで統一）

### ファイルサイズ

- 1つのファイルが大きくなりすぎないよう、適切に分割する
- CSSファイル: 500行程度を目安
- JavaScriptファイル: 300行程度を目安
