# 2. 環境構築・セットアップ

開発を始める前に、必要な環境を準備しましょう。

## 📋 必要なもの

- [Local by Flywheel](https://localwp.com/) - WordPressのローカル開発環境
- [VS Code](https://code.visualstudio.com/) - エディター（推奨）
- [Git](https://git-scm.com/) - バージョン管理
- [Live Sass Compiler](https://marketplace.visualstudio.com/items?itemName=glenn2223.live-sass) - VS Code拡張機能

> **💡 事前確認**: Gitがインストールされているか確認してください。
> ```bash
> git --version
> ```
> コマンドが実行できない場合は、[Git公式サイト](https://git-scm.com/)からインストールしてください。

## 🚀 セットアップ手順

### 1. Local by Flywheelのセットアップ

1. [Local by Flywheel](https://localwp.com/)をダウンロード・インストール

2. **新しいサイトを作成**
   - Local by Flywheelアプリを開く
   - 「**+ Create a new site**」ボタンをクリック
   - 以下の設定でサイトを作成：
     - **サイト名**: `web-craft-studio`（またはチームで指定された名前）
     - **環境**: 「Preferred」を選択（推奨設定）
     - **WordPress**: 最新の安定版を選択
     - **PHP**: PHP 8.0以上を推奨
     - **ユーザー名・パスワード**: 任意（後で変更可能）

3. サイトの作成が完了したら、WordPressが自動的にインストールされます

4. **必須プラグインのインストール**
   - WordPress管理画面にログイン
   - **プラグイン > 新規追加** を開く
   - **Advanced Custom Fields (ACF)** を検索してインストール・有効化
   - これが完了したら、テーマのインストールに進みます

### 2. テーマのインストール

#### ステップ1: Local by Flywheelのテーマディレクトリを開く

**方法A: Local by FlywheelのGUIから開く（推奨）**

1. Local by Flywheelアプリを開く
2. 作成したサイトを選択
3. サイト名の右側にある「**Open Site Shell**」ボタンをクリック
   - または、サイトを右クリック > 「**Open Site Shell**」を選択
4. ターミナルが開いたら、以下のコマンドを実行：
   ```bash
   cd wp-content/themes/
   ```

**方法B: ターミナルから直接移動する**

1. ターミナルを開く
2. Local by Flywheelのサイトディレクトリに移動
   ```bash
   # macOSの場合（デフォルトの保存場所）
   # サイト名が「web-craft-studio」の場合の例
   cd ~/Local\ Sites/web-craft-studio/app/public/wp-content/themes/

   # サイト名がわからない場合
   # Local by Flywheelアプリでサイト名を確認してください
   # 例: サイト名が「my-site」の場合
   cd ~/Local\ Sites/my-site/app/public/wp-content/themes/
   ```

   > **💡 確認方法**: 正しいディレクトリに移動できたか確認するには、以下のコマンドを実行：
   > ```bash
   > pwd
   > # 出力例: /Users/あなたのユーザー名/Local Sites/web-craft-studio/app/public/wp-content/themes
   > ls
   > # 既存のテーマ（twenty-twenty-three など）が表示されればOK
   > ```

> **💡 ヒント**: サイト名にスペースが含まれている場合は、`\`（バックスラッシュ）でエスケープするか、`"`（ダブルクォート）で囲みます。
> ```bash
> cd ~/Local\ Sites/My\ Site/app/public/wp-content/themes/
> # または
> cd ~/"Local Sites/My Site/app/public/wp-content/themes/"
> ```

#### ステップ2: リポジトリをクローン

テーマディレクトリに移動したら、以下のコマンドでリポジトリをクローンします：

```bash
git clone https://github.com/kasuyaofcb/web-craft-studio.git
```

> **⚠️ 注意**: 既に`web-craft-studio`という名前のフォルダが存在する場合は、エラーになります。その場合は、別の名前でクローンするか、既存のフォルダを削除してください。

#### ステップ3: クローンが成功したか確認

以下のコマンドで、正しくクローンされたか確認します：

```bash
ls -la
# web-craft-studio というフォルダが表示されればOK

cd web-craft-studio
ls
# style.css, functions.php, assets/ などが表示されればOK
```

#### ステップ4: WordPress管理画面でテーマを有効化

1. **管理画面にアクセス**
   - Local by Flywheelアプリでサイトを選択
   - 「**WP Admin**」ボタンをクリック
   - または、ブラウザで `http://web-craft-studio.local/wp-admin` にアクセス
   - ログイン情報は、サイト作成時に設定したユーザー名・パスワードを使用

2. **テーマを有効化**
   - 管理画面 > **外観 > テーマ** を開く
   - 「Web Craft Studio」テーマを選択して「有効化」をクリック

3. **WordPressの基本設定（必須）**
   - 管理画面 > **設定 > 一般** を開く
   - 以下の項目を設定：
   - **サイトのタイトル**: サイト名を入力（例：「Web Craft Studio」）
     - この値は `<?php bloginfo('name'); ?>` で表示されます
   - **キャッチフレーズ**: サイトの説明文を入力（例：「チーム開発で学ぶWeb制作」）
     - この値は `<?php bloginfo('description'); ?>` で表示されます
   - **変更を保存** をクリック

> **💡 確認方法**: サイトのトップページ（`http://web-craft-studio.local`）にアクセスして、テーマが適用されているか確認してください。

### 3. VS Codeの設定

#### ステップ1: VS Codeでテーマフォルダを開く

1. VS Codeを起動
2. **ファイル > フォルダーを開く**（macOS: `Cmd + O`、Windows: `Ctrl + O`）
3. テーマフォルダを選択：
   ```
   ~/Local Sites/web-craft-studio/app/public/wp-content/themes/web-craft-studio
   ```
   > **💡 ヒント**: フォルダを開いたら、エクスプローラー（左側のサイドバー）に `style.css`, `functions.php`, `assets/` などが表示されることを確認してください。

#### ステップ2: Live Sass Compilerをインストール

1. VS Codeの拡張機能タブ（左側のアイコン）をクリック
2. 「Live Sass Compiler」で検索
3. 「Live Sass Compiler」（作者: Glenn Marks）をインストール

#### ステップ3: Watch Sassを開始

1. VS Codeの下部（ステータスバー）に「**Watch Sass**」ボタンがあることを確認
2. 「Watch Sass」ボタンをクリック
3. 「**Watching...**」と表示されればOK

> **💡 確認方法**: ステータスバーの右下に「Watching...」と表示されていれば、正常に動作しています。

#### ステップ4: SCSSファイルを保存して動作確認

1. `assets/scss/` 内のSCSSファイルを保存すると、自動的に `assets/css/` にCSSファイルが生成されます
2. エクスプローラーで `assets/css/` フォルダを確認すると、CSSファイルが自動生成されていることがわかります

### 4. 動作確認

1. `assets/scss/common.scss` を開く
2. 何かスタイルを追加して保存
3. `assets/css/common.css` が自動生成されることを確認

## ✅ セットアップ確認チェックリスト

- [ ] Local by Flywheelがインストールされている
- [ ] WordPressサイトが作成されている
- [ ] Advanced Custom Fields (ACF) プラグインがインストール・有効化されている
- [ ] テーマがインストールされている
- [ ] VS Codeがインストールされている
- [ ] Live Sass Compilerがインストールされている
- [ ] Watch Sassが動作している
- [ ] SCSSファイルを保存してCSSが生成されることを確認

## 🆘 よくある問題

### クローン時にエラーが発生する

**エラー例**: `fatal: could not read Username for 'https://github.com'`

**解決方法**:
1. インターネット接続を確認
2. GitHubのリポジトリURLが正しいか確認
3. プライベートリポジトリの場合は、Git認証が必要な場合があります

### テーマが管理画面に表示されない

**確認事項**:
1. テーマフォルダが正しい場所（`wp-content/themes/`）にあるか
2. `style.css` ファイルが存在するか
3. `style.css` の先頭にテーマ情報（Theme Nameなど）が記載されているか

**解決方法**:
1. 管理画面をリロード（`F5` または `Cmd + R`）
2. テーマフォルダのパーミッションを確認
3. Local by Flywheelのサイトを再起動

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
