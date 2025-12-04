# 3. Gitのルール

> このドキュメントは、Git運用の基本から詳細までを説明します。

## 📋 基本ルール

- **イシュー1件につき1ブランチ**
- ブランチ名は **`issue-[Issue番号]-[概要]`** に統一
- `main` ブランチに直接コミットしない

## 🔧 基本操作

### 0. 初回セットアップ（クローン直後）

リポジトリをクローンした直後は、以下の確認をしてください：

```bash
# 現在のブランチを確認（mainブランチにいるはず）
git branch
# 出力例: * main

# リモートリポジトリが正しく設定されているか確認
git remote -v
# 出力例:
# origin  https://github.com/kasuyaofcb/web-craft-studio.git (fetch)
# origin  https://github.com/kasuyaofcb/web-craft-studio.git (push)

# 最新の状態を取得（初回は不要ですが、念のため）
git pull origin main
```

> **💡 確認ポイント**:
> - `git branch` で `* main` と表示されていればOK
> - `git remote -v` でリモートURLが表示されればOK

### 1. ブランチを作成して作業開始

```bash
# 最新のmainブランチを取得（他の人が変更を加えた可能性があるため）
git checkout main
git pull origin main

# 新しいブランチを作成（例: Issue #12）
git checkout -b issue-12-fv-hero
```

> **💡 注意**: クローン直後で、まだ誰も作業していない場合は `git pull` は不要ですが、念のため実行しても問題ありません。

### 2. 変更をコミット

```bash
git add .
git commit -m "feat: ヘッダー部分の実装"
```

### 3. プッシュしてPR作成

```bash
git push origin issue-12-fv-hero
```

> **💡 初回プッシュの場合**: 初めてこのブランチをプッシュする場合は、以下のメッセージが表示されることがあります：
> ```
> fatal: The current branch issue-12-fv-hero has no upstream branch.
> ```
> その場合は、以下のコマンドを実行：
> ```bash
> git push -u origin issue-12-fv-hero
> ```
> `-u` オプションで、今後は `git push` だけでプッシュできるようになります。

その後、GitHubでプルリクエストを作成

## 📝 コミットメッセージのルール

### 基本形

```
feat: ヘッダー部分の実装
```

### よく使う種類

- `feat:` - 新機能
- `fix:` - バグ修正
- `style:` - スタイルの変更（機能に影響しない）
- `refactor:` - リファクタリング
- `docs:` - ドキュメントの変更
- `test:` - テストの追加・修正
- `chore:` - その他の変更（ビルド設定など）

### 例

```
feat: ヘッダー部分のHTML/CSS実装

- ロゴとナビゲーションメニューを実装
- レスポンシブ対応（モバイルメニュー含む）
- BEM命名規則に準拠
```

## ブランチ運用（詳細）

### ブランチ命名規則

> **原則: イシュー1件につき1ブランチ**
> - `main` から直接ブランチを切る（GitHub Flow）
> - ブランチ名は **`issue-[Issue番号]-[概要]`** に統一
> - 作業内容をイシュー単位で完結させ、PRでIssueを閉じる

- **メインブランチ**: `main`
- **作業ブランチ**: `issue-[Issue番号]-[概要]`
  - 例: `issue-12-fv-hero`, `issue-34-header-responsive`

#### ブランチ名のポイント
- Issue番号を先頭につけるとGitHubが自動でリンク
- 概要は3〜4語で短く（例: `fv-hero`, `works-archive`）
- すべて小文字とハイフンで統一（ミスを減らす）

### ブランチ作成の流れ

1. 最新の `main` ブランチを取得
   ```bash
   git checkout main
   git pull origin main
   ```

2. 新しいブランチを作成（Issueから直接作成すると便利）
   ```bash
   # 例: Issue #12 (模写: FVセクション) の場合
   git checkout -b issue-12-fv-hero
   ```

   > GitHubを使っている場合は、Issue画面の「Create branch」ボタンから作成すると、Issueとブランチが自動で紐づきます。

3. 作業を進めてコミット
   ```bash
   git add .
   git commit -m "feat: ヘッダー部分の実装"
   ```

4. リモートにプッシュ（Issue番号を含むブランチ名でプッシュ）
   ```bash
   git push origin issue-12-fv-hero
   ```

5. GitHubでプルリクエストを作成


## プルリクエスト（PR）の作成

### PR作成時のチェックリスト

- [ ] ブランチ名が命名規則に従っている
- [ ] コミットメッセージが適切です
- [ ] コードがデザインカンプ通りに実装されている
- [ ] コーディング規約に準拠している
- [ ] 不要なファイル（node_modulesなど）が含まれていない
- [ ] 動作確認が完了している

### PRテンプレート

```markdown
## 変更内容
<!-- このPRで実装した内容を簡潔に記述してください -->

## 実装した機能
-
-

## 確認事項
- [ ] デザインカンプ通りに実装されている
- [ ] レスポンシブ対応ができている
- [ ] コーディング規約に準拠している
- [ ] 動作確認が完了している

## スクリーンショット
<!-- 実装した画面のスクリーンショットを添付してください -->

## 参考資料
<!-- 参考にした資料やIssue番号があれば記述してください -->
```

## マージルール

1. **レビュー必須**: すべてのPRは最低1名のレビューを受ける
2. **承認後マージ**: レビュー承認後にマージする
3. **コンフリクト解消**: マージ前にコンフリクトがあれば解消する
4. **ブランチ削除**: マージ後はブランチを削除する

## 🔀 コンフリクトの解決

1. `main` ブランチの最新を取得
   ```bash
   git checkout main
   git pull origin main
   ```

2. 自分のブランチに戻ってマージ
   ```bash
   git checkout issue-12-fv-hero
   git merge main
   ```

3. コンフリクトを解決してコミット
   ```bash
   # コンフリクトを手動で解決
   git add .
   git commit -m "fix: mainとのコンフリクトを解決"
   ```

## ❌ 禁止事項

- ❌ 直接 `main` ブランチにコミットしない
- ❌ 大きな変更を1つのコミットにまとめない
- ❌ コミットメッセージを空にしない
- ❌ 他人のブランチを強制プッシュしない

## 🆘 よくある操作

### 最新の変更を取得してブランチを更新

```bash
git checkout main
git pull origin main
git checkout issue-12-fv-hero
git merge main
```

### コミットを取り消す（まだプッシュしていない場合）

```bash
git reset --soft HEAD~1  # 変更は残す
git reset --hard HEAD~1  # 変更も削除（注意して使用）
```

### 変更を一時的に退避

```bash
git stash              # 変更を退避
git stash list         # 退避した変更を確認
git stash pop          # 退避した変更を復元
```

## ➡️ 次に読むべきもの

- **[コーディング規約（詳細版）](coding-standards.md)** - **📌 重要**: すべてのコーディング規約（コーディング開始前に必ず読む）
- **[HTML/CSS静的コーディング](04-markup.md)** - 模写コーディングフェーズに進みましょう

---

**最終更新**: 2025/12/4
