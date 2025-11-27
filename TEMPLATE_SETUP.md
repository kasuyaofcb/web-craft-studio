# テンプレートセットアップガイド

このプロジェクトは、チーム開発課題のテンプレートとして使用できます。
新しいチーム開発課題を開始する際は、このガイドに従ってセットアップしてください。

## 📋 セットアップ手順

### 1. プロジェクトのコピー

新しいチーム開発課題用に、このテンプレートをコピーします。

```bash
# 新しいプロジェクト名でコピー
cp -r web-craft-studio [新しいプロジェクト名]
cd [新しいプロジェクト名]
```

### 2. プロジェクト固有の情報を更新

以下のファイルを編集して、プロジェクト固有の情報に更新してください。

#### README.md

以下のセクションを更新：

- **プロジェクト概要**: プロジェクトの説明
- **デザインカンプ情報**: デザインカンプの詳細
- **チームメンバー**: チームメンバーの名前
- **スケジュール**: 各フェーズの期限
- **メンター**: メンター情報

#### style.css

WordPressテーマのヘッダーコメントを更新：

```css
/*
Theme Name: [プロジェクト名]
Description: [プロジェクトの説明]
Version: 1.0.0
Author: [チーム名]
*/
```

#### functions.php

テーマのバージョンや定数を更新（必要に応じて）：

```php
// テーマのバージョン
define('THEME_VERSION', '1.0.0');

// テーマのパス
define('THEME_PATH', get_template_directory());
define('THEME_URI', get_template_directory_uri());
```

### 3. 不要なファイルの削除（オプション）

テンプレートに含まれるサンプルファイルや、今回のプロジェクトで不要なファイルがあれば削除してください。

### 4. Gitリポジトリの初期化

新しいGitリポジトリとして初期化します。

```bash
# 既存の.gitディレクトリを削除（ある場合）
rm -rf .git

# 新しいリポジトリとして初期化
git init
git add .
git commit -m "chore: プロジェクト初期化"

# リモートリポジトリを追加
git remote add origin [リポジトリURL]
git branch -M main
git push -u origin main
```

### 5. プロジェクト構成の確認

プロジェクトのディレクトリ構造を確認し、必要に応じて調整してください。

```
[プロジェクト名]/
├── style.css
├── functions.php
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── template-parts/
├── page-templates/
└── docs/
```

## 🎨 カスタマイズポイント

### デザインカンプに合わせた調整

1. **assets/css/** の構成
   - デザインカンプに合わせてCSSファイルを追加・削除
   - 例: `fv.css`, `section-01.css` など

2. **template-parts/** の構成
   - セクションごとのパーツファイルを追加
   - 例: `section-01.php`, `section-02.php` など

3. **page-templates/** の構成
   - 必要な固定ページテンプレートを追加
   - 例: `page-about.php`, `page-contact.php` など

### カスタム投稿タイプの追加

`docs/instructions/wordpress-guide.md` を参考に、必要なカスタム投稿タイプを実装してください。

### チェックリストのカスタマイズ

`docs/checklists/phase-checklist.md` を編集して、プロジェクト固有のチェック項目を追加・削除してください。

### Issue一括作成スクリプトのカスタマイズ

模写コーディングフェーズで使用するIssue一括作成スクリプトのセクション一覧を編集してください。

#### セクション一覧の編集

`.github/scripts/create-markup-issues.sh` または `.github/scripts/create-markup-issues.js` のセクション一覧を編集：

```bash
# Bash版
SECTIONS=(
  "TOPページ ファーストビュー（FV）"
  "TOPページ セクション01"
  # プロジェクトに合わせて追加・削除
)
```

```javascript
// Node.js版
const SECTIONS = [
  'TOPページ ファーストビュー（FV）',
  'TOPページ セクション01',
  // プロジェクトに合わせて追加・削除
];
```

詳細は [Issue一括作成スクリプトのREADME](.github/scripts/README.md) を参照してください。

## 📝 更新が必要なドキュメント

以下のドキュメントは、プロジェクトに合わせて更新してください。

- [ ] `README.md` - プロジェクト情報
- [ ] `docs/specification-template.md` - 仕様書（必要に応じて）
- [ ] `docs/checklists/phase-checklist.md` - チェックリスト（必要に応じて）

## ✅ セットアップ確認チェックリスト

- [ ] プロジェクト名を更新
- [ ] チームメンバー情報を更新
- [ ] スケジュールを更新
- [ ] デザインカンプ情報を更新
- [ ] Gitリポジトリを初期化
- [ ] 開発ブランチを作成
- [ ] プロジェクト構成を確認
- [ ] 不要なファイルを削除

## 🔄 テンプレートの更新

テンプレート自体に改善があった場合は、以下の手順で更新できます。

1. テンプレートの最新版を取得
2. 既存プロジェクトと比較
3. 必要な変更を既存プロジェクトに適用

## 📚 参考

- [README.md](README.md) - プロジェクト概要
- [クイックスタートガイド](docs/quick-start.md) - 開発開始時のガイド
- [Git運用ルール](docs/git-workflow.md) - Gitの使い方

---

**注意**: このテンプレートは教育目的で使用されます。
各プロジェクトで適宜カスタマイズしてください。
