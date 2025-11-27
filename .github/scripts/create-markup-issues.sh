#!/bin/bash

# 模写コーディングフェーズ用のIssue一括作成スクリプト
# 使用方法: ./create-markup-issues.sh

# GitHubのリポジトリ情報（環境変数または引数で指定）
REPO_OWNER="${GITHUB_REPOSITORY_OWNER:-}"
REPO_NAME="${GITHUB_REPOSITORY_NAME:-}"

# セクション一覧（プロジェクトに合わせてカスタマイズ）
SECTIONS=(
  "TOPページ ファーストビュー（FV）"
  "TOPページ セクション01"
  "TOPページ セクション02"
  "TOPページ セクション03"
  "TOPページ セクション04"
  "ヘッダー"
  "フッター"
)

# デザインカンプのベースURL（カスタマイズ可能）
DESIGN_CAMP_BASE_URL=""

# GitHub CLIがインストールされているか確認
if ! command -v gh &> /dev/null; then
  echo "❌ GitHub CLI (gh) がインストールされていません"
  echo "インストール方法: https://cli.github.com/"
  exit 1
fi

# GitHub認証確認
if ! gh auth status &> /dev/null; then
  echo "❌ GitHub認証が必要です"
  echo "実行: gh auth login"
  exit 1
fi

# リポジトリ情報の取得
if [ -z "$REPO_OWNER" ] || [ -z "$REPO_NAME" ]; then
  REPO_FULL=$(gh repo view --json nameWithOwner -q .nameWithOwner 2>/dev/null)
  if [ -z "$REPO_FULL" ]; then
    echo "❌ リポジトリ情報を取得できませんでした"
    echo "環境変数 GITHUB_REPOSITORY_OWNER と GITHUB_REPOSITORY_NAME を設定するか、"
    echo "リポジトリディレクトリで実行してください"
    exit 1
  fi
  REPO_OWNER=$(echo $REPO_FULL | cut -d'/' -f1)
  REPO_NAME=$(echo $REPO_FULL | cut -d'/' -f2)
fi

echo "📋 リポジトリ: $REPO_OWNER/$REPO_NAME"
echo "📝 作成するIssue数: ${#SECTIONS[@]}"
echo ""

# 確認
read -p "続行しますか？ (y/N): " -n 1 -r
echo
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
  echo "キャンセルしました"
  exit 0
fi

# 各セクションのIssueを作成
for SECTION in "${SECTIONS[@]}"; do
  TITLE="[模写コーディング] $SECTION作成"

  # Issue本文の作成
  BODY=$(cat <<EOF
## 概要

$SECTIONをデザインカンプ通りにHTML/CSSで再現します。

### 目的

- デザインカンプの忠実再現
- レスポンシブ対応の理解
- BEM設計の適用練習

## デザインカンプ

- デザインカンプ: $DESIGN_CAMP_BASE_URL
- ページ/セクション: $SECTION
- 参考画像/ファイル:

## 作業内容チェックリスト

- [ ] HTML構造をカンプに沿って作成
- [ ] CSSでスタイルを適用（色、フォント、背景画像、間隔）
- [ ] BEM設計ルールに従ったクラス命名
- [ ] レスポンシブ対応確認（PC / タブレット / スマホ）
- [ ] 必要なJSアニメーションの実装（スライダーやフェードなど）
- [ ] 自己レビュー完了後、PR作成

## 完了条件

- デザインカンプと見た目・挙動が一致していること
- レスポンシブ表示が正しく機能していること
- コードがBEM設計に沿っていること
- PRを作成してレビュー依頼済み

## 補足・注意点

- 画像やアイコンは指定のアセットを使用
- 不明点はメンターに質問して進める
- 大幅なレイアウト変更は禁止（カンプ準拠）
EOF
)

  echo "📌 Issue作成中: $TITLE"

  # Issue作成
  gh issue create \
    --title "$TITLE" \
    --body "$BODY" \
    --label "作業中,模写" \
    --repo "$REPO_OWNER/$REPO_NAME"

  if [ $? -eq 0 ]; then
    echo "✅ 作成完了: $TITLE"
  else
    echo "❌ 作成失敗: $TITLE"
  fi

  echo ""
done

echo "🎉 すべてのIssue作成が完了しました！"

