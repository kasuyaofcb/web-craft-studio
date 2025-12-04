# コーディング規約・命名規則（詳細版）

> このドキュメントは、コーディング規約の詳細な説明です。
> 各フェーズのドキュメント（[HTML/CSS静的コーディング](04-markup.md)、[WordPress化](05-wordpress.md)）にも、そのフェーズで必要なルールが記載されています。

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
- **block名はファイル名から自動的に決定**（統一ルール）
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

#### ブロック名の統一ルール

**重要**: 静的サイトフェーズとWordPress化後で**同じルール**を使用します。

**統一ルール**: **ファイル名から自動的に決定**

> **📌 詳細は**: [HTML/CSS静的コーディング](04-markup.md) と [WordPress化](05-wordpress.md) の各ドキュメントを参照してください。

**原則**: **1ファイル = 1ブロック**
- 1つのファイルには、1つのブロック（セクション）のみを定義します
- ✅ **OK**: `section-fv.scss` には `.sectionFv` ブロックのみ
- ❌ **NG**: `section-fv.scss` に `.sectionFv` と `.sectionServices` の両方を含める

**命名規則**:
- ファイル名: `section-{セクション名}.scss` または `section-{セクション名}.php`
- ブロック名（クラス名）: `section{セクション名}`（キャメルケース）
- ハイフン（`-`）を削除し、次の単語の最初の文字を大文字にする

**例**:
- `section-fv.scss` → ブロック名: `sectionFv`
- `section-services.scss` → ブロック名: `sectionServices`
- `section-works.scss` → ブロック名: `sectionWorks`
- `section-testimonials.scss` → ブロック名: `sectionTestimonials`

**共通コンポーネント（header, footerなど）は例外**:
- 全ページで共通して使用されるコンポーネント（`header`, `footer`, `main`など）は、ファイル名から決定するルールは適用しません
- ただし、**1ファイル = 1ブロック**の原則は同じです

#### 静的サイトフェーズ（HTML）の実装

**ファイル構造**:
```
assets/scss/
├── common.scss          # 共通スタイル
├── header.scss          # ヘッダー（共通）
├── footer.scss          # フッター（共通）
├── section-fv.scss      # セクション用（ルートに配置）
├── section-services.scss
└── partials/            # パーシャルファイル
    ├── _variables.scss
    └── ...
```

**実装例**:

```html
<!-- index.html -->
<section class="sectionFv">
  <!-- ファーストビュー -->
</section>

<section class="sectionServices">
  <!-- サービス紹介 -->
</section>
```

```scss
/* assets/scss/section-fv.scss（静的サイトフェーズ） */
@use 'partials/variables';
@use 'partials/reset';
@use 'partials/base';
@use 'partials/utilities';
@use 'partials/layout';

/* ファイル名から決定: section-fv.scss → sectionFv */
/* 1ファイル = 1ブロックの原則: このファイルには .sectionFv ブロックのみ */
.sectionFv {
  ...
}

.sectionFv__title {
  ...
}
```

#### WordPress化後の実装

**ファイル構造**:
```
assets/scss/
├── common.scss          # 共通スタイル
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

**実装例**:

```php
<!-- template-parts/top/section-fv.php -->
<section class="sectionFv">
  <div class="u-container">
    <!-- セクション内容 -->
  </div>
</section>
```

```scss
/* assets/scss/top/section-fv.scss（WordPress化後） */
@use '../partials/variables';
@use '../partials/reset';
@use '../partials/base';
@use '../partials/utilities';
@use '../partials/layout';

/* ファイル名から決定: section-fv.scss → sectionFv */
/* 1ファイル = 1ブロックの原則: このファイルには .sectionFv ブロックのみ */
.sectionFv {
  ...
}

