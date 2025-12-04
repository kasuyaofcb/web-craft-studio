# 4. HTML/CSS静的コーディング

> **このフェーズで**: デザインカンプをHTML/CSS/JavaScriptで再現します。

## 📌 このフェーズで必要なルール

### BEM命名規則の基本

```css
.blockName              /* ブロック（大枠） */
.blockName__element     /* エレメント（中身） */
.blockName--modifier    /* モディファイア（バリエーション） */
```

### 実例

```html
<div class="header">
  <div class="header__inner">
    <h1 class="header__logo">サイト名</h1>
    <nav class="header__nav">
      <a href="/" class="header__navLink">ホーム</a>
    </nav>
  </div>
</div>
```

```css
.header { }
.header__inner { }
.header__logo { }
.header__nav { }
.header__navLink { }
```

### ポイント

- ✅ **キャメルケース**を使う（`header__navLink`）
- ✅ **入れ子は3階層程度まで**（深すぎるネストは避ける）
- ✅ **1つの要素に1つのクラス**（elementを複数つけない）

### ブロック名の統一ルール

**重要**: 静的サイトフェーズとWordPress化後で**同じルール**を使用します。

**統一ルール**: **ファイル名から自動的に決定**

**原則**: **1ファイル = 1ブロック**
- 1つのファイルには、1つのブロック（セクション）のみを定義します
- ✅ **OK**: `section-fv.scss` には `.sectionFv` ブロックのみ
- ❌ **NG**: `section-fv.scss` に `.sectionFv` と `.sectionServices` の両方を含める


**命名規則**:
- ファイル名: `section-{セクション名}.scss`
- クラス名: `section{セクション名}`（キャメルケース）
- ハイフン（`-`）を削除し、次の単語の最初の文字を大文字にする

**例**:
- `section-fv.scss` → クラス名: `sectionFv`
- `section-services.scss` → クラス名: `sectionServices`
- `section-works.scss` → クラス名: `sectionWorks`
- `section-testimonials.scss` → クラス名: `sectionTestimonials`

**共通コンポーネント（header, footerなど）は例外**:
- 全ページで共通して使用されるコンポーネント（`header`, `footer`, `main`など）は、ファイル名から決定するルールは適用しません

**なぜこのルールが最適なのか**:
1. **統一性**: 静的サイトフェーズとWordPress化後で同じルールを使用
2. **移行が簡単**: WordPress化時にクラス名を変更する必要がない
3. **シンプル**: ファイル名から自動的に決定できる
4. **明確**: どのファイルがどのクラスに対応するかが明確

**注意**: 静的サイトフェーズでは、複数のページで同じセクション名を使う可能性がありますが、各ページは別々のHTMLファイルなので、同じクラス名でも問題ありません（スコープが分かれています）。

## 🔧 作業の流れ

1. **ブランチの作成**（Issueにアサインされたらすぐ）
2. **デザインカンプの確認**
3. **ファイルの作成**（必要な場合）
4. **HTML構造の設計**
5. **SCSS実装**
6. **JavaScript実装**（必要に応じて）
7. **レスポンシブ対応**
8. **動作確認**
9. **コミット・PR作成**

## 📝 ファイルの作成

### ページファイルの作成（下層ページの場合）

1. **ファイルの場所**: プロジェクトのルートディレクトリに作成
   - 例: `about.html`, `service.html`

2. **基本構造のコピー**: `index.html` をコピーして、内容を編集
   ```bash
   cp index.html about.html
   ```

3. **タイトルとクラス名を変更**
   ```html
   <title>会社概要 | Web Craft Studio</title>
   <section class="sectionPageHeader">
   ```

### SCSSファイルの作成（セクション用）

**重要**: 静的サイトフェーズでは、SCSSファイルは`assets/scss/`のルートに配置し、クラス名はファイル名から決定します。

1. **ファイルの場所**: `assets/scss/` ディレクトリに作成（ルートに配置）
   - ファイル名: `section-{セクション名}.scss`
   - 例: `section-fv.scss`, `section-services.scss`
   - **注意**: WordPress化後は`assets/scss/{ページ名}/section-{セクション名}.scss`に移動しますが、クラス名は変わりません

2. **基本構造を記述**
   ```scss
   /**
    * セクション名（静的サイト用）
    * Issue #XX で実装
    *
    * 注意: このファイルは静的サイトフェーズ（HTML）用です
    * WordPress化後は assets/scss/top/section-fv.scss に移動します
    * クラス名は統一ルールに従い、ファイル名から決定: section-fv.scss → sectionFv
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

   .sectionFv__title {
     // タイトルスタイル
   }
   ```

