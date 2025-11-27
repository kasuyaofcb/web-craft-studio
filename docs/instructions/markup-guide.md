# 模写コーディング ステップ別指示書

## 概要

このドキュメントは、デザインカンプをHTML/CSS/JavaScriptで再現するための手順を説明します。

## 📌 このフェーズで必要なルール

**まず読む**: [クイックスタートガイド](../../quick-start.md)

### このフェーズで覚えるべきこと

1. **BEM命名規則の基本**
   - `.blockName`, `.blockName__element`, `.blockName--modifier`
   - キャメルケースを使う
   - 並列で記述（入れ子にしない）

2. **HTMLの基本**
   - インデントはスペース2つ
   - セマンティックなタグを使う

3. **CSSの基本**
   - 並列で記述する
   - 1つの要素に1つのクラス

4. **JavaScriptの基本**
   - エラーハンドリングを必ず書く

詳細は必要になったら [コーディング規約（詳細版）](../../coding-standards.md) を参照してください。

## 作業の流れ

1. デザインカンプの確認
2. HTML構造の設計
3. CSS実装
4. JavaScript実装（必要に応じて）
5. レスポンシブ対応
6. 動作確認

---

## 1. デザインカンプの確認

### 確認事項

- [ ] デザインカンプの全体像を把握
- [ ] 使用されている色、フォント、余白を確認
- [ ] ブレークポイント（PC/タブレット/スマホ）を確認
- [ ] インタラクティブな要素（ホバー、クリックなど）を確認
- [ ] 使用する画像・アイコンの種類とサイズを確認

### チェックリスト

```
□ カラーパレット
  - メインカラー:
  - サブカラー:
  - テキストカラー:
  - 背景色:

□ タイポグラフィ
  - フォントファミリー:
  - フォントサイズ（PC/SP）:
  - 行間:

□ ブレークポイント
  - PC:
  - タブレット:
  - スマホ:

□ 余白・サイズ
  - コンテナ最大幅:
  - セクション間の余白:
```

---

## 2. HTML構造の設計

### 基本方針

1. **セマンティックなHTML5タグを使用**
   - `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<aside>`, `<footer>`など

2. **BEM命名規則に従う**
   - Block: `.header`, `.footer`, `.card`
   - Element: `.header__logo`, `.card__title`
   - Modifier: `.header--fixed`, `.card--highlight`

3. **構造を階層的に記述**
   - 親要素から子要素へ順に記述
   - インデントで階層を明確に

### 実装手順

#### ステップ1: 全体構造の作成

```html
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>サイト名</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <header class="header">
    <!-- ヘッダー内容 -->
  </header>

  <main class="main">
    <!-- メインコンテンツ -->
  </main>

  <footer class="footer">
    <!-- フッター内容 -->
  </footer>

  <script src="assets/js/main.js"></script>
</body>
</html>
```

#### ステップ2: セクションごとに実装

各セクションを順番に実装していきます。

**例: ヘッダー部分**

```html
<header class="header">
  <div class="header__inner">
    <h1 class="header__logo">
      <a href="/" class="header__logo-link">サイト名</a>
    </h1>
    <nav class="header__nav">
      <ul class="header__nav-list">
        <li class="header__nav-item">
          <a href="/about" class="header__nav-link">About</a>
        </li>
        <li class="header__nav-item">
          <a href="/works" class="header__nav-link">Works</a>
        </li>
        <li class="header__nav-item">
          <a href="/contact" class="header__nav-link">Contact</a>
        </li>
      </ul>
    </nav>
    <button class="header__menu-toggle" aria-label="メニューを開く">
      <span class="header__menu-toggle-line"></span>
    </button>
  </div>
</header>
```

### 注意点

- アクセシビリティを考慮（`aria-label`、適切な見出し階層など）
- 画像には必ず`alt`属性を記述
- リンクには適切なテキストを記述

---

## 3. CSS実装

### 基本方針

1. **モバイルファースト**で実装
2. **BEM命名規則**に従う
3. **変数（CSSカスタムプロパティ）**を活用
4. **コンポーネント単位**でファイルを分割

### 実装手順

#### ステップ1: 変数の定義

```css
/* カラー */
:root {
  --color-primary: #333;
  --color-secondary: #666;
  --color-accent: #ff6b6b;
  --color-bg: #fff;
  --color-text: #333;
}

/* タイポグラフィ */
:root {
  --font-family-base: 'Noto Sans JP', sans-serif;
  --font-size-base: 16px;
  --line-height-base: 1.6;
}

/* ブレークポイント */
:root {
  --breakpoint-sm: 576px;
  --breakpoint-md: 768px;
  --breakpoint-lg: 992px;
  --breakpoint-xl: 1200px;
}

/* スペーシング */
:root {
  --spacing-xs: 8px;
  --spacing-sm: 16px;
  --spacing-md: 24px;
  --spacing-lg: 32px;
  --spacing-xl: 48px;
}
```

#### ステップ2: リセット・ベーススタイル

```css
/* リセット */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* ベーススタイル */
body {
  font-family: var(--font-family-base);
  font-size: var(--font-size-base);
  line-height: var(--line-height-base);
  color: var(--color-text);
  background-color: var(--color-bg);
}
```

#### ステップ3: コンポーネントごとに実装

