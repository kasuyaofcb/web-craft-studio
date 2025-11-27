# クイックスタートガイド

> **初学者向け**: 最初に覚えるべき最小限のルール集です。
> 詳細なルールは必要になったら [コーディング規約（詳細版）](coding-standards.md) を参照してください。

## 📌 このガイドの使い方

1. **まずこのガイドを読む**（10分程度）
2. **実際にコーディングしながら参照**
3. **困ったら詳細版を確認**

---

## 🎨 BEM命名規則（基本の3つだけ）

### 基本形

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
- ✅ **並列で記述**する（入れ子にしない）
- ✅ **1つの要素に1つのクラス**（elementを複数つけない）

---

## 🔧 Git基本操作（これだけ覚えればOK）

### 1. ブランチを作成して作業開始

```bash
git checkout main
git pull origin main
git checkout -b issue-12-fv-hero
```

### 2. 変更をコミット

```bash
git add .
git commit -m "feat: ヘッダー部分の実装"
```

### 3. プッシュしてPR作成

```bash
git push origin issue-12-fv-hero
```

その後、GitHubでプルリクエストを作成

### ブランチ名のルール

- `issue-[Issue番号]-[概要]` に統一（例: `issue-12-fv-hero`）

---

## 📝 コミットメッセージ（基本形）

```
feat: ヘッダー部分の実装
```

### よく使う種類

- `feat:` - 新機能
- `fix:` - バグ修正
- `style:` - スタイルの変更

---

## 💻 コーディング基本ルール

### HTML

- インデントは**スペース2つ**
- セマンティックなタグを使う（`<header>`, `<nav>`, `<main>`など）

### CSS

- インデントは**スペース2つ**
- BEM命名規則を使う
- **並列で記述**（入れ子にしない）

```css
/* ✅ OK */
.header { }
.header__logo { }
.header__nav { }

/* ❌ NG（入れ子にしない） */
.header {
  .header__logo { }
}
```

### JavaScript

- エラーハンドリングを必ず書く

```javascript
try {
  // 処理
} catch (error) {
  console.error('エラー:', error);
}
```

### PHP

- エラーハンドリングを必ず書く

```php
$result = wp_insert_post($post_data);
if (is_wp_error($result)) {
  error_log('エラー: ' . $result->get_error_message());
}
```

---

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

---

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

3. **CSSを入れ子で書く**
   ```css
   /* NG */
   .header {
     .header__logo { }
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

3. **CSSは並列で書く**
   ```css
   /* OK */
   .header { }
   .header__logo { }
   ```

---

## 📚 もっと詳しく知りたい場合

- [コーディング規約（詳細版）](coding-standards.md) - すべてのルール
- [Git運用ルール（詳細版）](git-workflow.md) - Gitの詳細な使い方
- [模写コーディング ステップ別指示書](instructions/markup-guide.md) - 実装手順
- [WordPress化 ステップ別指示書](instructions/wordpress-guide.md) - WordPress化手順

---

## 🆘 困ったときは

1. このガイドを再確認
2. 詳細版のドキュメントを参照
3. メンターに質問

**無理に全部覚えようとしなくてOK！**
作業しながら少しずつ覚えていきましょう。

---

## ➡️ 次に読むべきもの

- **模写コーディングフェーズ**: [模写コーディング ステップ別指示書](instructions/markup-guide.md)
- **WordPress化フェーズ**: [WordPress化 ステップ別指示書](instructions/wordpress-guide.md)
- **全体の流れ**: [ドキュメント一覧](README.md)