3. **Live Sass Compilerを起動**
   - VS Codeの下部（ステータスバー）に「Watch Sass」ボタンをクリック
   - 「Watching...」と表示されればOK

4. **SCSSファイルを保存**
   - 自動的に `assets/css/section-{名前}.css` が生成される

5. **HTMLファイルにCSSリンクを追加**
   ```html
   <link rel="stylesheet" href="assets/css/section-{名前}.css">
   ```

### 静的サイトフェーズのルールまとめ

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

**クラス名のルール**:
- **ファイル名から決定**: `section-fv.scss` → `sectionFv`
- **共通コンポーネントは例外**: `header`, `footer`, `main` などはファイル名から決定するルールは適用しません

**パーシャルファイルの参照**:
- ルートに配置されているため、`@use 'partials/variables'` のように参照

**WordPress化後の違い**:
- **ファイル構造**: `assets/scss/top/section-fv.scss` のようにページごとにフォルダー分け
- **クラス名**: **同じルール**（`sectionFv`、変更不要）
- **パーシャル参照**: `@use '../partials/variables'` のように相対パスで参照

## 🎨 HTML構造の設計

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
  <link rel="stylesheet" href="assets/css/common.css">
  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="assets/css/footer.css">
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

  <script src="assets/js/common.js"></script>
</body>
</html>
```

## 💻 CSS/SCSS実装

### 基本ルール

- インデントは**スペース2つ**
- BEM命名規則を使う
- **入れ子は3階層程度まで**（深すぎるネストは避ける）

```css
/* ✅ OK: 並列で記述 */
.header { }
.header__logo { }
.header__nav { }

/* ✅ OK: 3階層程度までの入れ子 */
.header {
  padding: 1rem;

  .header__logo {
    font-size: 1.5rem;
  }

  .header__nav {
    display: flex;
  }
}

/* ❌ NG: 深すぎるネスト（4階層以上） */
.header {
  .header__inner {
    .header__logo {
      .header__logoLink {
        color: #333;  /* 深すぎる */
      }
    }
  }
}
```

### `&`（アンパサンド）の使用ルール

**基本方針**: `&`は**疑似要素と擬似クラスのみ**に使用します。

#### 許可される使用例

```scss
// OK: 疑似クラス
.header {
  &:hover {
    color: #666;
  }
}

// OK: 疑似要素
.header {
  &::before {
    content: '';
  }
}
```

#### 禁止される使用例

```scss
// NG: elementのネストに&を使用
.header {
  &__element {
    ...
  }
}
```

## ⚠️ よくある間違い

### ❌ やってはいけないこと

1. **elementを複数つける**
   ```html
   <!-- NG -->
   <div class="header__logo header__nav">...</div>
   ```

2. **modifierを単体で使う**
   ```html
   <!-- NG -->
   <div class="header--fixed">...</div>
   ```

3. **深すぎるネスト（4階層以上）**
   ```css
   /* NG: 深すぎる */
   .header {
     .header__inner {
       .header__logo {
         .header__logoLink {
           color: #333;  /* 4階層以上は避ける */
         }
       }
     }
   }
   ```

### ✅ 正しい書き方

1. **elementは1つだけ**
   ```html
   <!-- OK -->
   <div class="header__logo">...</div>
   ```

2. **modifierはelementと一緒に**
   ```html
   <!-- OK -->
   <div class="header header--fixed">...</div>
   ```

3. **入れ子は3階層程度まで**
   ```css
   /* OK: 並列で記述 */
   .header { }
   .header__logo { }

   /* OK: 3階層程度までの入れ子 */
   .header {
     padding: 1rem;

     .header__logo {
       font-size: 1.5rem;
     }
   }
   ```

## 🎯 ユーティリティクラス（u-で始める）

ページをまたいで使う単一のクラスは`u-`をつける

```html
<div class="header u-spDisplayNone">
  <h1 class="u-heading1">見出し</h1>
</div>
```

```css
.u-spDisplayNone {
  display: none;
}

@media (min-width: 768px) {
  .u-spDisplayNone {
    display: block;
  }
}
```

## 📚 もっと詳しく知りたい場合

- [コーディング規約（詳細版）](coding-standards.md) - すべてのルール
- [よくある質問・トラブルシューティング](faq-troubleshooting.md) - 困ったときはここ

## ➡️ 次に読むべきもの

- **[WordPress化](05-wordpress.md)** - 模写コーディング完了後、WordPress化に進みましょう

---

**最終更新**: 2025/12/4
