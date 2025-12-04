# Issue作成マニュアル（運営・メンター向け）

新しいプロジェクトでIssueを作成する際の手順です。
**スクリプトで自動化する方法（推奨）と手動作成の方法があります。**

## 📋 よく使うIssueセット

模写コーディングフェーズで作成するIssueの一覧です。

### 必須Issue（Web Craft Studio TOPページ）

1. **[模写コーディング] ヘッダー作成**
2. **[模写コーディング] TOPページ ファーストビュー（FV）作成**
3. **[模写コーディング] TOPページ サービスセクション作成**
4. **[模写コーディング] TOPページ 制作実績セクション作成**
5. **[模写コーディング] TOPページ スタッフセクション作成**
6. **[模写コーディング] TOPページ お客様の声セクション作成**
7. **[模写コーディング] TOPページ 最新のお知らせセクション作成**
8. **[模写コーディング] TOPページ お問い合わせセクション作成**
9. **[模写コーディング] フッター作成**

### プロジェクトに応じて追加

- その他のセクション（Aboutページ、Contactページなど）
- WordPress化用のIssue

## 🚀 Issue作成方法

### 方法1: スクリプトで自動化（推奨・簡単）

**もっとも簡単で効率的な方法です。** スクリプトを実行するだけで、よく使うIssueセットを一括作成できます。

#### GitHub CLI版（もっとも簡単）

```bash
cd .github/scripts
chmod +x create-markup-issues.sh
./create-markup-issues.sh
```

**必要な準備**:

1. GitHub CLIをインストール: `brew install gh`
2. GitHub認証: `gh auth login`

#### Node.js版（npm startで実行）

```bash
cd .github/scripts
npm install
npm start
```

**必要な準備**:

1. Node.jsをインストール（すでにインストール済みの場合は不要）
2. `.env` ファイルを作成（初回のみ）:

   ```env
   GITHUB_TOKEN=your_github_token_here
   GITHUB_REPOSITORY_OWNER=owner_name
   GITHUB_REPOSITORY_NAME=repo_name
   ```

**GitHubトークンの作成方法**:

1. GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. "Generate new token" をクリック
3. `repo` スコープを選択して生成
4. トークンをコピーして `.env` に設定

#### 所要時間

- スクリプト実行: 約1〜2分（6個のIssueを一括作成）

### 方法2: 手動で作成

スクリプトが使えない場合や、個別にカスタマイズしたい場合に使用します。

#### ステップ1: Issue作成画面を開く

1. GitHubリポジトリの「Issues」タブを開く
2. 「New issue」ボタンをクリック
3. 「模写コーディングタスク」テンプレートを選択

#### ステップ2: テンプレートに情報を入力

テンプレートの各項目を埋めます：

- **タイトル**: `[模写コーディング] TOPページ ファーストビュー（FV）作成`
- **デザインカンプ**: デザインカンプのURL（例: `https://www.figma.com/design/IccA2vQZGGENt8jyXSzKNK/Web-Craft-Studio?node-id=74-2`）
- **ページ/セクション**: `TOPページ ファーストビュー（FV）`
- **納期**: スケジュールに合わせて設定

#### ステップ3: ラベルを設定

- `作業中`
- `模写`

#### ステップ4: Issueを作成

「Submit new issue」をクリック

#### ステップ5: 繰り返し

上記の手順を、よく使うIssueセットの各項目について繰り返します。

#### 所要時間（手動作成）

- 1つのIssue作成: 約1〜2分
- よく使うIssueセット（9個）: 約15〜20分

## 💡 推奨

**スクリプトでの自動化（方法1）を推奨します。**

- 時間短縮（15〜20分 → 1〜2分）
- ミスが少ない
- 毎回同じ形式で作成される

詳細は [Issue一括作成スクリプトのREADME](.github/scripts/README.md) を参照してください。

---

**注意**: このマニュアルは運営・メンター向けです。
受講生はすでに作成されたIssueを確認して作業を開始します。
