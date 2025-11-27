# Web Craft Studio - チーム開発プロジェクト

> **📌 このプロジェクトはテンプレートです**
> 新しいチーム開発課題を開始する際は、[テンプレートセットアップガイド](TEMPLATE_SETUP.md) を参照してください。

## 📑 目次

- [プロジェクト概要](#-プロジェクト概要)
- [目的](#-目的)
- [技術スタック](#️-技術スタック)
- [プロジェクト構成](#-プロジェクト構成)
- [セットアップ手順](#-セットアップ手順)
- [学習の流れ](#-学習の流れ) ⭐ **初学者はここから**
- [開発フロー](#-開発フロー)
- [Issue管理](#-issue管理)
- [ドキュメント](#-ドキュメント)
- [トラブルシューティング](#-トラブルシューティング)

## 📋 プロジェクト概要

共通デザインカンプをもとに、チームで1つのWebサイトを構築する実践型カリキュラムです。
受講生は全員コーダーとして、模写コーディングからWordPress化までをチームで協力して進めます。

## 🎯 目的

本カリキュラムは、受講生がWordPressサイトをチームで開発する経験を通して、**実務に近いコーディングスキルとチーム開発の基礎**を習得することを目的とします。

## 🛠️ 技術スタック

- **フロントエンド**: HTML5, CSS3, JavaScript (ES6+)
- **バックエンド**: WordPress (PHP)
- **CSS設計**: BEM + ユーティリティクラス（`u-`接頭辞）
- **バージョン管理**: Git / GitHub
- **開発環境**: Local by Flywheel

## 📁 プロジェクト構成

```
web-craft-studio/
│
├── style.css                      // テーマのメインスタイル（WordPress用ヘッダコメント含む）
├── functions.php                  // テーマ関数・WP初期設定
├── screenshot.png                  // テーマサムネイル
│
├── assets/                        // 静的アセット
│   ├── css/                       // CSSファイル
│   │   ├── common.css             // 全体共通スタイル
│   │   ├── header.css
│   │   ├── footer.css
│   │   └── fv.css
│   ├── js/                        // JSファイル
│   │   ├── common.js
│   │   └── fv.js
│   └── images/                    // 画像ファイル
│       ├── fv/
│       ├── sections/
│       └── shared/
│
├── template-parts/                // セクション単位のパーツ
│   ├── header.php
│   ├── footer.php
│   ├── fv.php
│   ├── section-01.php
│   ├── section-02.php
│   ├── section-03.php
│   └── section-04.php
│
├── page-templates/                // 特定ページ用テンプレート（オプション）
│   ├── page-about.php
│   └── page-contact.php
│
├── single.php                     // 投稿ページ
├── page.php                       // 固定ページ
├── index.php                      // デフォルトテンプレート
├── archive.php                    // アーカイブページ
└── 404.php                        // 404ページ
```

### 開発用ディレクトリ

```
web-craft-studio/
├── .github/
│   ├── ISSUE_TEMPLATE/
│   │   └── task-template.md       // タスクテンプレート
│   └── pull_request_template.md   // プルリクエストテンプレート
│
└── docs/                          // ドキュメント
    ├── checklists/                // チェックリスト
    │   ├── phase-checklist.md
    │   └── retrospective.md
    ├── instructions/              // ステップ別指示書
    │   ├── markup-guide.md
    │   └── wordpress-guide.md
    ├── coding-standards.md        // コーディング規約
    ├── git-workflow.md           // Git運用ルール
    └── specification-template.md // 仕様書テンプレート
```

## 🚀 セットアップ手順

> **📌 テンプレートとして使う場合**: まず [テンプレートセットアップガイド](TEMPLATE_SETUP.md) を参照してください。

### 1. ローカル環境の構築

1. [Local by Flywheel](https://localwp.com/)をインストール
2. 新しいサイトを作成
3. WordPressをインストール

### 2. テーマのインストール

1. このリポジトリをクローン
   ```bash
   git clone [リポジトリURL]
   ```

2. テーマディレクトリに配置
   ```
   wp-content/themes/web-craft-studio/
   ```

3. WordPress管理画面でテーマを有効化

### 3. 開発環境の準備

1. Node.jsをインストール（必要に応じて）
2. エディタの設定（推奨: VS Code）
3. Gitの設定

## 📖 開発フロー

### 1. ブランチの作成

```bash
git checkout main
git pull origin main
git checkout -b issue-[Issue番号]-[概要]
```

### 2. 開発

- コーディング規約に従って実装
- 適切にコミット

### 3. プルリクエストの作成

- GitHubでプルリクエストを作成
- コードレビューを受ける
- 承認後にマージ

詳細は [Git運用ルール](docs/git-workflow.md) を参照してください。

## 🎓 学習の流れ（初学者向け）

> **初学者の方は**: この順番で読んでいくとスムーズに進められます。

### ステップ1: 準備（キックオフ前）

1. **[クイックスタートガイド](docs/quick-start.md)** ⭐ **最初に読む！**
   - 最小限のルール集（10分で読める）
   - BEM命名規則の基本
   - Git基本操作

2. **[Git運用ルール](docs/git-workflow.md)** - Gitの基本操作を確認

### ステップ2: フェーズごとに読む

#### フェーズ1: キックオフ
- [フェーズ別チェックリスト](docs/checklists/phase-checklist.md) - キックオフセクションを確認

#### フェーズ2: デザインカンプ確認
- [フェーズ別チェックリスト](docs/checklists/phase-checklist.md) - デザインカンプ確認セクションを確認

#### フェーズ3: 模写コーディング
1. [模写コーディング ステップ別指示書](docs/instructions/markup-guide.md) ⭐
2. [フェーズ別チェックリスト](docs/checklists/phase-checklist.md) - 模写コーディングセクション
3. [コーディング規約（詳細版）](docs/coding-standards.md) - 必要に応じて参照

#### フェーズ4: WordPress化
1. [WordPress化 ステップ別指示書](docs/instructions/wordpress-guide.md) ⭐
2. [フェーズ別チェックリスト](docs/checklists/phase-checklist.md) - WordPress化セクション
3. [コーディング規約（詳細版）](docs/coding-standards.md) - PHPセクションを参照

#### フェーズ5: 納品・振り返り
1. [フェーズ別チェックリスト](docs/checklists/phase-checklist.md) - 納品・振り返りセクション
2. [振り返りシート](docs/checklists/retrospective.md)

### ステップ3: 必要に応じて参照

- [コーディング規約・命名規則（詳細版）](docs/coding-standards.md) - すべてのルール
- [Git運用ルール（詳細版）](docs/git-workflow.md) - Gitの詳細な使い方
- [仕様書テンプレート](docs/specification-template.md) - 仕様書作成時


## 📋 Issue管理

### Issueテンプレート

GitHubでIssueを作成する際、以下のテンプレートが使用できます：

- **[模写コーディングタスク](.github/ISSUE_TEMPLATE/markup-task.md)** - HTML/CSSコーディング用
- **[WordPress化タスク](.github/ISSUE_TEMPLATE/wordpress-task.md)** - WordPress化用
- **[通常タスク](.github/ISSUE_TEMPLATE/task-template.md)** - その他のタスク

### Issue一括作成（模写コーディングフェーズ）

模写コーディングフェーズで、複数のセクション用のIssueを一度に作成できます。

#### 方法1: GitHub CLI（推奨）

```bash
cd .github/scripts
chmod +x create-markup-issues.sh
./create-markup-issues.sh
```

#### 方法2: Node.js

```bash
cd .github/scripts
npm install
# .env ファイルを作成して GITHUB_TOKEN などを設定
node create-markup-issues.js
```

詳細は [Issue一括作成スクリプトのREADME](.github/scripts/README.md) を参照してください。

## 📚 ドキュメント一覧

**初学者の方は**: [学習の流れ](#-学習の流れ初学者向け) を参照してください。

### 🚀 初学者向け

| ドキュメント | 説明 | 読むタイミング |
| --- | --- | --- |
| [クイックスタートガイド](docs/quick-start.md) | 最小限のルール集（10分で読める） | **最初に必ず読む** ⭐ |

### 📖 ステップ別指示書

| ドキュメント | 説明 | 読むタイミング |
| --- | --- | --- |
| [模写コーディング ステップ別指示書](docs/instructions/markup-guide.md) | HTML/CSS/JSでの実装手順 | 模写コーディングフェーズ |
| [WordPress化 ステップ別指示書](docs/instructions/wordpress-guide.md) | WordPressテーマ化の手順 | WordPress化フェーズ |

### 📝 ルール・規約

| ドキュメント | 説明 | 読むタイミング |
| --- | --- | --- |
| [コーディング規約・命名規則（詳細版）](docs/coding-standards.md) | すべてのコーディング規約 | 必要に応じて参照 |
| [Git運用ルール（詳細版）](docs/git-workflow.md) | Gitの詳細な使い方 | 必要に応じて参照 |

### ✅ チェックリスト

| ドキュメント | 説明 | 読むタイミング |
| --- | --- | --- |
| [フェーズ別チェックリスト](docs/checklists/phase-checklist.md) | 各フェーズの確認項目 | 各フェーズで使用 |
| [振り返りシート](docs/checklists/retrospective.md) | 振り返り用シート | 振り返りフェーズ |

### 📄 テンプレート

| ドキュメント | 説明 | 読むタイミング |
| --- | --- | --- |
| [仕様書テンプレート](docs/specification-template.md) | 仕様書作成用テンプレート | 仕様書作成時 |

## 🎨 デザインカンプ情報

<!-- デザインカンプの情報を記入してください -->
- **デザインカンプファイル**:
- **デザインツール**:
- **カラーパレット**:
- **フォント**:
- **ブレークポイント**:

## 👥 チームメンバー

<!-- チームメンバーを記入してください -->
-
-
-

## 📅 スケジュール

<!-- スケジュールを記入してください -->

| フェーズ | 内容 | 期限 |
| --- | --- | --- |
| キックオフ | チーム顔合わせ、進行ルール説明 | |
| デザインカンプ確認 | 共通デザインカンプの確認、タスク分担 | |
| 模写コーディング | HTML/CSS/JSでデザインカンプ再現 | |
| WordPress化 | テーマ作成、固定ページ・カスタム投稿の実装 | |
| 納品・振り返り | 最終チェック、アンケート回答、成果物のお披露目 | |

## ✅ 進捗状況

### 模写コーディング

- [ ] ヘッダー
- [ ] フッター
- [ ] トップページ
- [ ] 固定ページ
- [ ] その他

### WordPress化

- [ ] テーマの基本構造
- [ ] 固定ページの実装
- [ ] カスタム投稿タイプの実装
- [ ] テンプレートパーツの分割
- [ ] 動的コンテンツの実装

## 🐛 トラブルシューティング

### よくある問題

#### テーマが表示されない
- WordPressのバージョンを確認
- `style.css`のテーマ情報を確認
- パーミッションを確認

#### カスタム投稿タイプが表示されない
- `functions.php`で正しく登録されているか確認
- パーマリンク設定を更新（設定 > パーマリンク設定 > 変更を保存）

#### Gitのコンフリクト
- [Git運用ルール](docs/git-workflow.md)の「コンフリクトの解決」を参照

## 📝 コーディング規約

**初学者の方は**: まず [クイックスタートガイド](docs/quick-start.md) を読んでください。

### 基本ルール

- **HTML**: セマンティックなHTML5タグを使用、インデントはスペース2つ
- **CSS**: BEM命名規則、モバイルファースト、インデントはスペース2つ
- **JavaScript**: キャメルケース、エラーハンドリング必須、インデントはスペース2つ
- **PHP**: WordPressコーディング規約に準拠、エラーハンドリング必須

詳細は [コーディング規約・命名規則（詳細版）](docs/coding-standards.md) を参照してください。

## 🔗 参考資料

- [WordPress Codex](https://wpdocs.osdn.jp/)
- [WordPress Developer Handbook](https://developer.wordpress.org/)
- [MDN Web Docs](https://developer.mozilla.org/ja/)
- [BEM公式サイト](https://en.bem.info/)

## 📄 ライセンス

このプロジェクトは教育目的で使用されます。

## 👨‍💼 メンター

<!-- メンター情報を記入してください -->
- **担当メンター**:
- **連絡方法**:

---

## 更新履歴

<!-- プロジェクトの更新履歴を記入してください -->

### 2024/XX/XX
- プロジェクト開始
- 初期セットアップ完了
