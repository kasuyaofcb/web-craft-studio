#!/usr/bin/env node

/**
 * 模写コーディングフェーズ用のIssue一括作成スクリプト（Node.js版）
 * 使用方法: node create-markup-issues.js
 *
 * 必要なパッケージ:
 * npm install @octokit/rest dotenv
 *
 * または:
 * npm install
 */

const { Octokit } = require('@octokit/rest');
require('dotenv').config();

// GitHubのリポジトリ情報
const REPO_OWNER = process.env.GITHUB_REPOSITORY_OWNER || '';
const REPO_NAME = process.env.GITHUB_REPOSITORY_NAME || '';

// GitHubトークン（環境変数から取得）
const GITHUB_TOKEN = process.env.GITHUB_TOKEN || '';

// セクション一覧（プロジェクトに合わせてカスタマイズ）
const SECTIONS = [
  'TOPページ ファーストビュー（FV）',
  'TOPページ セクション01',
  'TOPページ セクション02',
  'TOPページ セクション03',
  'TOPページ セクション04',
  'ヘッダー',
  'フッター',
];

// デザインカンプのベースURL（カスタマイズ可能）
const DESIGN_CAMP_BASE_URL = process.env.DESIGN_CAMP_BASE_URL || '';

/**
 * Issue本文を作成
 */
function createIssueBody(section) {
  return `## 概要

${section}をデザインカンプ通りにHTML/CSSで再現します。

### 目的

- デザインカンプの忠実再現
- レスポンシブ対応の理解
- BEM設計の適用練習

## デザインカンプ

- デザインカンプ: ${DESIGN_CAMP_BASE_URL}
- ページ/セクション: ${section}
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
- 大幅なレイアウト変更は禁止（カンプ準拠）`;
}

/**
 * Issueを作成
 */
async function createIssue(octokit, section) {
  const title = `[模写コーディング] ${section}作成`;
  const body = createIssueBody(section);

  try {
    const { data } = await octokit.rest.issues.create({
      owner: REPO_OWNER,
      repo: REPO_NAME,
      title: title,
      body: body,
      labels: ['作業中', '模写'],
    });

    console.log(`✅ 作成完了: ${title}`);
    console.log(`   URL: ${data.html_url}\n`);
    return data;
  } catch (error) {
    console.error(`❌ 作成失敗: ${title}`);
    console.error(`   エラー: ${error.message}\n`);
    throw error;
  }
}

/**
 * メイン処理
 */
async function main() {
  // バリデーション
  if (!GITHUB_TOKEN) {
    console.error('❌ GITHUB_TOKEN 環境変数が設定されていません');
    console.error('   .env ファイルに GITHUB_TOKEN=your_token を追加してください');
    process.exit(1);
  }

  if (!REPO_OWNER || !REPO_NAME) {
    console.error('❌ リポジトリ情報が設定されていません');
    console.error('   環境変数 GITHUB_REPOSITORY_OWNER と GITHUB_REPOSITORY_NAME を設定してください');
    process.exit(1);
  }

  console.log(`📋 リポジトリ: ${REPO_OWNER}/${REPO_NAME}`);
  console.log(`📝 作成するIssue数: ${SECTIONS.length}\n`);

  // Octokitの初期化
  const octokit = new Octokit({
    auth: GITHUB_TOKEN,
  });

  // 各セクションのIssueを作成
  const results = [];
  for (const section of SECTIONS) {
    console.log(`📌 Issue作成中: [模写コーディング] ${section}作成`);
    try {
      const issue = await createIssue(octokit, section);
      results.push(issue);
      // レート制限を避けるため、少し待機
      await new Promise(resolve => setTimeout(resolve, 500));
    } catch (error) {
      console.error(`エラーが発生しました: ${error.message}`);
    }
  }

  console.log(`\n🎉 ${results.length}/${SECTIONS.length} 個のIssue作成が完了しました！`);
}

// 実行
if (require.main === module) {
  main().catch(console.error);
}

module.exports = { createIssue, createIssueBody };

