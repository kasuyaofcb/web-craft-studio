# よくある質問・トラブルシューティング

初学者が戸惑いやすい点と、その解決方法をまとめています。

## 📋 目次

- [Live Sass Compilerの使い方](#live-sass-compilerの使い方)
- [ファイルの作成と編集](#ファイルの作成と編集)
- [Git操作](#git操作)
- [コンフリクトの解決](#コンフリクトの解決)
- [その他のトラブル](#その他のトラブル)

---

## Live Sass Compilerの使い方

### Q1: Live Sass Compilerがインストールされていない

**解決方法**:

1. VS Codeを開く
2. 拡張機能タブ（左側のアイコン）をクリック
3. 「Live Sass Compiler」で検索
4. 「Live Sass Compiler」をインストール（作者: Glenn Marks）

### Q2: SCSSファイルを保存してもCSSファイルが生成されない

**確認事項**:

1. **Watch Sassボタンをクリックしているか**
   - VS Codeの下部（ステータスバー）に「Watch Sass」ボタンがある
   - クリックして「Watching...」と表示されればOK
   - 「Watch Sass」と表示されている場合は、クリックして開始

2. **SCSSファイルが正しい場所にあるか**
   - `assets/scss/` ディレクトリ内にあるか確認
   - パーシャルファイル（`partials/`内）はコンパイルされません（正常）

3. **設定ファイルが正しいか**
   - `.vscode/settings.json` が存在するか確認
   - プロジェクトルートに `.vscode/` ディレクトリがあるか確認

**解決方法**:

1. VS Codeを再起動
2. 「Watch Sass」ボタンをクリック
3. SCSSファイルを保存してみる

### Q3: CSSファイルがどこに生成されるかわからない

**答え**: `assets/css/` ディレクトリに自動生成されます。

- `assets/scss/common.scss` → `assets/css/common.css`
- `assets/scss/section-fv.scss` → `assets/css/section-fv.css`

**確認方法**:

1. VS Codeのエクスプローラーで `assets/css/` を確認
2. SCSSファイルを保存すると、同じファイル名で `.css` 拡張子のファイルが生成される

### Q4: CSSファイルを直接編集してしまった

**解決方法**:

1. **CSSファイルの変更を元に戻す**
   - Gitを使っている場合: `git checkout assets/css/ファイル名.css`
   - 手動で削除して、SCSSファイルを保存し直す

2. **今後はSCSSファイルのみ編集**
   - CSSファイルは自動生成されるため、編集しない
   - SCSSファイルを編集すると、自動的にCSSファイルが更新される

---

## ファイルの作成と編集

### Q5: ページファイル（HTML）をどこに作成すればいいか

**答え**: **プロジェクトのルートディレクトリ**に作成します。

**例**:
- `about.html` → プロジェクトルートに作成
- `service.html` → プロジェクトルートに作成

**基本構造のコピー元**:
- `index.html` をコピーして、内容を編集してください

### Q6: セクション用SCSSファイルをどこに作成すればいいか

**答え**: `assets/scss/` ディレクトリに作成します。

**ファイル名の規則**:
- `section-{セクション名}.scss`
- 例: `section-fv.scss`, `section-services.scss`

**基本構造**:

```scss
/**
 * セクション名
 * Issue #XX で実装
 */

@use 'partials/reset';
@use 'partials/base';
@use 'partials/utilities';
@use 'partials/layout';

.{セクションクラス名} {
  // スタイルを記述
}
```

### Q7: HTMLファイルにCSSリンクを追加する方法

**答え**: `<head>` タグ内に `<link>` タグを追加します。

**例**:

```html
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Craft Studio</title>
  <link rel="stylesheet" href="assets/css/common.css">
  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <!-- セクション用CSSを追加 -->
  <link rel="stylesheet" href="assets/css/section-fv.css">
</head>
```

**注意**:
- CSSファイルのパスは `assets/css/` から始まる
- SCSSファイルではなく、**コンパイル後のCSSファイル**を指定する

### Q8: どのファイルを編集していいかわからない

**編集していいファイル**:

- ✅ `index.html`（TOPページ）
- ✅ 自分が作成したページファイル（`about.html`など）
- ✅ 自分が作成したSCSSファイル（`section-{名前}.scss`）
- ✅ 自分が担当するセクションのHTML部分

**編集してはいけないファイル**:

- ❌ `assets/scss/partials/` 内のファイル（共通パーシャル）
- ❌ `assets/css/` 内のCSSファイル（自動生成されるため）
- ❌ 他の人が担当しているファイル
- ❌ `.vscode/settings.json`（設定ファイル）

**例外**:

- `assets/scss/common.scss`, `header.scss`, `footer.scss` は、担当者が編集可能
- ただし、他の人と相談してから編集すること

---

## Git操作

### Q9: ブランチをいつ作成すればいいか

**答え**: **Issueにアサインされたら、すぐにブランチを作成**します。

**手順**:

1. 最新の `main` ブランチを取得
   ```bash
   git checkout main
   git pull origin main
   ```

2. 新しいブランチを作成
   ```bash
   git checkout -b issue-[Issue番号]-[概要]
   ```
   例: `git checkout -b issue-12-fv-hero`

3. 作業を開始

### Q10: コミットはいつすればいいか

**答え**: **機能単位でコミット**します。

**良い例**:
- 「HTML構造の実装」→ コミット
- 「基本スタイルの実装」→ コミット
- 「レスポンシブ対応」→ コミット

**悪い例**:
- 1日の作業を全部まとめて1回だけコミット（NG）
- ファイルを1つ保存するたびにコミット（NG）

**目安**: 1つの作業が完了したらコミット（1日2〜5回程度）

### Q11: PRはいつ作成すればいいか

**答え**: **Issueの作業が完了したら、すぐにPRを作成**します。

**完了の目安**:
- [ ] HTML構造が完成
- [ ] スタイルが適用されている
- [ ] レスポンシブ対応が完了
- [ ] 自己レビューが完了
- [ ] 動作確認が完了

**PR作成前の確認**:
- [ ] コミットメッセージが適切か
- [ ] 不要なファイルがコミットされていないか（`node_modules/`, `.DS_Store`など）
- [ ] 関連Issueがリンクされているか

---

## コンフリクトの解決

### Q12: マージコンフリクトが起きた

**原因**: 他の人が同じファイルを編集していた

**解決方法**:

1. **最新の `main` ブランチを取得**
   ```bash
   git checkout main
   git pull origin main
   ```

2. **自分のブランチに戻ってマージ**
   ```bash
   git checkout issue-12-fv-hero
   git merge main
   ```

3. **コンフリクトを解決**
   - VS Codeでコンフリクトマーカー（`<<<<<<<`, `=======`, `>>>>>>>`）を探す
   - どちらの変更を残すか判断
   - コンフリクトマーカーを削除

4. **解決をコミット**
   ```bash
   git add .
   git commit -m "fix: mainとのコンフリクトを解決"
   ```

**わからない場合**: メンターに相談してください

---

## WordPress関連

### Q: ループが動作しない

**確認事項**:

1. **`if ( have_posts() )`でチェックしているか**
   ```php
   <?php
   if ( have_posts() ) :  // このチェックが必要
       while ( have_posts() ) :
           the_post();
           // コンテンツ
       endwhile;
   endif;
   ?>
   ```

2. **`the_post()`を呼び出しているか**
   - `while ( have_posts() )`の後に必ず`the_post()`を呼び出す

### Q: エスケープ処理が必要かわからない

**ルール**:
- `the_*()`系の関数（`the_title()`, `the_content()`など）は**自動エスケープされる**（エスケープ不要）
- `get_*()`系の関数（`get_the_title()`, `get_permalink()`など）は**エスケープが必要**
- `echo`で出力する場合は必ずエスケープ関数を使用

**例**:
```php
// OK: 自動エスケープされる
<?php the_title(); ?>
<?php the_content(); ?>

// NG: エスケープが必要
<?php echo get_the_title(); ?>

// OK: エスケープ済み
<?php echo esc_html( get_the_title() ); ?>
```

詳細は [コーディング規約（詳細版）](../coding-standards.md#エスケープ処理) を参照してください。

### Q: CSSが読み込まれない

**確認事項**:

1. **`functions.php`で`wp_enqueue_style()`を使用しているか**
   - `<link>`タグは使用しない
   - `wp_enqueue_style()`を使用

2. **`wp_head()`が`header.php`に含まれているか**
   ```php
   <?php wp_head(); ?>
   ```

3. **ファイルパスが正しいか**
   - `get_template_directory_uri()`を使用

### Q: `get_template_part()`でファイルが見つからない

**確認事項**:

1. **ファイルパスが正しいか**
   - `get_template_part( 'template-parts/section-fv' )` → `template-parts/section-fv.php`
   - 拡張子（`.php`）は不要

2. **ファイルが存在するか**
   - `template-parts/`ディレクトリ内にファイルがあるか確認

## その他のトラブル

### Q13: デザインカンプ（Figma）の見方がわからない

**確認方法**:

1. **Figmaファイルを開く**
2. **左側のレイヤーパネル**でセクションを確認
3. **右側のプロパティパネル**で色、フォント、余白を確認
4. **右上の「Dev Mode」**をクリックすると、CSSの値が表示される

**確認すべき項目**:
- 色（背景色、文字色）
- フォントサイズ、フォントファミリー
- 余白（margin, padding）
- 幅、高さ
- ブレークポイント（PC/タブレット/スマホ）

### Q14: スタイルが適用されない

**確認事項**:

1. **CSSファイルがHTMLにリンクされているか**
   - `<link rel="stylesheet" href="assets/css/ファイル名.css">` があるか

2. **CSSファイルが最新か**
   - SCSSファイルを保存して、CSSファイルが更新されているか
   - ブラウザのキャッシュをクリア（Cmd+Shift+R / Ctrl+Shift+R）

3. **クラス名が正しいか**
   - HTMLのクラス名とCSSのセレクタが一致しているか
   - スペルミスがないか

4. **CSSの詳細度が低くないか**
   - 他のスタイルに上書きされていないか
   - ブラウザの開発者ツールで確認

### Q15: 画像が表示されない

**確認事項**:

1. **画像ファイルのパスが正しいか**
   - `assets/images/` から始まるパスか
   - 相対パスが正しいか

2. **画像ファイルが存在するか**
   - ファイル名のスペルミスがないか
   - ファイルが正しいディレクトリにあるか

3. **画像ファイルがコミットされているか**
   - Gitで画像ファイルが追加されているか確認

---

## 💡 困ったときは

1. **まずこのFAQを確認**
2. **ドキュメントを確認**
   - [HTML/CSS静的コーディング](04-markup.md) - このフェーズで必要なルールが記載されています
   - [コーディング規約（詳細版）](coding-standards.md) - すべてのコーディング規約
3. **メンターに質問**
   - SlackやGitHubのIssueで質問
   - スクリーンショットを添付すると解決が早い

---

**最終更新**: 2025/12/4