.sectionFv__title {
  ...
}
```

#### なぜこのルールが最適なのか

1. **統一性**: 静的サイトフェーズとWordPress化後で同じルールを使用
2. **移行が簡単**: WordPress化時にクラス名を変更する必要がない
3. **シンプル**: ファイル名から自動的に決定できる
4. **明確**: どのファイルがどのクラスに対応するかが明確

**注意**: 静的サイトフェーズでは、複数のページで同じセクション名を使う可能性がありますが、各ページは別々のHTMLファイルなので、同じクラス名でも問題ありません（スコープが分かれています）。

### Element

#### 基本事項

- elementのスタイルは**並列で記述することを推奨**しますが、**入れ子も3階層程度まで許可**します

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

    /* .blockNameのスタイル */
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
  }
}
```

**注意**: `@at-root`内でも`&`の使用は避け、明示的にクラス名を記述します（`&`の使用ルールに準拠）。

#### ネストのルール

- **入れ子は3階層程度まで**（4階層以上の深いネストは避ける）
- 並列で記述する方が読みやすい場合が多い

```css
/* 推奨: 並列で記述 */
.blockName {
  padding: 1rem;
}

.blockName__element1 {
  font-size: 1.5rem;
}

.blockName__element2 {
  color: #333;
}

.blockName__element3 {
  margin-top: 1rem;
}

/* OK: 3階層程度までの入れ子 */
.blockName {
  padding: 1rem;

  .blockName__element1 {
    font-size: 1.5rem;

    &:hover {
      color: #666;  // 疑似クラスはOK
    }
  }
}

/* NG: 深すぎるネスト（4階層以上） */
.blockName {
  .blockName__inner {
    .blockName__element1 {
      .blockName__elementLink {
        color: #333;  // 深すぎる
      }
    }
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

- modifierのスタイルも**並列で記述することを推奨**しますが、**入れ子も3階層程度まで許可**します

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

- modifierを使用するときは`&`は禁止（詳細は「`&`（アンパサンド）の使用ルール」を参照）

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

### SCSS

#### 基本ルール

- インデントは**スペース2つ**を使用
- **`@use`**を使用してパーシャルファイルをインポート（`@import`は非推奨）
- パーシャルファイルは `assets/scss/partials/` ディレクトリに配置
- パーシャルファイル名は `_` で始める（例: `_reset.scss`）

### ファイル構造

#### 静的サイトフェーズ（HTML）

```
assets/
├── scss/
│   ├── common.scss          // 共通スタイル（エントリーポイント）
│   ├── header.scss          // ヘッダー
│   ├── footer.scss          // フッター
│   ├── section-{名前}.scss  // セクション用（各Issueで作成）
│   └── partials/            // パーシャルファイル
│       ├── _variables.scss   // 変数定義（カラー、ブレークポイントなど）
│       ├── _reset.scss      // リセットCSS
│       ├── _base.scss       // ベーススタイル
│       ├── _utilities.scss  // ユーティリティクラス
│       └── _layout.scss     // 共通レイアウト
└── css/                     // コンパイル後のCSS（自動生成）
    ├── common.css
    ├── header.css
    ├── footer.css
    └── section-{名前}.css
```

#### WordPress化後

```
assets/
├── scss/
│   ├── common.scss          // 共通スタイル（エントリーポイント）
│   ├── common/              // 全ページ共通パーツ
│   │   ├── header.scss
│   │   └── footer.scss
│   ├── top/                 // TOPページ専用
│   │   ├── section-fv.scss
│   │   ├── section-services.scss
│   │   └── ...
│   ├── about/               // Aboutページ専用
│   │   └── section-page-header.scss
│   └── partials/            // パーシャルファイル
│       ├── _variables.scss
│       ├── _reset.scss
│       ├── _base.scss
│       ├── _utilities.scss
│       └── _layout.scss
└── css/                     // コンパイル後のCSS（自動生成）
    ├── common.css
    ├── common/
    │   ├── header.css
    │   └── footer.css
    └── top/
        ├── section-fv.css
        └── ...
```

### パーシャルのインポート

セクション用SCSSファイルでは、以下のようにパーシャルをインポートします：

#### 静的サイトフェーズ（ルートに配置）

```scss
/**
 * セクション名
 * Issue #XX で実装
 */

@use 'partials/variables';
@use 'partials/reset';
@use 'partials/base';
@use 'partials/utilities';
@use 'partials/layout';