**例: ヘッダー**

```css
/* Block: header */
.header {
  background-color: var(--color-bg);
  padding: var(--spacing-sm) 0;
  position: sticky;
  top: 0;
  z-index: 100;
}

/* Element: header__inner */
.header__inner {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 var(--spacing-sm);
}

/* Element: header__logo */
.header__logo {
  font-size: 24px;
  font-weight: bold;
}

.header__logo-link {
  color: var(--color-text);
  text-decoration: none;
}

/* Element: header__nav */
.header__nav {
  display: none; /* モバイルでは非表示 */
}

/* Element: header__nav-list */
.header__nav-list {
  display: flex;
  list-style: none;
  gap: var(--spacing-md);
}

/* Element: header__nav-link */
.header__nav-link {
  color: var(--color-text);
  text-decoration: none;
  transition: color 0.3s;
}

.header__nav-link:hover {
  color: var(--color-accent);
}

/* タブレット以上で表示 */
@media (min-width: 768px) {
  .header__nav {
    display: block;
  }

  .header__menu-toggle {
    display: none;
  }
}
```

### レスポンシブ対応

```css
/* モバイルファースト */
.component {
  /* モバイル用スタイル */
}

/* タブレット */
@media (min-width: 768px) {
  .component {
    /* タブレット用スタイル */
  }
}

/* PC */
@media (min-width: 1024px) {
  .component {
    /* PC用スタイル */
  }
}
```

---

## 4. JavaScript実装

### 基本方針

1. **エラーハンドリングを必ず実装**
2. **DOMContentLoaded後に実行**
3. **モジュール化して記述**
4. **コメントを適切に記述**

### 実装手順

#### ステップ1: 基本構造

```javascript
// DOMContentLoaded後に実行
document.addEventListener('DOMContentLoaded', () => {
  try {
    // 初期化処理
    init();
  } catch (error) {
    console.error('初期化エラー:', error);
  }
});

function init() {
  // 各機能の初期化
  initMenu();
  initSlider();
  // ...
}
```

#### ステップ2: 機能ごとに実装

**例: メニューの開閉**

```javascript
/**
 * メニューの開閉を制御
 */
function initMenu() {
  const menuToggle = document.querySelector('.header__menu-toggle');
  const nav = document.querySelector('.header__nav');

  if (!menuToggle || !nav) {
    console.warn('メニュー要素が見つかりません');
    return;
  }

  menuToggle.addEventListener('click', () => {
    try {
      nav.classList.toggle('header__nav--open');
      menuToggle.classList.toggle('header__menu-toggle--active');

      // アクセシビリティ: aria-expanded属性を更新
      const isOpen = nav.classList.contains('header__nav--open');
      menuToggle.setAttribute('aria-expanded', isOpen);
    } catch (error) {
      console.error('メニューの開閉エラー:', error);
    }
  });
}
```

### エラーハンドリングの例

```javascript
/**
 * データを取得する関数
 */
async function fetchData(url) {
  try {
    const response = await fetch(url);

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('データの取得に失敗しました:', error);
    // ユーザーへの通知や代替処理
    showErrorMessage('データの読み込みに失敗しました');
    return null;
  }
}
```

---

## 5. 動作確認

### 確認項目

- [ ] デザインカンプ通りに表示されている
- [ ] レスポンシブ対応が正しく動作している
- [ ] インタラクティブな要素が正しく動作している
- [ ] ブラウザ互換性（Chrome, Firefox, Safari, Edge）
- [ ] アクセシビリティ（キーボード操作、スクリーンリーダー）
- [ ] パフォーマンス（画像最適化、CSS/JSの最適化）

### テスト手順

1. **ビジュアル確認**
   - デザインカンプと比較
   - 各ブレークポイントで確認

2. **機能確認**
   - リンクの動作
   - フォームの動作
   - JavaScriptの動作

3. **ブラウザ確認**
   - Chrome
   - Firefox
   - Safari
   - Edge

4. **デバイス確認**
   - スマートフォン
   - タブレット
   - PC

---

## よくある質問・トラブルシューティング

### Q: デザインカンプと微妙に違う

A: 以下を確認してください
- フォントサイズ、行間の設定
- 余白（margin, padding）の値
- カラーの値（RGB値の確認）
- ブラウザのデフォルトスタイルのリセット

### Q: レスポンシブがうまくいかない

A: 以下を確認してください
- viewportの設定（`<meta name="viewport">`）
- メディアクエリのブレークポイント
- モバイルファーストの実装順序

### Q: JavaScriptが動作しない

A: 以下を確認してください
- DOMContentLoadedの使用
- 要素の存在確認
- エラーハンドリングの実装
- コンソールエラーの確認

---

## 参考資料

- [MDN Web Docs](https://developer.mozilla.org/ja/)
- [BEM公式サイト](https://en.bem.info/)
- [Can I use](https://caniuse.com/) - ブラウザ互換性確認

---

## ➡️ 次に読むべきもの

- **模写コーディング完了後**: [フェーズ別チェックリスト](../checklists/phase-checklist.md) - 模写コーディングセクションを確認
- **WordPress化フェーズ**: [WordPress化 ステップ別指示書](wordpress-guide.md)
- **全体の流れ**: [ドキュメント一覧](../README.md)
