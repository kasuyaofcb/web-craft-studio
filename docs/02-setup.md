# 2. 環境構築・セットアップ

開発を始める前に、必要な環境を準備しましょう。

## 📋 必要なもの

- [Local by Flywheel](https://localwp.com/) - WordPressのローカル開発環境
- [VS Code](https://code.visualstudio.com/) - エディター（推奨）
- [Git](https://git-scm.com/) - バージョン管理
- [Live Sass Compiler](https://marketplace.visualstudio.com/items?itemName=glenn2223.live-sass) - VS Code拡張機能

## 🚀 セットアップ手順

### 1. Local by Flywheelのセットアップ

1. [Local by Flywheel](https://localwp.com/)をダウンロード・インストール
2. 新しいサイトを作成
3. WordPressをインストール

### 2. テーマのインストール

1. このリポジトリをクローン
   ```bash
   git clone [リポジトリURL]
   ```

2. テーマディレクトリに配置
   ```text
   wp-content/themes/web-craft-studio/
   ```

3. WordPress管理画面でテーマを有効化

### 3. VS Codeの設定

1. **Live Sass Compilerをインストール**
   - VS Codeの拡張機能タブを開く
   - 「Live Sass Compiler」で検索
   - 「Live Sass Compiler」（作者: Glenn Marks）をインストール

2. **Watch Sassを開始**
   - VS Codeの下部（ステータスバー）に「Watch Sass」ボタンがある
   - クリックして「Watching...」と表示されればOK

3. **SCSSファイルを保存**
   - `assets/scss/` 内のSCSSファイルを保存すると、自動的に `assets/css/` にCSSファイルが生成されます

### 4. 動作確認

1. `assets/scss/common.scss` を開く
2. 何かスタイルを追加して保存
3. `assets/css/common.css` が自動生成されることを確認

## ✅ セットアップ確認チェックリスト

- [ ] Local by Flywheelがインストールされている
- [ ] WordPressサイトが作成されている
- [ ] テーマがインストールされている
- [ ] VS Codeがインストールされている
- [ ] Live Sass Compilerがインストールされている
- [ ] Watch Sassが動作している
- [ ] SCSSファイルを保存してCSSが生成されることを確認

## 🆘 よくある問題

### SCSSファイルを保存してもCSSファイルが生成されない

**確認事項**:
1. Watch Sassボタンをクリックしているか
2. SCSSファイルが `assets/scss/` 内にあるか
3. パーシャルファイル（`partials/`内）はコンパイルされません（正常）

**解決方法**:
1. VS Codeを再起動
2. 「Watch Sass」ボタンをクリック
3. SCSSファイルを保存してみる

詳細は [よくある質問・トラブルシューティング](faq-troubleshooting.md) を参照してください。

## ✅ セットアップ確認チェックリスト

### 必須項目（必ず更新）

- [ ] `README.md` の以下を更新
  - [ ] チームメンバー
  - [ ] スケジュール
  - [ ] デザインカンプ情報
- [ ] Gitリポジトリを初期化
- [ ] Issueを作成

### 確認事項

- [ ] `.vscode/settings.json` が存在する（Live Sass Compiler設定）
- [ ] `assets/images/` ディレクトリ構造が存在する
- [ ] `assets/scss/partials/_variables.scss` が存在する
- [ ] `.editorconfig` が存在する
- [ ] `.gitignore` が正しく設定されている

## ➡️ 次に読むべきもの

1. **[Gitのルール](git-workflow.md)** - Gitの使い方を覚えましょう
2. **[コーディング規約（詳細版）](coding-standards.md)** - **📌 重要**: すべてのコーディング規約（コーディング開始前に必ず読む）
3. **[HTML/CSS静的コーディング](04-markup.md)** - コーディング開始時はこちらから（このフェーズで必要なルールが記載されています）

---

**最終更新**: 2025/12/4