/* ファイル名から決定: section-fv.scss → sectionFv */
.sectionFv {
  // スタイルを記述
  // 変数を使用する例: color: variables.$color-primary;
}
```

#### WordPress化後（サブディレクトリに配置）

```scss
/**
 * セクション名
 * Issue #XX で実装
 */

@use '../partials/variables';
@use '../partials/reset';
@use '../partials/base';
@use '../partials/utilities';
@use '../partials/layout';

/* ファイル名から決定: section-fv.scss → sectionFv */
.sectionFv {
  // スタイルを記述
  // 変数を使用する例: color: variables.$color-primary;
}
```

### Live Sass Compiler設定

VS Codeの拡張機能「Live Sass Compiler」を使用してください。

**設定ファイル**: `.vscode/settings.json`（プロジェクトに含まれています）

**コンパイル先**: `assets/css/`（自動）

**注意事項**:
- SCSSファイルを保存すると自動的にCSSファイルが生成されます
- CSSファイルは直接編集しないでください（SCSSファイルを編集してください）

### ネストのルール

- ネストは**3階層程度まで**を推奨（可読性のため）
- 4階層以上の深いネストは避ける

```scss
// OK: 並列で記述
.blockName {
  ...
}

.blockName__element {
  ...
}

.blockName__element--modifier {
  ...
}

// OK: 3階層程度までの入れ子
.blockName {
  padding: 1rem;

  .blockName__element {
    font-size: 1.5rem;

    &:hover {
      color: #333;  // 疑似クラスはOK
    }
  }
}

// NG: 深すぎるネスト（4階層以上）
.blockName {
  .blockName__inner {
    .blockName__element {
      .blockName__elementLink {
        color: #333;  // 深すぎる
      }
    }
  }
}
```

### `&`（アンパサンド）の使用ルール

**基本方針**: `&`は**疑似要素と擬似クラスのみ**に使用します。BEMのelementやmodifierのネストには使用しません。

#### 許可される使用例（疑似要素・擬似クラス）

```scss
// OK: 疑似クラス
.blockName {
  color: #333;

  &:hover {
    color: #666;
  }

  &:focus {
    outline: 2px solid #000;
  }

  &:active {
    opacity: 0.8;
  }
}

// OK: 疑似要素
.blockName {
  position: relative;

  &::before {
    content: '';
    position: absolute;
  }

  &::after {
    content: '';
    position: absolute;
  }
}

// OK: メディアクエリ内での使用
.blockName {
  font-size: 16px;

  @media (min-width: 768px) {
    font-size: 18px;
  }
}
```

#### 禁止される使用例（BEMのネスト）

```scss
// NG: elementのネストに&を使用
.blockName {
  &__element {
    ...
  }
}

// NG: modifierのネストに&を使用
.blockName__element {
  &--modifier {
    ...
  }
}

// NG: 複数階層のネストに&を使用
.blockName {
  &__element {
    &--modifier {
      ...
    }
  }
}
```

**理由**: BEMのelementやmodifierを`&`でネストすると、可読性が低下し、クラス名の構造が分かりにくくなります。並列で記述することで、クラス名の全体像が把握しやすくなります。

### 変数とミックスイン

- **変数は `assets/scss/partials/_variables.scss` に定義**（テンプレートに含まれています）
- ミックスインは `assets/scss/partials/_mixins.scss` に定義（必要に応じて作成）

**変数の使用例**:

```scss
// _variables.scss に定義済みの変数を使用
@use 'partials/variables';

.blockName {
  color: variables.$color-primary;
  font-size: variables.$font-size-base;
  margin-bottom: variables.$spacing-md;

  @media (min-width: variables.$breakpoint-md) {
    font-size: variables.$font-size-lg;
  }
}
```

**定義済みの変数**:
- カラーパレット: `variables.$color-primary`, `variables.$color-text`, `variables.$color-bg` など
- ブレークポイント: `variables.$breakpoint-sm`, `variables.$breakpoint-md`, `variables.$breakpoint-lg` など
- フォントサイズ: `variables.$font-size-base`, `variables.$font-size-lg` など
- スペーシング: `variables.$spacing-sm`, `variables.$spacing-md`, `variables.$spacing-lg` など

詳細は `assets/scss/partials/_variables.scss` を参照してください。

**ミックスインの例**（必要に応じて作成）:

```scss
// _mixins.scss
@mixin responsive($breakpoint) {
  @media (min-width: $breakpoint) {
    @content;
  }
}

