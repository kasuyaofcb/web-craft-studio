# Issue一括作成スクリプト

模写コーディングフェーズで使用する、複数のIssueを一度に作成するスクリプトです。

## 📋 セクション一覧のカスタマイズ

プロジェクトに合わせて、以下のファイルでセクション一覧を編集してください：

- **Bash版**: `create-markup-issues.sh` の `SECTIONS` 配列
- **Node.js版**: `create-markup-issues.js` の `SECTIONS` 配列

### 例

```javascript
const SECTIONS = [
  'TOPページ ファーストビュー（FV）',
  'TOPページ セクション01',
  'TOPページ セクション02',
  'ヘッダー',
  'フッター',
];
```

## 🚀 使用方法

### 方法1: Node.js版（npm startで実行・推奨）

**最も簡単な方法です。**

#### 1. 必要なパッケージをインストール

```bash
cd .github/scripts
npm install
```

#### 2. 環境変数を設定（初回のみ）

`.github/scripts/` ディレクトリに `.env` ファイルを作成：

```env
# GitHub認証情報（必須）
GITHUB_TOKEN=your_github_token_here

# リポジトリ情報（必須）
GITHUB_REPOSITORY_OWNER=owner_name
GITHUB_REPOSITORY_NAME=repo_name

# デザインカンプURL（オプション）
DESIGN_CAMP_BASE_URL=https://example.com/design-camp
```

**GitHubトークンの作成方法**:
1. GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. "Generate new token" をクリック
3. `repo` スコープを選択
4. トークンをコピーして `.env` に設定

#### 3. スクリプトを実行

```bash
npm start
```

これで、よく使うIssueセットが一括作成されます！

### 方法2: GitHub CLI（Bash版）

#### 1. GitHub CLIをインストール

```bash
# macOS
brew install gh

# その他のOS
# https://cli.github.com/
```

#### 2. GitHub認証

```bash
gh auth login
```

#### 3. スクリプトを実行

```bash
cd .github/scripts
chmod +x create-markup-issues.sh
./create-markup-issues.sh
```

リポジトリディレクトリで実行すると、自動的にリポジトリ情報を取得します。

### 方法3: Node.js版（直接実行）

方法1と同じですが、`npm start`の代わりに直接実行します：

```bash
cd .github/scripts
npm install
node create-markup-issues.js
```

## 📝 カスタマイズ

### デザインカンプURLの設定

- **Bash版**: `DESIGN_CAMP_BASE_URL` 変数を編集
- **Node.js版**: `.env` ファイルの `DESIGN_CAMP_BASE_URL` を設定

### ラベルの変更

Issueに付与するラベルを変更する場合：

- **Bash版**: `--label "作業中,模写"` の部分を編集
- **Node.js版**: `labels: ['作業中', '模写']` の部分を編集

## ⚠️ 注意事項

- 既存のIssueと重複しないよう、セクション名を確認してください
- 大量のIssueを作成する場合は、GitHubのレート制限に注意してください
- スクリプト実行前に、セクション一覧が正しいか確認してください

## 🔧 トラブルシューティング

### GitHub CLIが見つからない

```bash
# インストール確認
which gh

# インストールされていない場合
brew install gh  # macOS
```

### 認証エラー

```bash
# 認証状態を確認
gh auth status

# 再認証
gh auth login
```

### Node.js版でエラーが発生する場合

```bash
# パッケージを再インストール
rm -rf node_modules package-lock.json
npm install
```

## 📚 参考

- [GitHub CLI ドキュメント](https://cli.github.com/manual/)
- [GitHub API ドキュメント](https://docs.github.com/ja/rest)
- [Octokit.js ドキュメント](https://octokit.github.io/rest.js/)