// 使用例
.blockName {
  @include responsive(variables.$breakpoint-md) {
    font-size: 1.8rem;
  }
}
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
- **CSS/JSの読み込みは`wp_enqueue_style()`/`wp_enqueue_script()`を使用**（`<link>`タグは使用しない）

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
template-parts/       # テンプレートパーツ（すべてのセクションはここに）
  header.php          # ヘッダー（共通）
  footer.php          # フッター（共通）
  section-fv.php      # TOP: ファーストビュー
  section-services.php # TOP: サービス紹介
  ...（その他のセクション）
inc/
  setup.php           # テーマセットアップ
  enqueue.php         # スクリプト・スタイルの読み込み
  custom-post.php     # カスタム投稿タイプ
```

### テンプレートパーツの命名規則

**ページごとにフォルダーを分ける構造**:

- セクション1つ = ファイル1つ
- 命名規則: `section-{セクション名}.php`
- **ページごとにフォルダーを分ける**（`template-parts/{ページ名}/`）
- **全ページ共通パーツは `template-parts/common/` に配置**

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
├── about/               # Aboutページ専用
│   └── section-page-header.php
└── contact/             # Contactページ専用
    └── section-form.php
```

**呼び出し方**:
```php
<?php
// TOPページのセクション
get_template_part('template-parts/top/section-fv');

// 共通パーツ
get_template_part('template-parts/common/header');
?>
```

#### テンプレートパーツのクラス名ルール

**重要**: テンプレートパーツのクラス名は、**ファイル名から自動的に決定**されます（静的サイトフェーズと同じルール）。

**命名規則**:
- ファイル名: `section-{セクション名}.php`
- クラス名: `section{セクション名}`（キャメルケース）
- ハイフン（`-`）を削除し、次の単語の最初の文字を大文字にする

**例**:
- `section-fv.php` → クラス名: `sectionFv`
- `section-services.php` → クラス名: `sectionServices`
- `section-works.php` → クラス名: `sectionWorks`
- `section-testimonials.php` → クラス名: `sectionTestimonials`

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

```scss
/* assets/scss/top/section-fv.scss */
@use '../partials/variables';
@use '../partials/reset';
@use '../partials/base';
@use '../partials/utilities';
@use '../partials/layout';

/* ファイル名から決定: section-fv.scss → sectionFv */
.sectionFv {
  ...
}

.sectionFv__title {
  ...
}
```

### SCSSファイルの構造（WordPress化後）

**重要**: WordPress化後は、SCSSファイルもPHPテンプレートパーツと同じ構造に合わせます。

**静的サイトフェーズとの違い**:
- **静的サイトフェーズ**: `assets/scss/section-fv.scss`（ルートに配置）、クラス名は`sectionFv`（ファイル名から決定）
- **WordPress化後**: `assets/scss/top/section-fv.scss`（ページごとにフォルダー分け）、クラス名は`sectionFv`（ファイル名から決定、**同じルール**）

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
├── about/               # Aboutページ専用
│   └── section-page-header.scss
└── partials/            # パーシャルファイル
    ├── _variables.scss
    └── ...
```

**パーシャルファイルの参照**:
- サブディレクトリ内のSCSSファイルからパーシャルを参照する場合は、相対パスで `../partials/` を使用
- 例：`assets/scss/top/section-fv.scss` から `assets/scss/partials/variables.scss` を参照する場合
  ```scss
  @use '../partials/variables';
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

## ➡️ 次に読むべきもの

- **[HTML/CSS静的コーディング](04-markup.md)** - コーディング規約を理解したら、模写コーディングフェーズに進みましょう

---

**最終更新**: 2025/12/4
